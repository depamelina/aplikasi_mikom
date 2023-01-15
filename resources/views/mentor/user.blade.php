<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

		{{ view('component.sidebar2') }}

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Data Peserta</h4>
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
										<a href="/export-users" class="btn btn-success btn-round ml-auto">
											<i class="fas fa-arrow-down"></i>
											Eksport
										</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover w-100" >
											<thead>
												<tr>
													<th>No</th>
													<th>Foto</th>
													<th>Nama Lengkap</th>
													<th>Divisi</th>
													<th>Asal Sekolah</th>
													<th>Email</th>
													<th>No WA</th>
													<th>ID Telegram</th>
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

<script >
	getDivisi();
	function getDivisi() {
		var table =	$('#basic-datatables').DataTable({
			"bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true, 
            "bAutoWidth": true,
            "ordering": false,
            "sAjaxSource": '{{ URL::to('api/teach/users') }}',
            "aoColumns": [
                { "mData": "no",className: 'text-center' }, 
                { "mData": "foto",
                    className: 'text-center', 
                    render: function (data) {
                        data = '<img src="{{ URL::to('images') }}/'+data+'" style="border-radius:50%;height:80px;width:80px" />';
                        return data;
                    }
                },
				{ "mData": "nama_lengkap" }, 
				{ "mData": "divisi" }, 
				{ "mData": "asal_sekolah" }, 
				{ "mData": "email" }, 
				{ "mData": "no_tlp" }, 
				{ "mData": "id_tele" },               
            ],
            stateSave: true,
            "bDestroy": true
			});
		}	
			
	function remove(id){
        $('#addModal').modal('show');
        $('#modal-body-add').hide();
        $('#modal-body-delete').show();
        $('.modal-header').html('Hapus User');
        $('#modal-button').attr('onclick','return saveRemove('+id+')');
        $('#modal-button').html('Delete');
        
    }
	function saveRemove(id){
        $.ajax({
            url : "{{ URL::to('api/admin/users') }}/"+id,
        	method : "DELETE",
            processData: false,
            contentType: false,
        	success: function(response){
        	    getDivisi();
        	    $('#addModal').modal('hide');
        	}
        })
    }

	
</script>


<script>
	 $('body').on('click', '#btn-delete-post', function () {
		var id = $(this).attr('data-id');
					swal({
						title: 'Hapus Data',
						icon: 'warning',
						text: "Apakah Anda yakin untuk menghapus data ini?",
						type: 'warning',
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
									url : "{{ URL::to('api/admin/users') }}/"+id,
									method: "DELETE",
									cache: false,
									success:function(response){ 
										getDivisi();
										swal("Data berhasil dihapus!", {
										icon: "success",
										});

									}
								});	
						} else {
							swal("Data tidak terhapus!", {
								buttons : {
									confirm : {
										className: 'btn btn-primary'
									}
								}
							});
						}
					});
				})

</script>
</body>
</html>