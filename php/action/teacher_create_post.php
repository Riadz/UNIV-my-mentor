<?php
session_start();
require_once  'auth/teacher.php';
require_once  '../autoload.php';

use App\Teacher;

$Teacher = new Teacher();

$result = $Teacher->createPost(
	$_POST,
	$_SESSION['user']['type_data']['teacher_id']
);

if ($result['result']) {
	header('location: ../../teacher_dashboard');
	exit;
} else {
	echo 'unexpected error';
	exit;
}
