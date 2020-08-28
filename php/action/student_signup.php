<?php
require_once  '../autoload.php';

use App\User;

//
session_start();
if (isset($_SESSION['user'])) {
	header('location: ../../');
	exit;
}

//
$User = new User();
$result = $User->createUser($_POST, 'student');

if (!$result['result']) {
	header("location: ../../student_auth?signup_tab&error={$result['reason']}");
	exit;
}

header("location: ../../student_auth");
exit;
