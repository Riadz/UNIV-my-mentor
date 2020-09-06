<?php
$header_info = [
	'title' => 'Mes Demandes | Enseignants',

	'auth'       => 'teacher',
];
require('common/header.php')
?>

<?php

use App\Teacher;

$Teacher = new Teacher();
$requests =
	$Teacher->getTeacherDashboardRequests(
		$_SESSION['user']['type_data']['teacher_id']
	);
?>
<main class="flex-grow-1 dashboard request">
	<section class="dashboard-section">
		<div class="container dashboard-section-container">
			<h2 class="dashboard-section-header">Mes Demandes</h2>
			<?php if (empty($requests)) : ?>
				<span class="display-3 d-flex justify-content-center py-5">
					Vous n'avez aucun Demande!
				</span>
			<?php endif ?>
			<div class="request-container d-flex flex-column">
				<?php foreach ($requests as $request) : ?>
					<div class="request-card d-flex justify-content-between">
						<div class="d-flex flex-grow-1 pr-3">
							<div class="request-info">
								<span>id: <strong><?= $request['mentorship_request_id'] ?></strong></span>
							</div>
							<div class="request-info">
								<img src="img/facs/fac-<?= $request['fac_id'] ?>.png" class="request-card-fac-img" alt="">
							</div>
							<div class="request-info">
								<span>Depatement:</span>
								<strong><?= $request['dep_name'] ?></strong>
							</div>
							<div class="request-info">
								<span>Annonce:</span>
								<strong class="request-post-title">
									<a href="/teacher_post?post_id=<?= $request['post_id'] ?>">
										<?= $request['post_title'] ?>
									</a>
								</strong>
							</div>
							<div class="request-info">
								<span>Etudiant:</span>
								<strong><?= $request['last_name'] ?> <?= $request['first_name'] ?></strong>
							</div>
							<div class="request-info">
								<span>Envoyé le:</span>
								<strong><?= $request['date'] ?></strong>
							</div>
						</div>

						<div class="request-actions">
							<button data-request-id="<?= $request['mentorship_request_id'] ?>" data-post="<?= $request['post_title'] ?>" data-theme="<?= $request['theme_title'] ?>" data-student-name="<?= $request['last_name'] ?> <?= $request['first_name'] ?>" data-student-message="<?= htmlspecialchars($request['message']) ?>" data-toggle="modal" data-target="#view-modal" class="request-actions-btn btn view">
								<i class="fas fa-search-plus fa-fw"></i>
							</button>
							<button data-request-id="<?= $request['mentorship_request_id'] ?>" data-post="<?= $request['post_title'] ?>" data-theme="<?= $request['theme_title'] ?>" data-student-name="<?= $request['last_name'] ?> <?= $request['first_name'] ?>" data-toggle="modal" data-target="#accept-modal" class="request-actions-btn btn accept">
								<i class="fas fa-check fa-fw"></i>
							</button>
							<button data-request-id="<?= $request['mentorship_request_id'] ?>" data-post="<?= $request['post_title'] ?>" data-theme="<?= $request['theme_title'] ?>" data-student-name="<?= $request['last_name'] ?> <?= $request['first_name'] ?>" data-toggle="modal" data-target="#reject-modal" class="request-actions-btn btn reject">
								<i class="fas fa-times fa-fw"></i>
							</button>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</section>
</main>
<!-- view modal -->
<div class="modal fade" id="view-modal">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Demande d'encadrement</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>
					ID de la demande: <strong id="view-modal-id-text"></strong><br>
					Nom de l'ètudiant: <strong id="view-modal-student"></strong><br>
					Annonce: <strong id="view-modal-post"></strong><br>
					Theme: <strong id="view-modal-theme"></strong>
				</p>
				<hr>
				<span class="h5">Message de l'etudiant:</span>
				<p id="view-modal-message" class="pl-2 mt-1" style="white-space: pre-line">

				</p>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				<form action="/php/action/teacher_request_responde.php" method="POST">
					<input class="view-modal-id-value" name="mentorship_request_id" type="hidden" value="">
					<input value="accepted" name="response" type="hidden">
					<button type="submit" class="btn btn-success">Accepter</button>
				</form>
				<form action="/php/action/teacher_request_responde.php" method="POST">
					<input class="view-modal-id-value" name="mentorship_request_id" type="hidden" value="">
					<input value="rejected" name="response" type="hidden">
					<button type="submit" class="btn btn-danger">Rejeter</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- accept modal -->
<div class="modal fade" id="accept-modal">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Accepter la demande</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>Étes-vous certain de vouloir accepter cette demande ?</p>
				<p>
					ID de la demande: <strong id="accept-modal-id-text"></strong><br>
					Nom de l'ètudiant: <strong id="accept-modal-student"></strong><br>
					Annonce: <strong id="accept-modal-post"></strong><br>
					Theme: <strong id="accept-modal-theme"></strong>
				</p>
			</div>

			<div class="modal-footer">
				<form action="/php/action/teacher_request_responde.php" method="POST">
					<input id="accept-modal-id-value" name="mentorship_request_id" type="hidden" value="">
					<input value="accepted" name="response" type="hidden">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-success">Accepter</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- reject modal -->
<div class="modal fade" id="reject-modal">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Rejeter la demande</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>Étes-vous certain de vouloir rejeter cette demande ?</p>
				<p>
					ID de la demande: <strong id="reject-modal-id-text"></strong><br>
					Nom de l'ètudiant: <strong id="reject-modal-student"></strong><br>
					Annonce: <strong id="reject-modal-post"></strong><br>
					Theme: <strong id="reject-modal-theme"></strong>
				</p>
			</div>

			<div class="modal-footer">
				<form action="/php/action/teacher_request_responde.php" method="POST">
					<input id="reject-modal-id-value" name="mentorship_request_id" type="hidden" value="">
					<input value="rejected" name="response" type="hidden">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="submit" class="btn btn-danger">Rejeter</button>
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
	// view modal
	$('#view-modal').on('show.bs.modal', function(event) {
		let button = $(event.relatedTarget);

		let id = button.data('request-id');
		let name = button.data('student-name');
		let message = button.data('student-message');
		let theme = button.data('theme');
		let post = button.data('post');

		let modal = $(this);
		modal.find('#view-modal-id-text').text(id);
		modal.find('.view-modal-id-value').val(id);
		modal.find('#view-modal-student').text(name);
		modal.find('#view-modal-message').text(message);
		modal.find('#view-modal-theme').text(theme);
		modal.find('#view-modal-post').text(post);

	})
	// accept modal
	$('#accept-modal').on('show.bs.modal', function(event) {
		let button = $(event.relatedTarget);

		let id = button.data('request-id');
		let name = button.data('student-name');
		let theme = button.data('theme');
		let post = button.data('post');

		let modal = $(this);
		modal.find('#accept-modal-id-text').text(id);
		modal.find('#accept-modal-id-value').val(id);
		modal.find('#accept-modal-student').text(name);
		modal.find('#accept-modal-theme').text(theme);
		modal.find('#accept-modal-post').text(post);

	})
	// reject modal
	$('#reject-modal').on('show.bs.modal', function(event) {
		let button = $(event.relatedTarget);

		let id = button.data('request-id');
		let name = button.data('student-name');
		let theme = button.data('theme');
		let post = button.data('post');

		let modal = $(this);
		modal.find('#reject-modal-id-text').text(id);
		modal.find('#reject-modal-id-value').val(id);
		modal.find('#reject-modal-student').text(name);
		modal.find('#reject-modal-theme').text(theme);
		modal.find('#reject-modal-post').text(post);

	})
</script>
