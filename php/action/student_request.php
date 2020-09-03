<?php
session_start();
require_once  'auth/student.php';
require_once  '../autoload.php';

use App\Student;

$Student = new Student();

$result = $Student->requestMentorship(
	$_POST,
	$_SESSION['user']['type_data']['student_id']
);

if ($result['result']) {
	header("location: ../../teacher_post?post_id={$_POST['post_id']}&result=1");
	exit;
} else {
	header("location: ../../teacher_post?post_id={$_POST['post_id']}&result=0&reason={$result['reason']}");
	exit;
}
