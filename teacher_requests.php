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
			<h2 class="dashboard-section-header">Mes Demandes</h2>
			<div>coming soon</div>
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
