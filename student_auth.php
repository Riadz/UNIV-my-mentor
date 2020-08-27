<?php
$header_info = [
	'title' => 'Se connecter | Étudiants',
];
require('common/header.php')
?>

<?php
if (isset($_SESSION['user'])) {
	header('location: ../../');
	exit;
}

//
$signup_tab = $login_tab = '';
if (isset($_GET['signup_tab']))
	$signup_tab = 'active';
else
	$login_tab = 'active';
?>
<main class="auth">
	<div class="auth-wrapper">
		<div class="auth-toggle">
			<button class="auth-toggle-btn <?= $login_tab ?>" target="student-login">Se Connecter</button>
			<button class="auth-toggle-btn <?= $signup_tab ?>" target="student-signup">Crée Un Compte</button>
		</div>
		<?php if (isset($_GET['error'])) : ?>
			<div class="auth-error">
				<?= htmlspecialchars($_GET['error']) ?>
			</div>
		<?php endif ?>
		<div>
			<form class="auth-form student-login <?= $login_tab ?>" action="php/action/login.php?type=student" method="POST">
				<div class="input-container">
					<input name="email" type="email" class="input" placeholder=" " required />
					<label class="input-label">
						Email
					</label>
					<div class="input-underline"></div>
				</div>
				<div class="input-container">
					<input name="password" type="password" class="input" placeholder=" " required />
					<label class="input-label">
						Mote de pass
					</label>
					<div class="input-underline"></div>
				</div>
				<button class="btn">
					<i class="fas fa-sign-in-alt fa-lg"></i>
					Se Connecter
				</button>
				<input type="hidden" name="type" value="student">
			</form>

			<form class="auth-form student-signup <?= $signup_tab ?>" action="php/action/student_signup.php" method="POST">
				<div class="row">
					<div class="col-12">
						<div class="input-container pin" style="width:100px;margin-right:auto;margin-left:auto">
							<input name="pin" type="number" class="input" placeholder=" " required />
							<label class="input-label">
								Code pin
							</label>
							<div class="input-underline"></div>
							<i title="Se code est donnée a votre departement" class="far fa-question-circle fa-2x pin-tooltip" data-toggle="tooltip" data-placement="top"></i>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="last_name" type="text" class="input" placeholder=" " required />
							<label class="input-label">
								Nom
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="first_name" type="text" class="input" placeholder=" " required />
							<label class="input-label">
								Prénom
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
					<div class="col-12">
						<div class="input-container" style="max-width: 100%;">
							<input name="email" type="email" class="input" placeholder=" " required />
							<label class="input-label">
								Email
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="password" type="password" class="input" placeholder=" " required />
							<label class="input-label">
								Mote de pass
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="password_conf" type="password" class="input" placeholder=" " required />
							<label class="input-label">
								Confirmer mote de pass
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
				</div>
				<button class="btn">
					<i class="fas fa-user-plus fa-lg"></i>
					Crée Compte
				</button>
			</form>
		</div>
	</div>
</main>

<?php
require('common/footer.php')
?>
