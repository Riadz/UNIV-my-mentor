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
	function deletePost($post_id, $teacher_id)
	{
		if (!static::postBelongsTo($post_id, $teacher_id))
			return [
				'result' => false,
				'reason' => 'unauthorized',
			];

		//
		$prepared = static::$db->prepare(
			"DELETE FROM `post` WHERE
			 `post_id` = :post_id
			 LIMIT 1"
		);
		$result = $prepared->execute(['post_id' => $post_id]);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return ['result' => true];
	}

	function getTeacherDashboardPosts($teacher_id)
	{
		$result = static::$db->query(
			"SELECT
			 `post_id`, `fac`.`fac_id`, `fac`.`fac_name`, `dep`.`dep_name`, `status`, `post_year`, `post_title`,
			 (SELECT count(`mentorship_id`) FROM `mentorship`
			  WHERE `mentorship`.`post_id` = `post`.`post_id`) AS `mentorship_count`
			 FROM `post`
			 JOIN `dep` ON `post`.`dep_id` = `dep`.`dep_id`
			 JOIN `fac` ON `dep`.`fac_id` = `fac`.`fac_id`

			 WHERE `teacher_id` = $teacher_id"
		);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		$posts = $result->fetchAll();
		foreach ($posts as &$post) {
			$result = static::$db->query(
				"SELECT `theme_id`,
				 (SELECT COUNT(`mentorship_id`) FROM `mentorship`
				  WHERE `mentorship`.`theme_id` = `theme`.`theme_id`)
				 as `mentorship_count`
				 FROM
				 `theme` WHERE `post_id` = {$post['post_id']}"
			);
			if (!$result)
				static::errorSQL($result->errorInfo()[2]);

			//
			$post['themes'] = $result->fetchAll();
		}

		//
		return $posts;
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
	private static function postBelongsTo($post_id, $teacher_id)
	{
		$prepared = static::$db->prepare(
			"SELECT `post_id` FROM `post` WHERE
			 `post_id` = :post_id AND
			 `teacher_id` = :teacher_id
			 LIMIT 1"
		);
		$result = $prepared->execute([
			'post_id'    => $post_id,
			'teacher_id' => $teacher_id,
		]);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return (bool) $prepared->rowCount();
	}
}
