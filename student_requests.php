<?php
$header_info = [
	'title' => 'Mes Demandes | Etudiants',

	'auth' => 'student',
];
require('common/header.php')
?>

<?php

use App\Student;

$Student = new Student();
$requests =
	$Student->getStudentDashboardRequests(
		$_SESSION['user']['type_data']['student_id']
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
								<span>Enseignant:</span>
								<strong><?= $request['last_name'] ?> <?= $request['first_name'] ?></strong>
							</div>
							<div class="request-info">
								<span>Envoyé le:</span>
								<strong><?= $request['date'] ?></strong>
							</div>
						</div>

						<div class="request-actions">
							<div class="request-info" style="width: 123px;">
								<?php if ($request['status'] == 'pending') : ?>
									<span>Etat: <strong class="text-warning">En attente</strong></span>
									<i class="far fa-clock fa-3x text-warning"></i>
								<?php elseif ($request['status'] == 'accepted') : ?>
									<span>Etat: <strong class="text-success">Accepté</strong></span>
									<i class="far fa-check-circle fa-3x text-success"></i>
								<?php else : ?>
									<span>Etat: <strong class="text-danger">Rejetée</strong></span>
									<i class="far fa-times-circle fa-3x text-danger"></i>
								<?php endif ?>
							</div>
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
