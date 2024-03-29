

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
	<span class="svg-icon">
		<!--begin::Svg Icon | path:<?= base_url() ?>/assets/media/svg/icons/Navigation/Up-2.svg-->
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				<polygon points="0 0 24 0 24 24 0 24" />
				<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
				<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
			</g>
		</svg>
		<!--end::Svg Icon-->
	</span>
</div>
<!--end::Scrolltop-->

<script>
	var HOST_URL = "<?= base_url() ?>";
</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
	var KTAppSettings = {
		"breakpoints": {
			"sm": 576,
			"md": 768,
			"lg": 992,
			"xl": 1200,
			"xxl": 1400
		},
		"colors": {
			"theme": {
				"base": {
					"white": "#ffffff",
					"primary": "#3699FF",
					"secondary": "#E5EAEE",
					"success": "#1BC5BD",
					"info": "#8950FC",
					"warning": "#FFA800",
					"danger": "#F64E60",
					"light": "#E4E6EF",
					"dark": "#181C32"
				},
				"light": {
					"white": "#ffffff",
					"primary": "#E1F0FF",
					"secondary": "#EBEDF3",
					"success": "#C9F7F5",
					"info": "#EEE5FF",
					"warning": "#FFF4DE",
					"danger": "#FFE2E5",
					"light": "#F3F6F9",
					"dark": "#D6D6E0"
				},
				"inverse": {
					"white": "#ffffff",
					"primary": "#ffffff",
					"secondary": "#3F4254",
					"success": "#ffffff",
					"info": "#ffffff",
					"warning": "#ffffff",
					"danger": "#ffffff",
					"light": "#464E5F",
					"dark": "#ffffff"
				}
			},
			"gray": {
				"gray-100": "#F3F6F9",
				"gray-200": "#EBEDF3",
				"gray-300": "#E4E6EF",
				"gray-400": "#D1D3E0",
				"gray-500": "#B5B5C3",
				"gray-600": "#7E8299",
				"gray-700": "#5E6278",
				"gray-800": "#3F4254",
				"gray-900": "#181C32"
			}
		},
		"font-family": "Poppins"
	};
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->

<script src="<?= base_url() ?>/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="<?= base_url() ?>/assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="<?= base_url() ?>/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="<?= base_url() ?>/assets/js/pages/widgets.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/custom/wizard/wizard-1.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/crud/forms/validation/form-widgets.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/custom/wizard/wizard-6.js"></script>

<!-- validations-->
<?php $uri = service('uri');?>
<?php if ($uri->getSegment(2) == 'personal') { ?>
	<script src="<?= base_url() ?>/assets/js/validations/admission-profile.js"></script>
<?php } ?>
<?php if ($uri->getSegment(2) == 'family') { ?>
	<script src="<?= base_url() ?>/assets/js/validations/admission-family.js"></script>
<?php } ?>
<!-- end validation-->
<script>
	function showFire(type, text) {
		Swal.fire({
			text: text,
			icon: type,
			buttonsStyling: false,
			confirmButtonText: "Ok, got it!",
			customClass: {
				confirmButton: "btn font-weight-bold btn-light"
			}
		}).then(function() {
			KTUtil.scrollTop();
		});
	};
	<?php if (session('toastr')) : ?>
		<?php foreach (session('toastr') as $k => $v) : ?>

			showFire(`<?= $k ?>`, `<?= $v ?>`);

		<?php endforeach; ?>
	<?php endif; ?>
</script>
<script>
  function myFunction(x) {
  if (x.matches) { // If media query matches
    $('.web-menu').removeAttr('id');
    $('.mob-menu').attr('id','kt_quick_user_toggle');
  } else {
    $('.mob-menu').removeAttr('id');
    $('.web-menu').attr('id','kt_quick_user_toggle');
  }
}

var x = window.matchMedia("(max-width: 1023px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction)
  </script>
<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	});
	var KTBootstrapDatepicker  = function () {
		var arrows;
 if (KTUtil.isRTL()) {
  arrows = {
   leftArrow: '<i class="la la-angle-right"></i>',
   rightArrow: '<i class="la la-angle-left"></i>'
  }
 } else {
  arrows = {
   leftArrow: '<i class="la la-angle-left"></i>',
   rightArrow: '<i class="la la-angle-right"></i>'
  }
 }
// Private functions
var dob = function () {
 
 // input group and left alignment setup
  // minimum setup for modal demo
  
  $('#dob').datepicker({
   rtl: KTUtil.isRTL(),
   todayHighlight: true,
   orientation: "bottom left",
   templates: arrows,
   format: 'dd-mm-yyyy',
  });


}

return {
  // public functions
  init: function() {
	dob();
  }
 };
}();

jQuery(document).ready(function() {
 KTBootstrapDatepicker.init();
});
</script>
<script>
    $("form[name=once]").submit(function() {
        $(this).submit(function() {
            return false;
        });
        return true;
    });
</script>
<script src="<?= base_url() ?>/assets/js/pages/crud/forms/widgets/select2.js"></script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>