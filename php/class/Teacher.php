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
	function createPost($data, $teacher_id)
	{
		$validation = static::validatePostData($data);
		if (!$validation['valid'])
			return [
				'result' => false,
				'reason' => $validation['reason'],
			];

		// inserting post
		$fields = [
			'teacher_id'          => $teacher_id,
			'dep_id'              => $data['dep'],
			'post_year'           => $data['year'],
			'post_title'          => $data['title'],
			'post_description'    => $data['description'],
		];
		$prepared = static::$db->prepare(
			"INSERT INTO `post`
			 (`teacher_id`, `dep_id`, `post_year`, `post_title`, `post_description`)
			 VALUES
			 (:teacher_id, :dep_id, :post_year, :post_title, :post_description)"
		);
		$result = $prepared->execute($fields);
		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);

		// inserting themes
		$post_id = static::$db->lastInsertId();
		for ($i = 1; $i <= 5; $i++) {
			if (
				isset($data["theme_title_$i"]) &&
				!empty($data["theme_title_$i"])
			) {
				$fields = [
					'post_id'           => $post_id,
					'theme_title'       => $data["theme_title_$i"],
					'theme_description' => $data["theme_description_$i"],
				];
				$prepared = static::$db->prepare(
					"INSERT INTO `theme`
					 (`post_id`, `theme_title`, `theme_description`)
					 VALUES
					 (:post_id, :theme_title, :theme_description)"
				);
				$result = $prepared->execute($fields);
				if (!$result)
					static::errorSQL($prepared->errorInfo()[2]);
			} else {
				break;
			}
		}
		//
		return ['result' => true];
	}

	function getTeacherDashboardPosts($teacher_id)
	{
		$result = static::$db->query(
			"SELECT `post_id`, `status`, `post_year`, `post_title`, `dep`.`dep_name`, `fac`.`fac_name`, `fac`.`fac_id`
			 FROM `post`
			 JOIN `dep` ON `post`.`dep_id` = `dep`.`dep_id`
			 JOIN `fac` ON `dep`.`fac_id` = `fac`.`fac_id`

			 WHERE `teacher_id` = $teacher_id"
		);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return $result->fetchAll();
	}

	function getFacArray()
	{
		$result = static::$db->query(
			"SELECT * FROM `fac`"
		);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return $result->fetchAll();
	}
	function getDepArray()
	{
		$result = static::$db->query(
			"SELECT * FROM `dep`"
		);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return $result->fetchAll();
	}

	// helper functions
	private static function validatePostData($data)
	{
		$required_input = [
			'title'               => 'Titre',
			'description'         => 'Description',
			'fac'                 => 'Faculté',
			'dep'                 => 'Departement',
			'year'                => 'Année',
			'theme_title_1'       => 'Titre du 1er Theme',
			'theme_description_1' => 'Description du 1er Theme',
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
