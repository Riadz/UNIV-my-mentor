<?php
require_once  '../autoload.php';

use App\User;

$User = new User();

$result = $User->createUser($_POST, 'student');

if (!$result['result']) {
	header("location: ../../student_auth.php?signup_tab&error={$result['reason']}");
	exit;
}

header("location: ../../");
exit;

// session_start();
// if (
// 	isset($_SESSION['user']->id)
// ) header('location: ../../');
