<?php
session_start();
require_once  'auth/teacher.php';
require_once  '../autoload.php';

use App\Teacher;

$Teacher = new Teacher();

$result = $Teacher->deleteMentorship(
	$_POST['mentorship_id'],
	$_SESSION['user']['type_data']['teacher_id']
);

if ($result['result']) {
	header('location: ../../teacher_projects');
	exit;
} elseif ($result['reason'] == 'unauthorized') {
	header('location: ../../error/403');
	exit;
} else {
	echo "Error: {$result['reason']}";
	exit;
}
