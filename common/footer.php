<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-12 footer-text">
				<div class="footer-logo">
					<img src="img/logo-alt.svg" alt="Mon Encadreur white logo" />
					<span>Mon Encadreur</span>
				</div>
				<p class="mt-lg-5">
					Un siteweb ou les etudiants de l'université d'annaba
					peuve rechercher et organizer leurs projets
				</p>
				<p>Copyright &copy; Mon Encadreur <?= date('Y') ?>. All rights reserved</p>
			</div>
			<div class="col-lg-5 col-12 footer-text">
				<div class="footer-logo footer-logo-alt">
					<img src="img/UTSB-white.png" alt="UTSB annaba white logo" />
				</div>
				<p>
					université badji mokhtar - annaba<br>
					جامعة باجي مختار - عنابة
				</p>
				<p>Copyright © <?= date('Y') ?> www.univ-annaba.dz - Tous droits réservés</p>
			</div>
			<div class="col-lg-2 col-12 footer-list">
				<h5>Navigation</h5>
				<hr class="bg-white accent-2 d-inline-block my-0 mb-2 mx-auto" style="width: 60px;">
				<ul>
					<li><a href="/ll">Help center</a></li>
					<li><a href="#">Contact support</a></li>
					<li><a href="#">Instructions</a></li>
					<li><a href="#">How it works</a></li>
				</ul>
			</div>
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
