<?php
if (!isset($_SESSION['user'])) {
	header("location: teacher_auth");
	exit;
}

if ($_SESSION['user']['type'] !== 'teacher') {
	header('location: error/403');
	exit;
}
