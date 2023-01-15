<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}
<style>
	.dropdown-toggle::after {
    display: none;
}
</style>

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

		{{ view('component.sidebar2') }}

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Pengajuan Absen</h4>
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
									<!-- <div class="d-flex align-items-center">
										<a href="/export-users" class="btn btn-success btn-round ml-auto">
											<i class="fas fa-arrow-down"></i>
											Eksport
										</a>
									</div> -->
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover w-100" >
											<thead>
												<tr>
													<th>No</th>
													<th>Tanggal Pengajuan</th>
													<th>Nama Peserta</th>
													<th>Absen</th>
													<th>Keterangan</th>
													<th>Status</th>
													<th>Aksi</th>
												</tr>
											</thead>
	
											<tbody>
												<tr>
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
</div>

{{ view('component.script') }}

<div id="addModal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="text-align:center">
						<h3 id="modal-header"></h3>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						
						<input type="hidden" name="id">
						<input type="hidden" name="dari_tgl">
						<input type="hidden" name="sampai_tgl">
						<input type="hidden" name="username">
						
						<span id="modal-body-add">
								<div class="form-group form-group-default">
									<label>Alasan</label>
									<p id="alasan" class="pt-2"></p>
								</div>
								<div class="form-group form-group-default">
									<label>Keterangan</label>
									<p id="ket"  class="pt-2"></p>
								</div>
								<div class="form-group form-group-default">
									<label>Konfirmasi</label>
									<select name="status" class="form-control">
										<option value="2">Terima</option>
									</select>
								</div>
						</span>

						<span id="modal-body-detail">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label> <b> Alasan Absen</b></label>
											<p id="absen"></p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Keterangan Absen</b></label>
											<p id="ket2"></p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Tanggal Pengajuan</b></label>
											<p id="tgl_pengajuan"></p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Tanggal Absen</b></label>
											<p id="tgl_absen"></p>
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Status</b></label>
											<p id="status"></p>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label><b>Surat</b></label>
											<p> <button class="btn btn-sm btn-success">buka</button> </p>
										</div>
									</div>
								</div>							
						</span>
						
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">tutup</button>
					</div>
				</div>
			</div>
		</div>

<script >
	getAbsen();
	function getAbsen() {
		var table =	$('#basic-datatables').DataTable({
			"bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true, 
            "bAutoWidth": true,
            "ordering": false,
            "sAjaxSource": '{{ URL::to('api/teach/absen') }}',
            "aoColumns": [
                { "mData": "no",className: 'text-center' }, 
				{ "mData": "tgl_pengajuan" }, 
				{ "mData": "nama_lengkap" }, 
				{ "mData": "absen" },
				{ "mData": "ket_absen" }, 
				{
                    "mData": "status",
                    className: 'text-center',
                    render: function (data) {
						if (data == "Dikonfirmasi"){
                       	 	data ='<span class="badge badge-success">' + data + '</span>'
						} else if (data == "Ditolak"){
							data ='<span class="badge badge-danger">' + data + '</span>'
						} else {
							data ='<span class="badge badge-dark">' + data + '</span>'
						}
                          return data;
                    }
                },
				{
                    "mData": "id",
                    className: 'text-center',
                    render: function (data) {
						data ='<div class="dropdown"> <button class="btn btn-link btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical fa-xl text-dark"></i></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="#" onclick="return validasi(' + data + ')"><i class="fa-solid fa-circle-check pr-2"></i> Konfirmasi</a><a class="dropdown-item" href="#" onclick="return detail(' + data + ')"><i class="fa-solid fa-eye pr-2"></i>Detail</a></div></div>'
                        return data;
                    }
                }              
            ],
            stateSave: true,
            "bDestroy": true
			});
		}	
			
	function validasi(id){
        $('#addModal').modal('show');
        $('#modal-body-add').show();
		$('#modal-body-detail').hide();
        $('.modal-header').html('Konfirmasi Absen');
        $('#modal-button').attr('onclick','return saveValid('+id+')');
        $('#modal-button').html('Simpan');
		$.ajax({
            url: "{{ URL::to('api/teach/absen/') }}/"+id,
            method: "GET",
            success: function (response) {
				var text = response.data.absen;
				text = text.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
                $('#alasan').html(text);
                $('[name="status"]').val(response.data.status);
				$('[name="dari_tgl"]').val(response.data.dari_tgl);
				$('[name="sampai_tgl"]').val(response.data.sampai_tgl);
				$('[name="id"]').val(response.data.id);
				$('[name="username"]').val(response.data.username);
				var str = response.data.ket_absen;
				str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				$('#ket').html(str);
				
            }
        })
        
    }

	function saveValid(id){
        data = new FormData();
	    data.append('status', $('[name="status"]').val());
		data.append('ket', $('[name="ket"]').val());
		data.append('dari_tgl', $('[name="dari_tgl"]').val());
		data.append('sampai_tgl', $('[name="sampai_tgl"]').val());
		data.append('username', $('[name="username"]').val());
		data.append('status_pre', $('[name="status_pre"]').val());
    
        $.ajax({
            url : "{{ URL::to('api/teach/absen') }}/"+id,
        	method : "POST",
        	data : data,
            processData: false,
            contentType: false,
        	success: function(response){
        	    getAbsen();
        	    $('#addModal').modal('hide');
        	}
        })
    }

	function detail(id){
        $('#addModal').modal('show');
        $('#modal-body-add').hide();
		$('#modal-body-detail').show();
        $('.modal-header').html('Detail Absen');
        $('#modal-button').attr('onclick','return saveValid('+id+')');
        $('#modal-button').html('Simpan');
		$.ajax({
            url: "{{ URL::to('api/user/absen/') }}/"+id,
            method: "GET",
            success: function (response) {
				var text = response.data.absen;
				text = text.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
                $('#absen').html(text);
				var str = response.data.ket_absen;
				str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
					return letter.toUpperCase();
				});
				$('#ket2').html(response.data.ket_absen);
                $('#status').html(response.data.status);
				$('#tgl_pengajuan').html(response.data.tgl_pengajuan);
				$('#tgl_absen').html(response.data.dari_tgl + " sampai " + response.data.sampai_tgl);
				$('#status').html(response.data.status);
				
            }
        })
        
    }

</script>


</body>
</html>