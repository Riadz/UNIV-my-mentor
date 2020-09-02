<?php
$header_info = [
	'title' => 'Recherche | Etudiant',

	'auth'       => 'student',
	'navigation' => 'student',
];
require('common/header.php')
?>

<?php

use App\Teacher;

$Teacher = new Teacher();

$facs = $Teacher->getFacArray();
$deps = $Teacher->getDepArray();

?>
<main class="search">
	<div class="container">
		<div class="search-box">
			<div class="search-box-bg">
				<!-- carousel -->
				<div class="carousel slide carousel-fade" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="img/cards/students-1.jpg" class="d-block w-100" alt="">
						</div>
						<div class="carousel-item">
							<img src="img/cards/teachers-1.jpg" class="d-block w-100" alt="">
						</div>
						<div class="carousel-item">
							<img src="img/cards/students-2.jpg" class="d-block w-100" alt="">
						</div>
						<div class="carousel-item">
							<img src="img/cards/teachers-2.jpg" class="d-block w-100" alt="">
						</div>
						<div class="carousel-item">
							<img src="img/cards/students-3.jpg" class="d-block w-100" alt="">
						</div>
						<div class="carousel-item">
							<img src="img/cards/teachers-3.jpg" class="d-block w-100" alt="">
						</div>
					</div>
				</div>
			</div>
			<form class="search-box-form" action="student_search.php" method="GET">
				<h1 class="search-box-form-header w-100">
					Recherche
				</h1>
				<div class="search-box-form-text w-100">
					<div class="input-group">
						<input name="search" type="text" class="form-control" required>

						<div class="input-group-append">
							<select name="type" class="custom-select">
								<option selected>Tout</option>
								<option value="1">Titre du post</option>
								<option value="2">Nom d'enseignant</option>
							</select>
						</div>
					</div>
				</div>
				<div class="search-box-form-selects w-100">
					<div class="input-container">
						<select name="fac" class="input">
							<?php foreach ($facs as $fac) : ?>
								<option value="<?= $fac['fac_id'] ?>">
									<?= $fac['fac_name'] ?>
								</option>
							<?php endforeach ?>
						</select>
						<label class="input-label">
							Faculté
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
							Departement
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
							Année
						</label>
						<div class="input-underline"></div>
					</div>
				</div>
				<button class="search-box-form-btn btn btn-1 mx-auto" type="submit">
					<i class="fas fa-search fa-lg mr-2"></i>
					Rechercher
				</button>
			</form>
		</div>
	</div>
</main>
<?php
require('common/footer.php')
?>
