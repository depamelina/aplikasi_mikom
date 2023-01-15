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
						<h4 class="page-title">Daftar Tugas</h4>
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
									<a class="btn btn-danger btn-round ml-auto" href="/input-tugas">
										<i class="fa fa-plus"></i>
										Tambah
									</a>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover w-100" >
											<thead>
												<tr>
													<th>No</th>
													<th>Tanggal</th>
													<th>Nama Peserta</th>
													<th>Keterangan Tugas</th>
													<th>Jawaban</th>
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
						
						<span id="modal-body-add">
								<div class="form-group form-group-default">
									<label>Alasan</label>
									<input type="text" name="status_pre" readonly class="form-control" >
								</div>
								<div class="form-group form-group-default">
									<label>Konfirmasi</label>
									<select name="status" class="form-control">
										<option disabled="disabled" selected="selected">Pilih</option>
										<option value="2">Terima</option>
										<option value="0">Tolak</option>
									</select>
								</div>
						</span>
						
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
						<button type="button" class="btn btn-primary" id="modal-button">Tambah</button>
					</div>
				</div>
			</div>
		</div>

<script >
	getTugas();
	function getTugas() {
		var table =	$('#basic-datatables').DataTable({
			"bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true, 
            "bAutoWidth": true,
            "ordering": false,
            "sAjaxSource": '{{ URL::to('api/teach/tugas') }}',
            "aoColumns": [
                { "mData": "no",className: 'text-center' }, 
				{ "mData": "tgl_add" }, 
				{ "mData": "nama_lengkap" }, 
				{ "mData": "ctt_tugas" }, 
				{ "mData": "ctt_jawab" }, 
				{
                    "mData": "status",
                    className: 'text-center',
                    render: function (data) {
						if (data == "Selesai"){
                       	 	data ='<span class="badge badge-success">' + data + '</span>'
						} else if (data == "Proses"){
							data ='<span class="badge badge-danger">' + data + '</span>'
						} 
                        return data;
                    }
                },
				{
                    "mData": "id",
                    className: 'text-center',
                    render: function (data) {
                        data ='<div class="dropdown"> <button class="btn btn-link btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical fa-xl text-dark"></i></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a class="dropdown-item" href="/edit-tugas/'+ data +'"><i class="fa-solid fa-pen pr-2"></i> Ubah</a><a class="dropdown-item" id="btn-hapus" href="#" data-id='+ data +'"><i class="fa-solid fa-trash pr-2"></i> Hapus</a><a class="dropdown-item" href="/detail-tugas/'+ data +'"><i class="fa-solid fa-eye pr-2"></i>Detail</a></div></div>'
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
        $('.modal-header').html('Konfirmasi Absen');
        $('#modal-button').attr('onclick','return saveValid('+id+')');
        $('#modal-button').html('Simpan');
		$.ajax({
            url: "{{ URL::to('api/teach/absen/') }}/"+id,
            method: "GET",
            success: function (response) {
                $('[name="status_pre"]').val(response.data.absen);
            }
        })
        
    }

	function saveValid(id){
        data = new FormData();
	    data.append('status', $('[name="status"]').val());
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
</script>

<script>
	 $('body').on('click', '#btn-hapus', function () {
		var id = $(this).attr('data-id');
					swal({
						title: 'Hapus Data',
						icon: 'warning',
						text: "Apakah Anda yakin untuk menghapus data ini?",
						buttons:{
							cancel: {
								visible: true,
								text : 'Batal',
								className: 'btn btn-danger'
							},        			
							confirm: {
								text : 'Ya, Hapus',
								className : 'btn btn-primary'
							}
						}
					}).then((willDelete) => {
						if (willDelete) {

							$.ajax({
									url : "{{ URL::to('api/teach/tugas') }}/"+id,
									method: "DELETE",
									cache: false,
									buttons: false,
									success:function(response){ 
										getTugas();
										swal("Data berhasil dihapus!", {
										icon: "success",
										});

									}
								});	
						} else {
							
						}
					});
				})

</script>


</body>
</html>