<?php
$header_info = [
	'title' => 'Se connecter | Étudiants',
];
require('common/header.php')
?>

<main class="auth">
	<div class="auth-wrapper">
		<div class="auth-toggle">
			<button class="auth-toggle-btn active" target="student-login">Se Connecter</button>
			<button class="auth-toggle-btn" target="student-signup">Crée Un Compte</button>
		</div>
		<div>
			<form class="auth-form student-login active" action="/" method="POST">
				<div class="input-container">
					<input name="email" type="email" class="input" placeholder=" " />
					<label class="input-label">
						Email
					</label>
					<div class="input-underline"></div>
				</div>
				<div class="input-container">
					<input name="password" type="password" class="input" placeholder=" " />
					<label class="input-label">
						Mote de pass
					</label>
					<div class="input-underline"></div>
				</div>
				<button class="btn">
					<i class="fas fa-sign-in-alt fa-lg"></i>
					Se Connecter
				</button>
			</form>

			<form class="auth-form student-signup" action="/" method="POST">
				<div class="row">
					<div class="col-12">
						<div class="input-container pin" style="width:100px;margin-right:auto;margin-left:auto">
							<input name="pin" type="number" class="input" placeholder=" " />
							<label class="input-label">
								Code pin
							</label>
							<div class="input-underline"></div>
							<i title="Se code est donnée a votre departement" class="far fa-question-circle fa-2x pin-tooltip" data-toggle="tooltip" data-placement="top"></i>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="first-name" type="text" class="input" placeholder=" " />
							<label class="input-label">
								Nom
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="last-name" type="text" class="input" placeholder=" " />
							<label class="input-label">
								Prénom
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
					<div class="col-12">
						<div class="input-container" style="max-width: 100%;">
							<input name="email" type="email" class="input" placeholder=" " />
							<label class="input-label">
								Email
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="password" type="password" class="input" placeholder=" " />
							<label class="input-label">
								Mote de pass
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
					<div class="col-sm-6 col-12">
						<div class="input-container">
							<input name="password-conf" type="password" class="input" placeholder=" " />
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
