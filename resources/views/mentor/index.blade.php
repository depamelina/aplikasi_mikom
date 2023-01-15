<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

    
         {{ view('component.sidebar2') }}
			
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Dashboard</h4>
						<div class="btn-group btn-group-page-header ml-auto">
							<button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-ellipsis-h"></i>
							</button>
							<div class="dropdown-menu">
								<div class="arrow"></div>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<a class="dropdown-item" href="#">Something else here</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Separated link</a>
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-sm-6 col-md-9">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Data Peserta Magang</div>
										<div class="card-tools">
											<a href="/input-tugas" class="btn btn-danger btn-round btn-sm">
												<span class="btn-label">
													<!-- <i class="fa fa-print"></i> -->
												</span>
												Input Tugas
											</a>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="chart-container" style="min-height: 200px">
										<div class="row">
										<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr class="text-center">
													<th>No</th>
													<th>Nama Peserta Magang</th>
													<th>Divisi</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-success">
												<i class="fas fa-user-check"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Peserta Aktif</p>
												<h4 class="card-title">{{ $a }}</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="card card-stats card-round">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-icon">
													<div class="icon-big text-center icon-danger">
														<i class="fas fa-user-xmark"></i>
													</div>
												</div>
												<div class="col col-stats ml-3 ml-sm-0">
													<div class="numbers">
														<p class="card-category">Peserta Tidak Aktif</p>
														<h4 class="card-title">{{ $n }}</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="card card-stats card-round">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-icon">
													<div class="icon-big text-center icon-danger">
														<i class="fas fa-user-xmark"></i>
													</div>
												</div>
												<div class="col col-stats ml-3 ml-sm-0">
													<div class="numbers">
														<p class="card-category">Pengajuan Absen</p>
														<h4 class="card-title">{{ $p }}</h4>
													</div>
													<div>
														<a href="/mentor-absen" class="btn btn-sm btn danger">
															Detail
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="card card-stats card-round">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-icon">
													<div class="icon-big text-center icon-success">
														<i class="fas fa-user-xmark"></i>
													</div>
												</div>
												<div class="col col-stats ml-3 ml-sm-0">
													<div class="numbers">
														<p class="card-category">Hadir Hari Ini</p>
														<h4 class="card-title">{{ $h }}</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-md-12">
									<div class="card card-stats card-round">
										<div class="card-body">
											<div class="row align-items-center">
												<div class="col-icon">
													<div class="icon-big text-center icon-danger">
														<i class="fas fa-user-xmark"></i>
													</div>
												</div>
												<div class="col col-stats ml-3 ml-sm-0">
													<div class="numbers">
														<p class="card-category">Tidak Hadir</p>
														<h4 class="card-title">{{ $th }}</h4>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
	
	</div>
</div>

{{ view('component.script') }}

<script >
	getIndex();
	function getIndex() {
		var table =	$('#basic-datatables').DataTable({
			"bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true, 
            "bAutoWidth": true,
            "ordering": false,
            "sAjaxSource": '{{ URL::to('api/admin/teach-dashboard') }}',
            "aoColumns": [
                { "mData": "no",className: 'text-center' }, 
                { "mData": "nama_lengkap" }, 
				{ "mData": "divisi" }, 
				{ "mData": "status",className: 'text-center',
			 	}, 
            ],
            stateSave: true,
            "bDestroy": true
			});
		}	
</script>
</body>
</html>