<?php
$header_info = [
	'title' => 'Mes Annonces | Enseignants',

	'auth'       => 'teacher',
];
require('common/header.php')
?>

<?php

use App\Teacher;

$Teacher = new Teacher();
$posts =
	$Teacher->getTeacherDashboardPosts(
		$_SESSION['user']['type_data']['teacher_id']
	);
?>
<main class="flex-grow-1 dashboard">
	<section class="dashboard-section">
		<div class="container dashboard-section-container">
			<h2 class="dashboard-section-header">Mes Annonces</h2>
			<div class="posts row">
				<?php foreach ($posts as $post) : ?>
					<div class="posts-card-container post-<?= $post['post_id'] ?> col-lg-6">
						<div class="posts-card">
							<div class="posts-card-header">
								<div class="posts-card-status">
									<h3>Ètat: </h3>
									<span class="status-<?= $post['status'] ?> d-flex py-2">
										<?= $post['status'] ?>
										<button data-post-id="<?= $post['post_id'] ?>" data-status="<?= $post['status'] ?>" data-toggle="modal" data-target="#edit-status-modal" title="Modifier" class="posts-card-actions-btn edit">
											<i class="fas fa-pencil-alt"></i>
										</button>
									</span>
								</div>

								<div class="posts-card-actions">
									<a href="teacher_post?post_id=<?= $post['post_id'] ?>" title="Voir" class="posts-card-actions-btn">
										<i class="fas fa-eye"></i>
									</a>
									<button data-post-id="<?= $post['post_id'] ?>" data-mentorship-count="<?= $post['mentorship_count'] ?>" title="supprimer" class="posts-card-actions-btn" data-toggle="modal" data-target="#delet-post-modal">
										<i class="fas fa-times"></i>
									</button>
								</div>
							</div>
							<span class="posts-card-title">
								<?= $post['post_title'] ?>
							</span>
							<div class="posts-card-info row">
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
									<span class="posts-card-info-text"><?= $Teacher->yearToString($post['post_year']) ?></span>
								</div>
								<div class="col-6 d-flex flex-column">
									<h3><i class="fas fa-user-graduate fa-2x fa-fw"></i> Étudiants Encadrés:</h3>
									<span class="posts-card-info-text"><?= $post['mentorship_count'] ?></span>
								</div>
							</div>
							<div class="posts-card-themes">
								<h3>Etudiant encadré dans chaque theme</h3>
								<div class="posts-card-themes-container">
									<?php foreach ($post['themes'] as $theme) : ?>
										<div class="posts-card-themes-card theme-<?= $theme['theme_id'] ?>">
											<h4>theme</h4>
											<span><?= $theme['mentorship_count'] ?></span>
										</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>

				<!-- add post -->
				<div class="posts-card-container col-lg-6">
					<div class="posts-add-card">
						<a href="teacher_create_post" class="posts-add-card-btn">
							<i class="fas fa-plus-circle"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<!-- delete modal -->
<div class="modal fade" id="delet-post-modal">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Supprimer L'Annonces</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>Étes-vous certain de vouloir supprimer cette announce ?</p>
				<p>
					ID de l'announce: <strong id="modal-post-id-text">12</strong><br>
					Nombre d'ètudiants encadrés: <strong id="modal-mentorship-count">4</strong>
				</p>
			</div>

			<div class="modal-footer">
				<form action="/php/action/teacher_delete_post.php" method="POST">
					<input id="modal-post-id-input" name="post_id" type="hidden" value="">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-danger">Supprimer</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- edit modal -->
<div class="modal fade" id="edit-status-modal">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<form action="php/action/teacher_update_status.php" method="POST" class="modal-content">
			<input id="edit-status-post-id" name="post_id" type="hidden">

			<div class="modal-header">
				<h5 class="modal-title">Modifier l'etat de l'annonces</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p class="h4">Voilier choisir une etat:</p>
				<div class="radio-group">
					<input name="status" type="radio" id="input-ouvert" value="ouvert" checked>
					<div class="posts-card-status">
						<span class="status-ouvert d-flex py-2">
							Ouvert
						</span>
					</div>
				</div>
				<div class="radio-group">
					<input name="status" type="radio" id="input-fermée" value="fermée">
					<div class="posts-card-status">
						<span class="status-fermée d-flex py-2">
							Fermée
						</span>
					</div>
				</div>
				<div class="radio-group">
					<input name="status" type="radio" id="input-suspendu" value="suspendu">
					<div class="posts-card-status">
						<span class="status-suspendu d-flex py-2">
							Suspendu
						</span>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<button type="submit" class="btn btn-primary">Modifier</button>
			</div>
		</form>
	</div>
</div>

<?php
require('common/footer.php')
?>

<!-- modal scripts -->
<script>
	// delete modal
	$('#delet-post-modal').on('show.bs.modal', function(event) {
		let button = $(event.relatedTarget);
		let postId = button.data('post-id');
		let mentorshipCount = button.data('mentorship-count');

		let modal = $(this);
		modal.find('#modal-post-id-text').text(postId);
		modal.find('#modal-post-id-input').val(postId);
		modal.find('#modal-mentorship-count').text(mentorshipCount);
	})
	// edit status modal
	$('#edit-status-modal').on('show.bs.modal', function(event) {
		let button = $(event.relatedTarget);
		let postId = button.data('post-id');
		let status = button.data('status');

		let modal = $(this);
		modal.find('#edit-status-post-id').val(postId);
		modal.find(`#input-${status}`).prop("checked", true);
	})
</script>
