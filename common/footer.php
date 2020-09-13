<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-12 footer-text">
				<div class="footer-logo">
					<img src="img/logo-alt.svg" alt="Mon Encadreur white logo" />
					<span>Mon Encadreur</span>
				</div>
				<p>
					Un siteweb ou les etudiants de l'université d'annaba
					peuve rechercher et organizer leurs projets
				</p>
			</div>
			<div class="col-lg-6 col-12 footer-text">
				<div class="footer-logo footer-logo-alt">
					<img src="img/UTSB-white.png" alt="UTSB annaba white logo" />
					<p class="text-left ml-4">
						université badji mokhtar - annaba<br>
						جامعة باجي مختار - عنابة
					</p>
				</div>
			</div>
			<div class="col-12 mt-5 text-center">
				<p>Copyright &copy; Mon Encadreur <?= date('Y') ?>. All rights reserved</p>
			</div>
		</div>
	</div>
	<div class="bg-dark mt-2">
		<div class="footer-copyright text-center py-3">
			Crée par
			<a href="https://github.com/Riadz" class="footer-link" target="_blank">
				Riad Hachemane et Nour Ala Eddine
			</a>
		</div>
	</div>
</footer>

<!-- external scripts -->
<script src="./js/libs/jquery.min.js"></script>
<script src="./js/libs/popper.min.js"></script>
<script src="./js/libs/bootstrap.min.js"></script>
<script src="./js/libs/owl.carousel.min.js"></script>

<!-- scripts -->
<script src="./js/app.js"></script>

<!-- generated script -->
<?php
// active page
$active_page = NULL;

preg_match(
	'/\/[^\/\?\.]*/',
	$_SERVER['REQUEST_URI'],
	$match
);

$active_page = $match[0] ?? NULL;
?>
<script>
	<?php if (!is_null($active_page)) : ?>
		$('.navbar-nav a[href="<?= $active_page ?>"]').parent().addClass('active');
	<?php endif ?>
</script>
</body>

</html>
