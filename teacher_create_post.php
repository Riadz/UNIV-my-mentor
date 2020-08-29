<?php
$header_info = [
	'title' => 'Créer Une Annonce | Enseignants',

	'auth'       => 'teacher',
	'navigation' => 'teacher',
];
require('common/header.php')
?>

<?php

use App\Teacher;

$Teacher = new Teacher();

$facs = $Teacher->getFacArray();
$deps = $Teacher->getDepArray();
?>
<main class="flex-grow-1 dashboard add_post">
	<section class="dashboard-section">
		<div class="container dashboard-section-container">
			<h2 class="dashboard-section-header text-center">Créer Une Annonce</h2>
			<form action="/php/action/teacher_create_post.php" method="POST" class="create-post-form row">
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
							<?php foreach ($facs as $fac) : ?>
								<option value="<?= $fac['fac_id'] ?>">
									<?= $fac['fac_name'] ?>
								</option>
							<?php endforeach ?>
						</select>
						<label class="input-label">
							Faculté<i class="mandatory-star">*</i>
						</label>
						<div class="input-underline"></div>
					</div>
					<div class="input-container">
						<select name="dep" class="input">
							<?php foreach ($deps as $dep) : ?>
								<option value="<?= $dep['dep_id'] ?>" fac-id="<?= $dep['fac_id'] ?>">
									<?= $dep['dep_name'] ?>
								</option>
							<?php endforeach ?>
						</select>
						<label class="input-label">
							Departement<i class="mandatory-star">*</i>
						</label>
						<div class="input-underline"></div>
					</div>
					<div class="input-container">
						<select name="year" class="input">
							<option value="1">1er Licence</option>
							<option value="2">2eme Licence</option>
							<option value="3">3eme Licence</option>
							<option value="4">1er Master</option>
							<option value="5">2eme Master</option>
						</select>
						<label class="input-label">
							Année<i class="mandatory-star">*</i>
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

				<!-- themes -->
				<div class="col-12 mt-4">
					<h3 class="dashboard-section-header">Themes</h3>
				</div>
				<div id="theme-1" class="posts-card-container col-lg-6">
					<div class="posts-card">
						<div class="posts-card-header">
							<div>
								<h5>Theme 1<i class="mandatory-star">*</i></h5>
							</div>
							<div>
							</div>
						</div>
						<div class="input-container">
							<input name="theme_1_title" type="text" class="input" placeholder=" " required />
							<label class="input-label">
								Titre<i class="mandatory-star">*</i>
							</label>
							<div class="input-underline"></div>
						</div>
						<div class="input-container">
							<textarea name="theme_1_description" type="text" class="input" placeholder=" " required></textarea>
							<label class="input-label">
								Description<i class="mandatory-star">*</i>
							</label>
							<div class="input-underline"></div>
						</div>
					</div>
				</div>

				<!-- add theme btn -->
				<div id="add-theme-tab" class="posts-card-container col-lg-6">
					<div class="posts-add-card">
						<button id="add-theme-btn" class="posts-add-card-btn" type="button">
							<i class="fas fa-plus-circle"></i>
						</button>
					</div>
				</div>

				<!-- submit btn -->
				<div class="col-12 ">
					<button class="btn btn-1 mx-auto mt-4" type="submit">
						<i class="fas fa-plus fa-lg mr-2"></i>
						Créer L'annonce
					</button>
				</div>
			</form>
		</div>
	</section>
</main>

<?php
require('common/footer.php')
?>
