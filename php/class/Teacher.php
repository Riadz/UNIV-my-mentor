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
	function requestResponse($data, $teacher_id)
	{
		$validation = static::validateRequestResponseData($data);
		if (!$validation['valid'])
			return [
				'result' => false,
				'reason' => $validation['reason'],
			];

		//
		if (!static::requestBelongsTo($data['mentorship_request_id'], $teacher_id))
			return [
				'result' => false,
				'reason' => 'unauthorized',
			];

		if ($data['response'] == 'accepted') {
			// getting request data
			$prepared = static::$db->prepare(
				"SELECT `student_id`, `post_id`, `theme_id` FROM `mentorship_request`
				 WHERE `mentorship_request_id` = :request_id
				 LIMIT 1"
			);
			$result = $prepared->execute([
				'request_id' => $data['mentorship_request_id']
			]);
			if (!$result)
				static::errorSQL($result->errorInfo()[2]);
			$requestData = $prepared->fetch();

			// creating mentorship
			$prepared = static::$db->prepare(
				"INSERT INTO `mentorship`
				 (`post_id`, `theme_id`, `student_id`)
				 VALUES
				 (:post_id, :theme_id, :student_id)"
			);
			$result = $prepared->execute($requestData);
			if (!$result)
				static::errorSQL($prepared->errorInfo()[2]);

			// updating request status
			$result = static::$db->query(
				"UPDATE `mentorship_request` SET `status`= 'accepted'
				 WHERE `mentorship_request_id` = {$data['mentorship_request_id']}"
			);
			if (!$result)
				static::errorSQL($result->errorInfo()[2]);
		} else {

			// updating request status
			$result = static::$db->query(
				"UPDATE `mentorship_request` SET `status`= 'rejected'
				 WHERE `mentorship_request_id` = {$data['mentorship_request_id']}"
			);
			if (!$result)
				static::errorSQL($result->errorInfo()[2]);
		}

		//
		return ['result' => true];
	}
	function updatePostStatus($post_id, $status, $teacher_id)
	{
		if (!static::postBelongsTo($post_id, $teacher_id))
			return [
				'result' => false,
				'reason' => 'unauthorized',
			];

		//
		$prepared = static::$db->prepare(
			"UPDATE `post` SET `status`=:status
			 WHERE `post_id`= :post_id
			 LIMIT 1"
		);
		$result = $prepared->execute([
			'status'  => $status,
			'post_id' => $post_id
		]);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return ['result' => true];
	}
	function deleteMentorship($mentorship_id, $teacher_id)
	{
		if (!static::mentorshipBelongsTo($mentorship_id, $teacher_id))
			return [
				'result' => false,
				'reason' => 'unauthorized',
			];

		//
		$prepared = static::$db->prepare(
			"DELETE FROM `mentorship` WHERE
			 `mentorship_id` = :mentorship_id
			 LIMIT 1"
		);
		$result = $prepared->execute(['mentorship_id' => $mentorship_id]);
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
	function getTeacherDashboardProjects($teacher_id)
	{
		$result = static::$db->query(
			"SELECT
			 `mentorship_id`, `fac`.`fac_id`, `dep`.`dep_name`, `post_year`, `post_title`,
			 `theme`.`theme_title`, `user`.`last_name`, `user`.`first_name`, `user`.`email`

			 FROM `mentorship`
			 JOIN `post` ON `post`.`post_id` = `mentorship`.`post_id`
			 JOIN `theme` ON `theme`.`theme_id` = `mentorship`.`theme_id`
			 JOIN `student` ON `student`.`student_id` = `mentorship`.`student_id`
			 JOIN `user` ON `user`.`user_id` = `student`.`user_id`
			 JOIN `dep` ON `post`.`dep_id` = `dep`.`dep_id`
			 JOIN `fac` ON `dep`.`fac_id` = `fac`.`fac_id`

			 WHERE `teacher_id` = $teacher_id"
		);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return $result->fetchAll();
	}
	function getTeacherDashboardRequests($teacher_id)
	{
		$result = static::$db->query(
			"SELECT
			 `mentorship_request_id`, `mentorship_request`.`student_id`, `mentorship_request`.`post_id`, `mentorship_request`.`status`,
			 `date`,  `message`, `user`.`last_name`, `user`.`first_name`,
			 `post`.`post_title`, `fac`.`fac_id`, `dep`.`dep_name`, `theme`.`theme_title`

			 FROM `mentorship_request`

			 JOIN `post` ON `post`.`post_id` = `mentorship_request`.`post_id`
			 JOIN `student` ON `student`.`student_id` = `mentorship_request`.`student_id`
			 JOIN `user` ON `user`.`user_id` = `student`.`user_id`
			 JOIN `theme` ON `theme`.`theme_id` = `mentorship_request`.`theme_id`
			 JOIN `dep` ON `dep`.`dep_id` = `post`.`dep_id`
			 JOIN `fac` ON `fac`.`fac_id` = `dep`.`fac_id`

			 WHERE
			 `mentorship_request`.`status` = 'pending' AND
			 `teacher_id` = $teacher_id"
		);
		if (!$result)
			static::errorSQL($result->errorInfo()[2]);

		//
		return $result->fetchAll();;
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
	private static function validateRequestResponseData($data)
	{
		$required_input = [
			'mentorship_request_id' => 'Id de la demande',
			'response'              => 'Reponse de la demande',
		];
		foreach ($required_input as $input => $alt)
			if (!isset($data[$input]) || empty($data[$input]))
				return [
					'valid' => false,
					'reason' => "Entrée manquante '$alt'",
				];

		if (!in_array($data['response'], ['accepted', 'rejected']))
			return [
				'valid' => false,
				'reason' => "Reponse '{$data['response']}' erronée!",
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
	private static function requestBelongsTo($request_id, $teacher_id)
	{
		$prepared = static::$db->prepare(
			"SELECT `mentorship_request_id` FROM `mentorship_request`
			 JOIN `post` on `post`.`post_id` = `mentorship_request`.`post_id`
			 WHERE
			 `mentorship_request_id` = :request_id AND
			 `teacher_id` = :teacher_id
			 LIMIT 1"
		);
		$result = $prepared->execute([
			'request_id' => $request_id,
			'teacher_id' => $teacher_id,
		]);
		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);

		//
		return (bool) $prepared->rowCount();
	}
	private static function mentorshipBelongsTo($mentorship_id, $teacher_id)
	{
		$prepared = static::$db->prepare(
			"SELECT `mentorship_id`
			 FROM `mentorship`
			 JOIN `post` ON `post`.`post_id` = `mentorship`.`post_id`

			 WHERE
			 `mentorship_id` = :mentorship_id AND
			 `teacher_id` = :teacher_id
			 LIMIT 1"
		);
		$result = $prepared->execute([
			'mentorship_id' => $mentorship_id,
			'teacher_id'    => $teacher_id,
		]);
		if (!$result)
			static::errorSQL($prepared->errorInfo()[2]);

		//
		return (bool) $prepared->rowCount();
	}
}
