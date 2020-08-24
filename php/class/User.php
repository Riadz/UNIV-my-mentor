<?php

namespace App;

use App\Database;
use App\Traits\PinTrait;

class User
{
	use PinTrait;
	protected static $db = null;

	function __construct()
	{
		static::init_db();
	}

	// functions
	function createUser($data, $type)
	{
		$validation = static::validate_data($data, $type);
		if (!$validation['valid'])
			return [
				'result' => false,
				'reason' => $validation['reason'],
			];

		//
		$fields = [
			'first_name' => '',
			'last_name'  => '',
			'email'      => '',
			'password'   => '',
		];
		foreach ($fields as $key => &$field)
			$field = $data[$key];

		// hashing password
		$fields['password'] = password_hash($fields['password'], PASSWORD_BCRYPT);

		// inserting in db
		$prepared = static::$db->prepare(
			"INSERT INTO `user`
			 (`first_name`, `last_name`, `email`, `password`)
			 VALUES
			 (:first_name,:last_name,:email,:password)"
		);
		$result = $prepared->execute($fields);
		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);
		//
		$prepared = static::$db->prepare(
			"INSERT INTO `$type`
			 (`user_id`) VALUES (:user_id)"
		);
		$result = $prepared->execute(['user_id' => static::$db->lastInsertId()]);
		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);

		//
		return ['result' => true];
	}

	// helper functions
	protected static function init_db(): void
	{
		if (static::$db === null)
			static::$db = Database::make();
	}

	private static function validate_data($data, $type)
	{
		//
		$required_input = [
			'pin'        => 'Code pin',
			'first_name' => 'Nom',
			'last_name'  => 'Prénom',
			'email'      => 'Email',
			'password'   => 'Mote de pass',
		];
		foreach ($required_input as $input => $alt)
			if (!isset($data[$input]) || empty($data[$input]))
				return [
					'valid' => false,
					'reason' => "Entrée manquante '$alt'",
				];

		//
		$pin = static::getPins()[$type];
		if ($data['pin'] !== $pin)
			return [
				'valid' => false,
				'reason' => "Code pin invalide '{$data['pin']}'",
			];

		//
		if (static::emailExists($data['email']))
			return [
				'valid' => false,
				'reason' => "L'email existe déjà!",
			];

		//
		if ($data['password'] !== $data['password_conf'])
			return [
				'valid' => false,
				'reason' => "Les mots de passe ne correspondent pas!",
			];

		//
		$length_array = [
			['Prénom', $data['first_name'], 3, 155],
			['Nom', $data['last_name'], 3, 155],
			['Email', $data['email'], 0, 155],
			['Mote de pass', $data['password'], 6, 0],
		];
		foreach ($length_array as $length_item) {
			$result = static::validate_length(
				$length_item[1],
				$length_item[2],
				$length_item[3]
			);

			if ($result == -1)
				return [
					'valid' => false,
					'reason' => "{$length_item[0]} est trop court",
				];
			if ($result == 0)
				return [
					'valid' => false,
					'reason' => "{$length_item[0]} est trop long",
				];
		}

		//
		return ['valid' => true];
	}
	private static function validate_length($string, $min, $max): int
	{
		$len = strlen($string);

		if ($min != 0 && $len < $min)
			return -1;
		if ($max != 0 && $len > $max)
			return 0;
		return 1;
	}
	private static function emailExists(String $email): bool
	{
		$prepared = static::$db->prepare(
			"SELECT `user_id` FROM `user`
			 WHERE `email` = :email
			 LIMIT 1"
		);

		$result = $prepared->execute(['email' => $email]);
		if ($result) {
			return (bool) $prepared->rowCount();
		} else {
			static::errorSQL($prepared->errorInfo()[2]);
		}
	}

	//
	private static function errorSQL($error)
	{
		die("SQL fatal error: $error");
	}
}
