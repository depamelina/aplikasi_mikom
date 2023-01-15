<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/icon.ico" type="image/x-icon"/>
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

</head>
<body class="login">

  <div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<h3 class="text-center" style="color:#f2545d">Login</h3>
            <b id="msg"></b>
            <form id="Login">
                <div class="login-form">
                    <div class="form-group form-floating-label">
                        <input id="username" name="username" type="text" class="form-control input-border-bottom" required>
                        <label for="username" class="placeholder">Username</label>
                    </div>
                    <div class="form-group form-floating-label">
                        <input id="password" name="password" type="password" class="form-control input-border-bottom" required>
                        <label for="password" class="placeholder">Password</label>
                        <div class="show-password">
                            <i class="fa-regular fa-eye fa-xs" style="color:#f2545d"></i>
                        </div>
                    </div>
                    <div class="form-action mb-3">
                        <a href="#" onclick="return login()" class="btn btn-danger btn-rounded btn-login">Sign In</a>
                    </div>
                    <!-- <div class="login-account">
                        <span class="msg">Don't have an account yet ?</span>
                        <a href="#" id="show-signup" class="link">Sign Up</a>
                    </div> -->
                </div>
            </form>
		</div>


	</div>

	<script src="{{ asset('template/assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('template/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('template/assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('template/assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('template/assets/js/ready.js') }}"></script>

    <script>
    function login(){
        var form = document.getElementById('Login');
        var data = new FormData(form);
        $.ajax({
          type: 'POST',
          url: "{{ url('api/login') }}",
          data: data,
          contentType: false,
          cache: false,
          processData: false,
          success: function(response) {
            var status = "false";
            
            //mngurai data array response
            $.each(response, function( index, value ) {
                
                //jika response message = true
                if(value.message=="true"){
                    status = value.data.id_level;
                }
            });
            
            //jika username  dan password tidk sesuai
            if(status == "false"){
              $('#msg').html('<b class="text-danger">Failed Sign In!</b> ');
            }else{
              //jika username dan password sesuai    
              $('#msg').html('<b class="text-success">Success Sign In!</b>');
              setTimeout(function(){
                window.location = "{{ URL::to('/') }}/"+status;
              }, 1000);
            }
          }, error: function(response){
            console.log(response.responseText);
            $('#msg').html('<b class="text-danger">ERROR</b>');
          }
        });
    }
</script>

</body>
</html>