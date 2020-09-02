<?php
$header_info = [
	'title' => 'Résultat | Etudiant',

	'auth'       => 'student',
	'navigation' => 'student',
];
require('common/header.php')
?>

<?php

use App\Student;

$Student = new Student();
$posts =
	$Student->search($_GET);
?>
<main class="flex-grow-1 dashboard search">
	<section class="dashboard-section">
		<div class="container">
			<h1 class="text-center mb-2 display-3">Résultat</h1>
		</div>
		<div class="container dashboard-section-container">
			<div class="search-results posts row">
				<?php foreach ($posts as $post) : ?>
					<div class="posts-card-container post-<?= $post['post_id'] ?> col-lg-6">
						<div class="posts-card">
							<div class="posts-card-header">
								<div class="posts-card-status">
									<h3>Ètat: </h3>
									<span class="status-<?= $post['status'] ?>"><?= $post['status'] ?></span>
								</div>
								<div></div>
							</div>
							<span class="posts-card-title">
								<?= $post['post_title'] ?>
							</span>
							<div class="posts-card-info row">
								<div class="col-12 d-flex flex-column">
									<h3><i class="fas fa-user-tie fa-2x fa-fw"></i> Enseignant:</h3>
									<span class="posts-card-info-text"><?= $post['first_name'] ?> <?= $post['last_name'] ?></span>
								</div>
								<div class="col-6">
									<h3><i class="fas fa-city fa-2x fa-fw"></i> Faculté:</h3>
									<div class="posts-card-info-fac">
										<span><?= $post['fac_name'] ?></span>
										<img src="img/facs/fac-<?= $post['fac_id'] ?>.png" alt="">
									</div>
								</div>
								<div class="col-6 d-flex flex-column">
									<h3><i class="fas fa-building fa-2x fa-fw"></i> Departement:</h3>
									<span class="posts-card-info-text"><?= $post['dep_name'] ?></span>
								</div>
								<div class="col-6 d-flex flex-column">
									<h3><i class="fas fa-graduation-cap fa-2x fa-fw"></i> Année:</h3>
									<span class="posts-card-info-text"><?= $Student->yearToString($post['post_year']) ?></span>
								</div>
								<div class="col-6 d-flex flex-column">
									<h3><i class="fas fa-user-graduate fa-2x fa-fw"></i> Étudiants Encadrés:</h3>
									<span class="posts-card-info-text"><?= $post['mentorship_count'] ?></span>
								</div>
							</div>
							<a href="teacher_post?post_id=<?= $post['post_id'] ?>" class="btn btn-search-con">
								<i class="fas fa-search fa-lg mr-2"></i>
								<span>Consulter</span>
							</a>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</section>
</main>
<?php
require('common/footer.php')
?>
