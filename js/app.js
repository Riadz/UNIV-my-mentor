/* ====== Index ====== */
// carousel
$('.owl-carousel').owlCarousel({
  items: 1,
  dots: true,
  smartSpeed: 450,
  margin: 50,
  responsive: {
  }
});

// auth toggle
$('.auth-toggle-btn').on('click', function () {
  target = $(this).attr('target');

  $(this).addClass('active');
  $(this).siblings().removeClass('active');

  $('.auth-form').not(target).hide();
  $(`.${target}`).fadeIn(600);

  $('.auth-error').hide();
});

/* ====== Student ====== */


/* ====== Teacher ====== */
// adding themes in add post
var themeTabsCount = 1;
$('#add-theme-btn').click(function () {
  themeTabsCount++;
  $('.create-post-form .delete-theme-btn').hide('fast');
  $('#add-theme-tab').before(`
<div id="theme-${themeTabsCount}" class="posts-card-container col-lg-6">
<div class="posts-card">
	<div class="posts-card-header">
	  <div><h5>Theme ${themeTabsCount}</h5></div>
    <div><button target="${themeTabsCount}" class="delete-theme-btn posts-card-actions-btn" type="button" title="supprimer">
      <i class="fas fa-times"></i>
    </div></button>
	</div>
	<div class="input-container">
		<input name="theme_title_${themeTabsCount}" type="text" class="input" placeholder=" " required />
		<label class="input-label">
			Titre<i class="mandatory-star">*</i>
		</label>
		<div class="input-underline"></div>
	</div>
	<div class="input-container">
		<textarea name="theme_description_${themeTabsCount}" type="text" class="input" placeholder=" " required></textarea>
		<label class="input-label">
			Description<i class="mandatory-star">*</i>
		</label>
		<div class="input-underline"></div>
	</div>
</div>
</div>
    `);
  if (themeTabsCount === 5)
    $('#add-theme-tab').hide('fast');
});

// deleting themes in add post
$('.create-post-form').on('click', '.delete-theme-btn', function (e) {
  let target = $(e.target).attr('target');
  $(`#theme-${target}`).remove();
  themeTabsCount--;
  $(`.create-post-form #theme-${themeTabsCount} .delete-theme-btn`).show('fast');
  if (!$('#add-theme-tab').is(":visible"))
    $('#add-theme-tab').show('fast');
})

// faculté/departement select
updateDepSelect();
$('select[name="fac"]')
  .change(function () {
    updateDepSelect();
  });
function updateDepSelect() {
  let facId = $('select[name="fac"]').val();

  $('select[name="dep"]')
    .children()
    .prop('selected', false)
    .hide();

  $('select[name="dep"]')
    .children(`option[fac-id="${facId}"]`)
    .show()
    .first()
    .prop('selected', true);
}

/* ====== Bootstrap ====== */
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})
