<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

		{{ view('component.sidebar') }}
        <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header mb-4">
						<h4 class="page-title">Laporan Kehadiran</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Tables</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Datatables</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
										<div class="d-flex align-items-center">
											<!-- @php if(session('id_level')=='mentor' || session('id_level')=='admin'){ @endphp -->
											<div class="col-md-3">
												<label for="" class="mb-1">Dari</label>
												<input type="date" name="dari" id="dari" class="form-control">
											</div>
											<div class="col-md-3">
												<label for="" class="mb-1">Sampai</label>
												<input type="date" name="sampai" id="sampai" class="form-control">
											</div>
											<div class="col-md-2">
												<button class="btn btn-danger mt-3" id="btn-cari"  onclick="return getAttendance()">
													<i class="fas fa-magnifying-glass"></i>
													Cari
												</button>
											</div>
											<div class="col-md-2">
												<a class="btn btn-success mt-3 ml-2" id="btn-excel" onclick="this.href='/exportexcel/'+ document.getElementById('dari').value + '/' + document.getElementById('sampai').value ">
													<i class="fas fa-download"></i>
													Excel
												</a>
											</div>
											<div class="col-md-2">
												<button class="btn btn-danger mt-3 ml-3">
													<i class="fas fa-download"></i>
													PDF
												</button>
											</div>
											<!-- @php } @endphp -->
										</div>
									<div class="d-flex align-items-center">
										<div class="col-md-6 mt-1">
											<small class="text-danger" id="info-tgl"></small>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="display table table-striped table-hover w-100 text-center" >
											<thead>
												<tr>
													<th rowspan="2">Tanggal</th>
													<th rowspan="2">Nama Lengkap</th>
													<th rowspan="2">Divisi</th>
													<th colspan="2">Jadwal</th>
                                                    <th colspan="2">Presensi</th>
												</tr>
                                                <tr>
                                                    <th>Masuk</th>
                                                    <th>Pulang</th>
                                                    <th>Masuk</th>
                                                    <th>Pulang</th>
                                                </tr>
											</thead>
											<tbody id="table-report">
                                                <tr>
                                                    <td colspan="7">Tidak Ada Data</td>
                                                </tr>
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

        {{ view('component.script') }}

    <script>

		firstLoad();
		function firstLoad(){
			$('#btn-cari').attr('disabled',true);
			$('#btn-excel').attr('disabled',true);
		}

        function getAttendance(){		
            data = new FormData();
            data.append('dari', $('[name="dari"]').val());
            data.append('sampai', $('[name="sampai"]').val());
            $.ajax({
                url : "{{ URL::to('api/report-all') }}",
                method : "POST",
                data : data,
                processData: false,
                contentType: false,
                success: function(response){
                    html = "";
					
					if ($.isEmptyObject(response.data))
					{
						html += "<tr>"
                            +"<td colspan="+7+">Data Tidak Ditemukan</td>"
                            +"</tr>";
                    	$('#table-report').html(html);
						
					} else {
                    	for(i=0;i<response.data.length;i++){
                        var in_date = response.data[i].time_in;
                        var out_date = response.data[i].time_out;
                        if(in_date==null){in_date="";}
                        if(out_date==null){out_date="";}
                        html += "<tr>"
                            +"<td>"+response.data[i].tanggal+"</td>"
                            +"<td>"+response.data[i].nama_lengkap+"</td>"
                            +"<td>"+response.data[i].divisi+"</td>"
                            +"<td>"+response.data[i].jam_in+"</td>"
                            +"<td>"+response.data[i].jam_out+"</td>"
                            +"<td>"+in_date+"</td>"
                            +"<td>"+out_date+"</td>"
                            +"</tr>";
						}
						$('#table-report').html(html);
					}
                }
            })
        }

		$("body").on('change', '#sampai', function() {
		var dari = new Date($('[name="dari"]').val());
        var sampai = new Date($('[name="sampai"]').val());
        diff  = new Date(sampai - dari),
        day  = diff/1000/60/60/24;
        if(day<0){
			$('#btn-cari').attr('disabled',true);
			$('#btn-excel').attr('disabled',true);
			$('#info-tgl').show();
			$('#info-tgl').html('* cek kembali tanggalnya');
			return;}
		if(day>=0){
			$('#btn-cari').attr('disabled',false);
			$('#btn-excel').attr('disabled',false);
			$('#info-tgl').hide();
			return;}
        html="";
	});

	$("body").on('change', '#dari', function() {
		var dari = new Date($('[name="dari"]').val());
        var sampai = new Date($('[name="sampai"]').val());
        diff  = new Date(sampai - dari),
        day  = diff/1000/60/60/24;
        if(day<0){
			$('#btn-cari').attr('disabled',true);
			$('#btn-excel').attr('disabled',true);
			$('#info-tgl').show();
			$('#info-tgl').html('* cek kembali tanggalnya');
			return;}
		if(day>=0){
			$('#btn-cari').attr('disabled',false);
			$('#btn-excel').attr('disabled',false);
			$('#info-tgl').hide();
			return;}
        html="";
	});

    </script>

	

</body>
</html>