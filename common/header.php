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
					<ul class="navbar-nav ml-auto">
						<li><a href="/">Accueil</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
