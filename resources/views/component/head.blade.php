<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>MIKOM</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('template/assets/img/icon.ico') }}" type="image/x-icon"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Fonts and icons -->
	<script src="{{ asset('template/assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/assets/css/azzara.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/assets/js/plugin/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/assets/js/plugin/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('template/assets/css/demo.css') }}">
</head>