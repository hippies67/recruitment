<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Wilio Survey, Quotation, Review and Register form Wizard by Ansonika.">
	<meta name="author" content="Ansonika">
	<title>Recruitment | Tahungoding</title>
	<!-- Favicons-->
	<link rel="shortcut icon" href="{{ asset('assets/back/images/tahu.png') }}" type="image/x-icon">


	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/menu.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/vendors.css') }}" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

	<!-- MODERNIZR MENU -->
	<script src="{{ asset('js/modernizr.js') }}"></script>

</head>

<body>

	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->

	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->

	<nav>
		<ul class="cd-primary-nav">
			<li><a href="#" class="animated_link">Home</a></li>
			<li><a href="qa" class="animated_link">Q & A</a></li>
			<li><a href="contact" class="animated_link">Contact</a></li>
		</ul>
	</nav>
	<!-- /menu -->

	<div class="container-fluid full-height">
		<div class="row row-height">
			<!-- /content-left -->
			@yield('content')
			<!-- /content-right-->
		</div>
		<!-- /row-->
	</div>
	<!-- /container-fluid -->

	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>
	<!-- /cd-overlay-content -->

	<a href="#0" class="cd-nav-trigger">Menu<span class="cd-icon"></span></a>
	<!-- /menu button -->

	<!-- Modal terms -->
	<div class="modal fade" id="terms-txt" tabindex="-1" role="dialog" aria-labelledby="termsLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="termsLabel">Terms and conditions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>,
						mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus,
						pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam
						dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt
						sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum
						accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum
						sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam
						dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt
						sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<!-- COMMON SCRIPTS -->
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js/common_scripts.min.js') }}"></script>
	<script src="{{ asset('js/velocity.min.js') }}"></script>
	<script src="{{ asset('js/functions.js') }}"></script>

	<!-- Wizard script -->
	{{-- <script src="{{ asset('js/jquery-wizard.js') }}"></script> --}}
	<script src="{{ asset('js/survey_func.js') }}"></script>

	@yield('js')
</body>

</html>