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

	// helper functions
}
