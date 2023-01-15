        <div class="main-header" data-background-color="red">
			<!-- Logo Header -->
			<div class="logo-header">
				
				<a href="index.html" class="logo">
					<img src="{{ asset('template/assets/img/logo-mikom.png') }}" width="100px" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{!! asset('images/'.session('foto'))!!}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<!-- <div class="avatar-lg"><img src="{{ asset('template/assets/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded"></div> -->
										<div class="u-text">
											<h4>{{ session('nama_lengkap') }}</h4>
											<p class="text-muted">{{ session('username') }}</p>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" onclick="return logout()" href="#"><i class="fas fa-right-from-bracket text-danger"></i>  Logout</a>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

	<script>
			function logout(){
				$.ajax({
					url : "{{ URL::to('api/logout') }}",
					method : "GET",
					success: function(response){
						window.location = "{{ URL::to('/') }}/";
					}
				})
			}
  </script>