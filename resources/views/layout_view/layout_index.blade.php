<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" sizes="180x180" href="{{ asset('rose.ico') }}">
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset("custom/fontawesome-free-5.15.4/css/all.min.css") }}">
	<link rel="stylesheet" href="{{ asset("custom/bootstrap-5.1.3/css/bootstrap.min.css") }}">
	<link rel="stylesheet" href="{{ asset("custom/css/navbar.css") }}">
	<link rel="stylesheet" href="{{ asset("custom/css/tabs.css") }}">
	<link rel="stylesheet" href="{{ asset("custom/main.css") }}">
	<script type="text/javascript" src="{{ asset("custom/jquery-3.6.0.min.js") }}"></script>

</head>
<body class="bg-dark">
	<div class="container-fluid bg-dark p-0">
		<div class="row p-0">
			@include('layout_view.header_view')
			@include('layout_view.baner_view')
		</div>
		<div class="row">
			<div class="content wf-95 wf-md-80 mb-5 rounded slide-hide-content">
				<div class="row">
					<div class="col-md-4 col-12 mb-3 n-left pe-md-5 ps-3 pe-3">
						@include('layout_view.sidebar_view')
					</div>
					<div class="col-md-8 col-11 ms-auto me-auto content-s">
						@yield('content')
					</div>
				</div>
			</div>
		</div>
		@include('layout_view.footer_view')
	</div>

	<div id="totop" class="d-none">
		<button class="btn"><i class="fas fa-caret-square-up"></i></button>
	</div>
	<script type="text/javascript" src="{{ asset("custom/js/navbar.js") }}"></script>
	<script type="text/javascript" src="{{ asset("custom/bootstrap-5.1.3/js/bootstrap.min.js") }}">
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $(window).scroll(function(){
			 var height = $(window).scrollTop();
			 if (height >= 530){
			 	$('#totop').removeClass('d-none')
			 }
			 else{
			 	$('#totop').addClass('d-none')
			 }
			})

			$('#totop').on('click', function(){
				$(window).scrollTop(0)
			})

			$(".drop-down .selected a").click(function() {
			    $(".drop-down .options ul").toggle();
			});

			//SELECT OPTIONS AND HIDE OPTION AFTER SELECTION
			$(".drop-down .options ul li a").click(function() {
			    var text = $(this).html();
			    $(".drop-down .selected a span").html(text);
			    $(".drop-down .options ul").hide();
			});

			$(document).bind('click', function(e) {
		    var $clicked = $(e.target);
		    if (! $clicked.parents().hasClass("drop-down"))
		        $(".drop-down .options ul").hide();
			});

			$('.menuClick').click(function(){
				$(this).toggleClass('rotate_');
				$('.nav-m').toggleClass('menutranform');
			})
			
		});
	</script>
	@yield('js')
</body>
</html>
