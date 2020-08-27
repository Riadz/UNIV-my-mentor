<?php
require_once  'php/autoload.php';
session_start();

// auth
if (isset($header_info['auth'])) {

	if (!isset($_SESSION['user'])) {
		header("location: {$header_info['auth']}_auth");
		exit;
	}

	if ($header_info['auth'] !== $_SESSION['user']['type']) {
		header('location: error/403');
		exit;
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<title><?= $header_info['title'] ?? 'My Mentor' ?></title>

	<!-- external links -->
	<link rel="stylesheet" href="./css/libs/bootstrap.min.css" />
	<link rel="stylesheet" href="./css/libs/font-awesome.min.css" />
	<link rel="stylesheet" href="./css/libs/owl.carousel.min.css" />

	<!-- links -->
	<link rel="stylesheet" href="./css/style.min.css" />
</head>

<body>
	<header class="header">
		<div class="container">
			<div class="logo-nav navbar navbar-expand-lg navbar-light p-0">
				<a class="navbar-brand d-flex align-items-end" href="/">
					<img src="img/logo.svg" alt="Mon Encadreur logo" />
					<span>Mon Encadreur</span>
				</a>

				<button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
					<span class="navbar-toggler-icon"></span>
				</button>

				<nav class="collapse navbar-collapse" id="navbarSupportedContent">
					<?php if (!isset($header_info['navigation'])) : ?>
						<ul class="navbar-nav ml-auto">
							<li><a href="/">Accueil</a></li>
							<li><a href="#">A propos</a></li>
							<li><a href="#">Contactez nous</a></li>
							<li><a href="#">University</a></li>
							<li><a href="/#acc-cta">Créer un compte</a></li>
						</ul>
					<?php elseif ($header_info['navigation'] === 'student') : ?>
						<ul class="navbar-nav student-nav ml-auto">
							<li><a href="student_dashboard">Tableau d'bord</a></li>
							<li><a href="php/action/logout">Se Deconnecter</a></li>
						</ul>
					<?php elseif ($header_info['navigation'] === 'teacher') : ?>
						<ul class="navbar-nav teacher-nav ml-auto">
							<li><a href="teacher_dashboard">Tableau d'bord</a></li>
							<li><a href="php/action/logout">Se Deconnecter</a></li>
						</ul>
					<?php endif ?>
				</nav>
			</div>
		</div>
	</header>
