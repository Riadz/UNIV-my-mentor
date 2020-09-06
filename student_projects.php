<?php
$header_info = [
	'title' => 'Mes Projets | Etudiants',

	'auth' => 'student',
];
require('common/header.php')
?>

<?php

use App\Student;

$Student = new Student();
$projects =
	$Student->getStudentDashboardProjects(
		$_SESSION['user']['type_data']['student_id']
	);
?>
<main class="flex-grow-1 dashboard">
	<section class="dashboard-section">
		<div class="container dashboard-section-container">
			<h2 class="dashboard-section-header">Mes Projects</h2>
			<?php if (empty($projects)) : ?>
				<span class="display-3 d-flex justify-content-center py-5">
					Vous n'avez aucun projet!
				</span>
			<?php endif ?>
			<div class="posts row">
				<?php foreach ($projects as $project) : ?>
					<div class="posts-card-container project-<?= $project['mentorship_id'] ?> col-lg-6">
						<div class="posts-card">
							<div class="posts-card-info row m-0">
								<div class="col-12 d-flex flex-column">
									<h3><i class="fas fa-user-graduate fa-2x fa-fw"></i> Enseignants:</h3>
									<span class="posts-card-info-text"><?= $project['first_name'] ?> <?= $project['last_name'] ?></span>
								</div>
								<div class="col-12 d-flex flex-column">
									<h3><i class="fas fa-envelope-open-text fa-2x fa-fw"></i> Email:</h3>
									<span class="posts-card-info-text"><?= empty($project['public_email']) ? 'Non Disponible' : $project['public_email'] ?></span>
								</div>
								<div class="col-12 d-flex flex-column">
									<h3><i class="fas fa-mobile-alt fa-2x fa-fw"></i> Numero:</h3>
									<span class="posts-card-info-text"><?= empty($project['public_number']) ? 'Non Disponible' : $project['public_number'] ?></span>
								</div>
								<div class="col-6 d-flex flex-column">
									<h3><i class="fas fa-address-card fa-2x fa-fw"></i> Annonce:</h3>
									<span class="posts-card-info-text text-center"><?= $project['post_title'] ?></span>
								</div>
								<div class="col-6 d-flex flex-column">
									<h3><i class="fas fa-clipboard-list fa-2x fa-fw"></i> Theme:</h3>
									<span class="posts-card-info-text"><?= $project['theme_title'] ?></span>
								</div>
								<div class="col-6">
									<h3><i class="fas fa-building fa-2x fa-fw"></i> Departement:</h3>
									<div class="posts-card-info-fac">
										<img src="img/facs/fac-<?= $project['fac_id'] ?>.png" alt="">
										<span><?= $project['dep_name'] ?></span>
									</div>
								</div>
								<div class="col-6 d-flex flex-column">
									<h3><i class="fas fa-graduation-cap fa-2x fa-fw"></i> Année:</h3>
									<span class="posts-card-info-text"><?= $Student->yearToString($project['post_year']) ?></span>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</section>
</main>
<!-- delete modal -->
<div class="modal fade" id="delet-project-modal">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Supprimer Le Projet</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>Étes-vous certain de vouloir supprimer cette projet ?</p>
				<p>
					ID du projet: <strong id="modal-project-id-text"></strong><br>
					Nom de l'ètudiant: <strong id="modal-student-name"></strong>
				</p>
			</div>

			<div class="modal-footer">
				<form action="/php/action/teacher_delete_project.php" method="POST">
					<input id="modal-project-id-value" name="mentorship_id" type="hidden">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-danger">Supprimer</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
require('common/footer.php')
?>
