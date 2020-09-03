<?php
if (!isset($_SESSION['user'])) {
	header("location: ../../../student_auth");
	exit;
}

if ($_SESSION['user']['type'] !== 'student') {
	header('location: ../../../error/403');
	exit;
}
