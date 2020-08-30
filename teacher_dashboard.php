<?php
$header_info = [
	'title' => 'Mes Annonces | Enseignants',

	'auth'       => 'teacher',
	'navigation' => 'teacher',
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
									<span class="status-<?= $post['status'] ?>"><?= $post['status'] ?></span>
								</div>

								<div class="posts-card-actions">
									<a href="#" title="Voir" class="posts-card-actions-btn">
										<i class="fas fa-eye"></i>
									</a>
									<a href="#" title="Modifier" class="posts-card-actions-btn">
										<i class="fas fa-pencil-alt"></i>
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

<?php
require('common/footer.php')
?>

<!-- delete modal script -->
<script>
	$('#delet-post-modal').on('show.bs.modal', function(event) {
		let button = $(event.relatedTarget);
		let postId = button.data('post-id');
		let mentorshipCount = button.data('mentorship-count');

		let modal = $(this);
		modal.find('#modal-post-id-text').text(postId);
		modal.find('#modal-post-id-input').val(postId);
		modal.find('#modal-mentorship-count').text(mentorshipCount);
	})
</script>
