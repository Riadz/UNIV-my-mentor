<?php

namespace App;

use App\User;

class Student extends User
{
	function __construct()
	{
		parent::__construct();
	}

	// functions
	public function search($data)
	{
		$result = static::$db->query(
			"SELECT
			 `post_id`, `post_year`, `post_title`, `status`,
			 `fac`.`fac_id`, `fac`.`fac_name`, `dep`.`dep_name`,
			 `post`.`teacher_id`, `user`.`user_id`,
			 `user`.`first_name`, `user`.`last_name`,

			 (SELECT count(`mentorship_id`) FROM `mentorship`
			  WHERE `mentorship`.`post_id` = `post`.`post_id`) AS `mentorship_count`

			 FROM `post`
			 JOIN `dep` ON `post`.`dep_id` = `dep`.`dep_id`
			 JOIN `fac` ON `dep`.`fac_id` = `fac`.`fac_id`
			 JOIN `teacher` ON `post`.`teacher_id` = `teacher`.`teacher_id`
			 JOIN `user` ON `teacher`.`user_id` = `user`.`user_id`

			 WHERE 1"
		);
		if (!$result)
			static::errorSQL('Error SQL');

		//
		return $result->fetchAll();
	}
	public function requestMentorship($data, $student_id)
	{
		$validation = static::validateRequestMentorshipData($data, $student_id);
		if (!$validation['valid'])
			return [
				'result' => false,
				'reason' => $validation['reason'],
			];

		// inserting request
		$fields = [
			'student_id' => $student_id,
			'post_id'    => $data['post_id'],
			'theme_id'   => $data['theme_id'],
			'message'    => $data['message'],
			'date'       => date('Y-m-d'),
		];
		$prepared = static::$db->prepare(
			"INSERT INTO `mentorship_request`
			 (`student_id`, `post_id`, `theme_id`, `message`, `date`)
			 VALUES
			 (:student_id, :post_id, :theme_id, :message, :date)"
		);
		$result = $prepared->execute($fields);
		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);

		//
		return ['result' => true];
	}

	// helper functions
	private static function validateRequestMentorshipData($data, $student_id)
	{
		$required_input = [
			'post_id'  => 'Id du post',
			'theme_id' => 'Id du theme',
		];
		foreach ($required_input as $input => $alt)
			if (!isset($data[$input]) || empty($data[$input]))
				return [
					'valid' => false,
					'reason' => "Entrée manquante '$alt'",
				];

		//
		if (!static::themeBelongsTo($data['theme_id'], $data['post_id']))
			return [
				'valid' => false,
				'reason' => "Theme appartient pas a se post",
			];

		//
		if (static::demandExists($student_id, $data['post_id']))
			return [
				'valid' => false,
				'reason' => "Vous avez deja envoyée une domande a cette annonce",
			];

		//
		return ['valid' => true];
	}
	private static function themeBelongsTo($theme_id, $post_id)
	{
		$prepared = static::$db->prepare(
			"SELECT `theme_id` FROM `theme` WHERE
			 `theme_id` = :theme_id AND
			 `post_id` = :post_id
			 LIMIT 1"
		);
		$result = $prepared->execute([
			'theme_id' => $theme_id,
			'post_id'  => $post_id,
		]);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return (bool) $prepared->rowCount();
	}
	private static function demandExists($student_id, $post_id)
	{
		$prepared = static::$db->prepare(
			"SELECT `mentorship_request_id` FROM `mentorship_request` WHERE
			 `student_id` = :student_id AND
			 `post_id` = :post_id
			 LIMIT 1"
		);
		$result = $prepared->execute([
			'student_id' => $student_id,
			'post_id'    => $post_id,
		]);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return (bool) $prepared->rowCount();
	}
}
