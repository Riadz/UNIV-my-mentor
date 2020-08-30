<?php
session_start();
require_once  'auth/teacher.php';
require_once  '../autoload.php';

use App\Teacher;

$Teacher = new Teacher();

var_dump($_POST);
exit;

$result = $Teacher->deletePost(
	$_POST['post_id'],
	$_SESSION['user']['type_data']['teacher_id']
);

header('location: ../../teacher_dashboard');
exit;
