<?php
$header_info = [
	'title' => 'Mes Projets | Enseignants',

	'auth'       => 'teacher',
];
require('common/header.php')
?>

<?php

use App\Teacher;

$Teacher = new Teacher();
$projects =
	$Teacher->getTeacherDashboardProjects(
		$_SESSION['user']['type_data']['teacher_id']
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
							<div class="posts-card-header">
								<div></div>
								<div class="posts-card-actions">
									<button data-project-id="<?= $project['mentorship_id'] ?>" data-student-name="<?= $project['last_name'] ?> <?= $project['first_name'] ?>" title="supprimer" class="posts-card-actions-btn" data-toggle="modal" data-target="#delet-project-modal">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<div class="posts-card-info row m-0">
								<div class="col-12 d-flex flex-column">
									<h3><i class="fas fa-user-graduate fa-2x fa-fw"></i> Etudiant:</h3>
									<span class="posts-card-info-text"><?= $project['first_name'] ?> <?= $project['last_name'] ?></span>
								</div>
								<div class="col-12 d-flex flex-column">
									<h3><i class="fas fa-envelope-open-text fa-2x fa-fw"></i> Email:</h3>
									<span class="posts-card-info-text"><?= $project['email'] ?></span>
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
									<span class="posts-card-info-text"><?= $Teacher->yearToString($project['post_year']) ?></span>
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

<!-- modal scripts -->
<script>
	// delete modal
	$('#delet-project-modal').on('show.bs.modal', function(event) {
		let button = $(event.relatedTarget);
		let projectId = button.data('project-id');
		let name = button.data('student-name');

		let modal = $(this);
		modal.find('#modal-project-id-text').text(projectId);
		modal.find('#modal-project-id-value').val(projectId);
		modal.find('#modal-student-name').text(name);
	})
</script>
