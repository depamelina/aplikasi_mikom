		<div class="sidebar">	
			<div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{!! asset('images/'.session('foto'))!!}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ session('nama_lengkap') }}
									<span class="user-level">Admin</span>
									<!-- <span class="caret"></span> -->
								</span>
							</a>
							<div class="clearfix"></div>

							<!-- <div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
								</ul>
							</div> -->
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item active">
							<a href="/admin">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fas fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menu</h4>
						</li>
						<li class="nav-item">
							<a href="/teach">
								<i class="fas fa-user-tie"></i>
								<p>Pembimbing</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/users">
								<i class="fas fa-user-group"></i>
								<p>Peserta Magang</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/divisi">
								<i class="fas fa-briefcase"></i>
								<p>Divisi</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/jamkerja">
								<i class="fas fa-clock"></i>
								<p>Jadwal</p>
							</a>
						</li>
						<!-- <li class="nav-item">
							<a href="/level">
								<i class="fas fa-chart-bar"></i>
								<p>Level</p>
							</a>
						</li> -->
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-history"></i>
							</span>
							<h4 class="text-section">Magang</h4>
						</li>
						<li class="nav-item">
							<a href="/user-history">
								<i class="fas fa-history"></i>
								<p>Riwayat Kehadiran</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/user-keg">
								<i class="fas fa-calendar-week"></i>
								<p>Kegiatan Harian</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/user-nilai">
								<i class="fas fa-file-lines"></i>
								<p>Nilai</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-history"></i>
							</span>
							<h4 class="text-section">Laporan</h4>
						</li>
						<li class="nav-item">
							<a href="/report">
								<i class="fas fa-book-open"></i>
								<p>Keseluruhan</p>
							</a>
						</li>
					</ul>
					</div>
			</div>
		</div>