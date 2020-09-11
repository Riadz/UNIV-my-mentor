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
		$search_params = [];

		if (isset($data['search'])) {
			$type = $data['type'] ?? 'post_title';
			$search = static::$db->quote("%{$data['search']}%");

			$search_params[] = "$type like $search";
		}

		// escaping input
		foreach ($data as &$item)
			$item = static::$db->quote($item);

		//
		if (isset($data['fac']))
			$search_params[] = "`fac`.`fac_id`= {$data['fac']}";

		if (isset($data['dep']))
			$search_params[] = "`dep`.`dep_id`= {$data['dep']}";

		if (isset($data['year']))
			$search_params[] = "`post_year`= {$data['year']}";

		$search_str = '';
		foreach ($search_params as $param)
			$search_str .= " AND $param ";

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

			 WHERE `status` != 'fermée'

			 $search_str
			 "
		);
		if (!$result)
			static::errorSQL(static::$db->errorInfo()[2]);

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
	function getStudentDashboardRequests($student_id)
	{
		$result = static::$db->query(
			"SELECT
			 `mentorship_request_id`, `mentorship_request`.`student_id`, `mentorship_request`.`post_id`, `mentorship_request`.`status`,
			 `date`,  `message`, `user`.`last_name`, `user`.`first_name`,
			 `post`.`post_title`, `fac`.`fac_id`, `dep`.`dep_name`, `theme`.`theme_title`

			 FROM `mentorship_request`

			 JOIN `post` ON `post`.`post_id` = `mentorship_request`.`post_id`
			 JOIN `teacher` ON `teacher`.`teacher_id` = `post`.`teacher_id`
			 JOIN `user` ON `user`.`user_id` = `teacher`.`user_id`
			 JOIN `theme` ON `theme`.`theme_id` = `mentorship_request`.`theme_id`
			 JOIN `dep` ON `dep`.`dep_id` = `post`.`dep_id`
			 JOIN `fac` ON `fac`.`fac_id` = `dep`.`fac_id`

			 WHERE `student_id` = $student_id"
		);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return $result->fetchAll();;
	}
	function getStudentDashboardProjects($student_id)
	{
		$result = static::$db->query(
			"SELECT
			 `mentorship_id`, `fac`.`fac_id`, `dep`.`dep_name`, `post_year`, `post_title`,
			 `theme`.`theme_title`, `user`.`last_name`, `user`.`first_name`,
			 `teacher`.`public_email`,`teacher`.`public_number`

			 FROM `mentorship`
			 JOIN `post` ON `post`.`post_id` = `mentorship`.`post_id`
			 JOIN `theme` ON `theme`.`theme_id` = `mentorship`.`theme_id`
			 JOIN `teacher` ON `teacher`.`teacher_id` = `post`.`teacher_id`
			 JOIN `user` ON `user`.`user_id` = `teacher`.`user_id`
			 JOIN `dep` ON `post`.`dep_id` = `dep`.`dep_id`
			 JOIN `fac` ON `dep`.`fac_id` = `fac`.`fac_id`

			 WHERE `student_id` = $student_id"
		);
		if (!$result)
			static::errorSQL(static::$db->errorInfo()[2]);

		//
		return $result->fetchAll();
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
				'reason' => 'Theme appartient pas a se post',
			];

		//
		if (static::demandExists($student_id, $data['post_id']))
			return [
				'valid' => false,
				'reason' => 'Vous avez deja envoyée une domande a cette annonce',
			];

		//
		if (static::demandProhibited($data['post_id']))
			return [
				'valid' => false,
				'reason' => 'Cette annonce est fermée ou suspendu',
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
	private static function demandProhibited($post_id)
	{
		$prepared = static::$db->prepare(
			"SELECT `post_id` FROM `post` WHERE
			 `post_id` = :post_id AND
			 `status` = 'ouvert'
			 LIMIT 1"
		);
		$result = $prepared->execute([
			'post_id'    => $post_id,
		]);
		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);

		//
		return !(bool) $prepared->rowCount();
	}
}
