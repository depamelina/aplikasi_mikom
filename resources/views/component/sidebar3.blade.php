		<div class="sidebar">	
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{!! asset('images/'.session('foto'))!!}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample2" aria-expanded="true">
								<span>
								{{ session('nama_lengkap') }}
									<span class="user-level">Peserta Magang</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample2">
								<ul class="nav">
									<li>
										<a href="/user-profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="/user">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<!-- <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fas fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu</h4>
						</li>
						-->
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Magang</h4>
						</li>
						<li class="nav-item">
							<a href="/user-tugas">
								<i class="fas fa-file"></i>
								<p>Tugas</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/user-absen">
								<i class="fas fa-envelope-open-text "></i>
								<p>Absen</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/user-history">
								<i class="fas fa-history"></i>
								<p>Riwayat Kehadiran</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="user-keg">
								<i class="fas fa-book"></i>
								<p>Kegiatan Harian</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/user-nilai">
								<i class="fas fa-list"></i>
								<p>Nilai</p>
							</a>
						</li>
					</ul>
					</div>
			</div>
		</div>