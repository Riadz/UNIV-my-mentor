<?php

namespace App;

use App\User;

class Teacher extends User
{
	function __construct()
	{
		parent::__construct();
	}

	// functions
	function createPost($data)
	{
		$validation = static::validatePostData($data);
		if (!$validation['valid'])
			return [
				'result' => false,
				'reason' => $validation['reason'],
			];

		//
		$fields = [
			'teacher_id' => $data['teacher_id'],
			'dep_id' => '',
			'post_title' => '',
			'post_description' => '',
		];
		$prepared = static::$db->prepare(
			"INSERT INTO `post`
			 (`teacher_id`, `dep_id`, `post_title`, `post_description`)
			 VALUES
			 (:teacher_id, :dep_id, :post_title, :post_description)"
		);
		$result = $prepared->execute($fields);
		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);

		//
		return ['result' => true];
	}

	// helper functions
	private static function validatePostData($data)
	{
		$required_input = [
			'title'               => 'Titre',
			'description'         => 'Description',
			'fac'                 => 'Faculté',
			'dep'                 => 'Departement',
			'theme_1_title'       => 'Titre du 1er Theme',
			'theme_1_description' => 'Description du 1er Theme',
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
}
