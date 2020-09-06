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
		<div class="auth-header">
			<h2>
				<i class="fas fa-user-tie"></i>
				<span>Pour Enseignants</span>
			</h2>
			<a href="student_auth?signup_tab" class="auth-header-link">
				je suis un <strong>Étudiant</strong>
			</a>
		</div>
		<div class="auth-toggle">
			<button class="auth-toggle-btn <?= $login_tab ?>" target="teacher-login">Se Connecter</button>
			<button class="auth-toggle-btn <?= $signup_tab ?>" target="teacher-signup">Crée Un Compte</button>
		</div>
		<?php if (isset($_GET['error'])) : ?>
			<div class="auth-error">
				<?= htmlspecialchars($_GET['error']) ?>
			</div>
		<?php endif ?>
		<div>
			<form class="auth-form teacher-login <?= $login_tab ?>" action="php/action/login.php?type=teacher" method="POST">
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
				<input type="hidden" name="type" value="teacher">
			</form>

			<form class="auth-form teacher-signup <?= $signup_tab ?>" action="php/action/teacher_signup.php" method="POST">
				<div class="row">
					<div class="col-12">
						<div class="input-container pin" style="width:100px;margin-right:auto;margin-left:auto">
							<input name="pin" type="number" class="input" placeholder=" " required />
							<label class="input-label">
								Code pin
							</label>
							<div class="input-underline"></div>
							<i title="Se code sera distribué a tous les enseignants" class="far fa-question-circle fa-2x pin-tooltip" data-toggle="tooltip" data-placement="top"></i>
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
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="public_email" type="text" class="input" placeholder=" " required />
							<label class="input-label">
								Email public
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="public_number" type="text" class="input" placeholder=" " />
							<label class="input-label">
								Numero public
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
