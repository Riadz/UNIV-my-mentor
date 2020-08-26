<?php
require_once  '../autoload.php';

use App\User;

//
session_start();
if (isset($_SESSION['user']['user_id'])) {
	header('location: ../../');
	exit;
}

//
$User = new User();
$result = $User->loginUser($_POST, $_GET['type']);

if (!$result['result']) {
	header("location: ../../{$_POST['type']}_auth?error={$result['reason']}");
	exit;
}

$_SESSION['user'] = $result['user'];

var_dump($_SESSION['user']);
exit;

header('location: ../../');
exit;
