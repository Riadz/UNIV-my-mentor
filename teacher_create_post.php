<?php
$header_info = [
	'title' => 'Créer Une Annonce | Enseignants',

	'auth'       => 'teacher',
	'navigation' => 'teacher',
];
require('common/header.php')
?>

<main class="flex-grow-1 dashboard add_post">
	<section class="dashboard-section">
		<div class="container dashboard-section-container">
			<h2 class="dashboard-section-header text-center">Créer Une Annonce</h2>
			<form class="create-post-form row" action="/">
				<!-- Info -->
				<div class="col-12 mb-n2">
					<h3 class="dashboard-section-header m-0">Information</h3>
				</div>
				<div class="col-lg-6">
					<div class="input-container">
						<input name="title" type="text" class="input" placeholder=" " required />
						<label class="input-label">
							Titre<i class="mandatory-star">*</i>
						</label>
						<div class="input-underline"></div>
					</div>
					<div class="input-container">
						<select name="fac" class="input">
							<option value="1">Sci ingenorat</option>
							<option value="2">Sci biologie</option>
						</select>
						<label class="input-label">
							Faculté<i class="mandatory-star">*</i>
						</label>
						<div class="input-underline"></div>
					</div>
					<div class="input-container">
						<select name="dep" class="input">
							<option value="1">Informatique</option>
							<option value="2">Sci Teqnique</option>
						</select>
						<label class="input-label">
							Departement<i class="mandatory-star">*</i>
						</label>
						<div class="input-underline"></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="input-container">
						<textarea name="description" type="text" class="input" placeholder=" " required></textarea>
						<label class="input-label">
							Description<i class="mandatory-star">*</i>
						</label>
						<div class="input-underline"></div>
					</div>
				</div>

				<!-- Themes -->
				<div class="col-12 mt-4">
					<h3 class="dashboard-section-header">Themes</h3>
				</div>
				<div class="posts-card-container col-lg-6">
					<div class="posts-card">
						<div class="posts-card-header">
							<div>
								<h5>Theme 1<i class="mandatory-star">*</i></h5>
							</div>

							<div>
							</div>
						</div>
						<div class="input-container">
							<input name="title" type="text" class="input" placeholder=" " required />
							<label class="input-label">
								Titre<i class="mandatory-star">*</i>
							</label>
							<div class="input-underline"></div>
						</div>
						<div class="input-container">
							<textarea name="description" type="text" class="input" placeholder=" " required></textarea>
							<label class="input-label">
								Description<i class="mandatory-star">*</i>
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
				</div>

				<!-- Add theme -->
				<div class="posts-card-container col-lg-6">
					<div class="posts-add-card">
						<a href="teacher_create_post" class="posts-add-card-btn">
							<i class="fas fa-plus-circle"></i>
						</a>
					</div>
				</div>
			</form>
		</div>
	</section>
</main>

<?php
require('common/footer.php')
?>
