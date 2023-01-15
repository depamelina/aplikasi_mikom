<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

    
         {{ view('component.sidebar') }}
			
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
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-success bubble-shadow-small">
												<i class="fas fa-users"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Pembimbing</p>
												<h4 class="card-title"> <b>{{ $jml }} </b> </h4>
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
											<div class="icon-big text-center icon-info bubble-shadow-small">
												<i class="fas fa-user-check"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Peserta Aktif</p>
												<h4 class="card-title"> <b>{{ $akt }}</b> </h4>
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
											<div class="icon-big text-center icon-primary bubble-shadow-small">
												<i class="fas fa-user-xmark"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Peserta Tidak Aktif</p>
												<h4 class="card-title"><b>{{ $nonakt }}</b></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-secondary bubble-shadow-small">
												<i class="far fa-check-circle"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Order</p>
												<h4 class="card-title">576</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					</div>
					<div class="row justify-content-center">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-success bubble-shadow-small">
												<i class="fas fa-users"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Hadir Hari Ini</p>
												<h4 class="card-title"> <b>{{ $h }} </b> </h4>
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
											<div class="icon-big text-center icon-info bubble-shadow-small">
												<i class="fas fa-user-check"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Tidak Hadir</p>
												<h4 class="card-title"> <b>{{ $th }}</b> </h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-info bubble-shadow-small">
												<i class="fas fa-user-check"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Belum Presensi</p>
												<h4 class="card-title"> <b>{{ $bp }}</b> </h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					</div>

					<div class="row justify-content-center">
						<div class="col-md-10">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div>Data Pembimbing dan Peserta</div>
										<!-- <div class="card-tools">
											<a href="#" class="btn btn-info btn-border btn-round btn-sm">
												<span class="btn-label">
													<i class="fa fa-print"></i>
												</span>
												Print
											</a>
										</div> -->
									</div>
								</div>
								<div class="card-body">
									<div class="chart-container" style="min-height: 200px">
										<div class="row">
										<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Pembimbing</th>
													<th>Divisi</th>
													<th>Jumlah Peserta</th>
													<th>Detail</th>
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
						
					</div>
				</div>
			</div>
			
		</div>
		
	
	</div>
</div>

		<div id="Modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="text-align:center">
						<h3 id="modal-header"></h3>
					</div>
				
					<input type="hidden" name="id">

					<div class="pr-3 pl-3">
						<table class="display table table-hover w-100 p-2" >
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Nama</th>
								</tr>
								<tbody id="modal-body-date">

								</tbody>
							</thead>		
						</table>	
					</div>	
					
					<div class="col-md-2 mb-1 ml-auto">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
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
            "sAjaxSource": '{{ URL::to('api/admin/teach-dash') }}',
            "aoColumns": [
                { "mData": "no",className: 'text-center' }, 
                { "mData": "nama_lengkap" }, 
				{ "mData": "divisi" }, 
				{ "mData": "total",className: 'text-center' }, 
				{
                    "mData": "username",
                    className: 'text-center',
                    render: function (data) {
                        data = '<a href="#" class="btn btn-link btn-primary" onclick="return getDetail(`'+ data +'`)"> <i class="fa fa-eye"></i></a>';
                        return data;
                    }
                }
            ],
            stateSave: true,
            "bDestroy": true
			});
		}	

		function getDetail(username) {
		$('#Modal').modal('show');
        $('.modal-header').html('Detail Data Peserta Magang');
        $.ajax({
            url: "{{ URL::to('api/admin/data-user') }}/"+username,
            method: "GET",
            success: function (response) {
                var html = '';
                for(i=0;i<response.data.length;i++){
                    html += '<tr>'
						+'<td class="text-center">'
						+ [i+1]
						+'</td>'
						+'<td>'
    					+ response.data[i].nama_lengkap
						+'</td>'
						+'</tr>'
    					;
                }
                $('#modal-body-date').html(html);
           }
        })
		}

</script>
</body>
</html>