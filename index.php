<?php
$header_info = [
	'title' => 'Mon Encadreur | System d\'encadrement UTSB',
];
require('common/header.php')
?>

<?php
session_start();
if (isset($_SESSION['user']['user_id'])) {
	var_dump($_SESSION['user']);
}
?>
<main>
	<section id="landing-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 d-flex flex-column text-lg-left text-center">
					<h1>
						Site De Gestion D'Encadrement
					</h1>
					<p>
						Un siteweb ou les etudiants de l'université
						d'annaba peuve rechercher
						et organizer leurs projets, et communiquer
						facilement avec leur encadreurs.
					</p>
					<a href="#acc-cta" class="btn-1 mx-lg-0 mx-auto">Créer un compte</a>
				</div>
				<div class="col-lg-6 text-lg-left text-center">
					<img src="img/graduation_hat.svg" alt="graduation hat" class="landing-page-ilust" />
				</div>
			</div>
		</div>
	</section>
	<section id="students" class="feature">
		<div class="container">
			<h2 class="underlined-1">
				<i class="fas fa-user-graduate"></i>
				<span>Pour Étudiants</span>
			</h2>
			<div class="row pt-5">
				<div class="col-lg-7 feature-carousel">
					<div class="feature-carousel-wrapper">
						<div class="feature-carousel-container owl-carousel">
							<!-- card 1 -->
							<div class="feature-carousel-card">
								<div class="feature-carousel-card-text">
									<h3 class="underlined-1">
										<i class="fas fa-search"></i>
										<span>Rechercher</span>
									</h3>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Officiis rerum laboriosam veritatis voluptas deserunt veniam
										delectus deleniti consequuntur aspernatur dolore.
									</p>
								</div>
								<img src="img/cards/students-1.jpg" alt="" class="feature-carousel-card-bg">
							</div>
							<!-- card 2 -->
							<div class="feature-carousel-card">
								<div class="feature-carousel-card-text">
									<h3 class="underlined-1">
										<i class="fas fa-chalkboard-teacher"></i>
										<span>Organizer</span>
									</h3>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Officiis rerum laboriosam veritatis voluptas deserunt veniam
										delectus deleniti consequuntur aspernatur dolore.
									</p>
								</div>
								<img src="img/cards/students-2.jpg" alt="" class="feature-carousel-card-bg">
							</div>
							<!-- card 3 -->
							<div class="feature-carousel-card">
								<div class="feature-carousel-card-text">
									<h3 class="underlined-1">
										<i class="fas fa-comments"></i>
										<span>Communiquer</span>
									</h3>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Officiis rerum laboriosam veritatis voluptas deserunt veniam
										delectus deleniti consequuntur aspernatur dolore.
									</p>
								</div>
								<img src="img/cards/students-3.jpg" alt="" class="feature-carousel-card-bg">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 feature-text d-flex align-items-center ">
					<p>
						Lorem, ipsum dolor sit amet consectetur <strong>adipisicing</strong> elit. Neque et dolorum nemo,
						illum laudantium reprehenderit <strong>excepturi</strong> quos aliquid cum quidem,
						repudiandae unde nesciunt <strong>optio eius</strong> porro illo dolores consectetur! Iure.
					</p>
				</div>
			</div>
		</div>
	</section>
	<section id="teachers" class="feature">
		<div class="container">
			<h2 class="underlined-1">
				<i class="fas fa-user-tie"></i>
				<span>Pour Enseignant</span>
			</h2>
			<div class="row pt-5">
				<div class="col-lg-5 feature-text d-flex align-items-center ">
					<p>
						Lorem, ipsum dolor sit amet consectetur <strong>adipisicing</strong> elit. Neque et dolorum nemo,
						illum laudantium reprehenderit <strong>excepturi</strong> quos aliquid cum quidem,
						repudiandae unde nesciunt <strong>optio eius</strong> porro illo dolores consectetur! Iure.
					</p>
				</div>
				<div class="col-lg-7 feature-carousel">
					<div class="feature-carousel-wrapper">
						<div class="feature-carousel-container owl-carousel">
							<!-- card 1 -->
							<div class="feature-carousel-card">
								<div class="feature-carousel-card-text">
									<h3 class="underlined-1">
										<i class="fas fa-graduation-cap"></i>
										<span>Encadrer</span>
									</h3>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Officiis rerum laboriosam veritatis voluptas deserunt veniam
										delectus deleniti consequuntur aspernatur dolore.
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Officiis rerum laboriosam veritatis voluptas deserunt veniam
										delectus deleniti consequuntur aspernatur dolore.
									</p>
								</div>
								<img src="img/cards/teachers-1.jpg" alt="" class="feature-carousel-card-bg">
							</div>
							<!-- card 2 -->
							<div class="feature-carousel-card">
								<div class="feature-carousel-card-text">
									<h3 class="underlined-1">
										<i class="fas fa-users"></i>
										<span>Organizer</span>
									</h3>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Officiis rerum laboriosam veritatis voluptas deserunt veniam
										delectus deleniti consequuntur aspernatur dolore.
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Officiis rerum laboriosam veritatis voluptas deserunt veniam
										delectus deleniti consequuntur aspernatur dolore.
									</p>
								</div>
								<img src="img/cards/teachers-2.jpg" alt="" class="feature-carousel-card-bg">
							</div>
							<!-- card 3 -->
							<div class="feature-carousel-card">
								<div class="feature-carousel-card-text">
									<h3 class="underlined-1">
										<i class="fas fa-comments"></i>
										<span>Communiquer</span>
									</h3>
									<p>
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Officiis rerum laboriosam veritatis voluptas deserunt veniam
										delectus deleniti consequuntur aspernatur dolore.
										Lorem ipsum dolor sit amet consectetur adipisicing elit.
										Officiis rerum laboriosam veritatis voluptas deserunt veniam
										delectus deleniti consequuntur aspernatur dolore.
									</p>
								</div>
								<img src="img/cards/teachers-3.jpg" alt="" class="feature-carousel-card-bg">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="acc-cta" class="acc-cta">
		<div class="container">
			<h2 class="underlined-1">
				<span>Créer un Compte Maintenant</span>
			</h2>
			<div class="d-flex flex-column align-items-center">
				<h3>Vous êtes un/une ?</h3>
				<div class="acc-cta-container">
					<a href="#">
						<i class="fas fa-user-tie"></i>
						<span>Enseignant</span>
					</a>
					<div class="acc-cta-divivder">Ou</div>
					<a href="student_auth">
						<i class="fas fa-user-graduate"></i>
						<span>Étudiant</span>
					</a>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
require('common/footer.php')
?>
