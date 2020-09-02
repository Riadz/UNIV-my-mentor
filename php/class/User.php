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
		static::initDB();
	}

	// functions
	function loginUser($data, $type)
	{
		$types = ['student', 'teacher'];
		if (
			!isset($type) ||
			empty($type) ||
			!in_array($type, $types)
		)
			return [
				'result' => false,
				'reason' => 'Type erronée',
			];

		//
		$validation = static::validateLoginData($data);
		if (!$validation['valid'])
			return [
				'result' => false,
				'reason' => $validation['reason'],
			];

		//
		if (!static::emailExists($data['email']))
			return [
				'result' => false,
				'reason' => "Email n'existe pas '{$data['email']}'",
			];

		//
		$prepared = static::$db->prepare(
			"SELECT `user_id`, `password`, `first_name`, `last_name` FROM `user`
			 WHERE `email` = :email
			 LIMIT 1"
		);
		$result = $prepared->execute(['email' => $data['email']]);

		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);

		$fetched_data = $prepared->fetch();
		if (!password_verify($data['password'], $fetched_data['password']))
			return [
				'result' => false,
				'reason' => "Mot de passe incorrect!",
			];

		//
		$prepared = static::$db->prepare(
			"SELECT * FROM $type
			 WHERE `user_id` = :user_id
			 LIMIT 1"
		);
		$result = $prepared->execute(['user_id' => $fetched_data['user_id']]);

		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);

		//
		if ($prepared->rowCount() === 0) {
			unset($types[(array_search($type, $types))]);
			$alt = array_pop($types);
			$tra = [
				'student' => 'Étudiant',
				'teacher' => 'Enseignant',
			];
			return [
				'result'     => false,
				'reason'     => 'alt',
				'alt'        => $alt,
				'alt_reason' => "Vous êtes un {$tra[$alt]}",
			];
		}

		//
		$fetched_type_data = $prepared->fetch();
		unset($fetched_type_data['user_id']);

		//
		$user_data = [
			'user_id'    => $fetched_data['user_id'],
			'email'      => $data['email'],
			'first_name' => $fetched_data['first_name'],
			'last_name'  => $fetched_data['last_name'],
			'type'       => $type,
			'type_data'  => $fetched_type_data,
		];


		//
		return [
			'result' => true,
			'user'   => $user_data,
		];
	}
	function createUser($data, $type)
	{
		$validation = static::validateSignupData($data, $type);
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
	private static function validateLoginData($data)
	{
		$required_input = [
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
		return ['valid' => true];
	}
	private static function validateSignupData($data, $type)
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
			$result = static::validateLength(
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
	private static function validateLength($string, $min, $max): int
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
	protected static function initDB(): void
	{
		if (static::$db === null)
			static::$db = Database::make();
	}
	protected static function errorSQL($error)
	{
		die("SQL fatal error: $error");
	}

	static $years_string = [
		1 => '1er Licence',
		2 => '2eme Licence',
		3 => '3eme Licence',
		4 => '1er Master',
		5 => '2eme Master',
	];
	public function yearToString($year)
	{
		return static::$years_string[$year];
	}
}
