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

        {{ view('component.sidebar') }}

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header mb-4">
						<h4 class="page-title">Teach</h4>
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
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<a href="/export-teach" class="btn btn-success btn-round ml-auto">
											<i class="fas fa-arrow-down"></i>
											Eksport
										</a>
										<button class="btn btn-danger btn-round ml-2" onclick="add()">
											<i class="fa fa-plus"></i>
											Tambah
										</button>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover w-100" >
											<thead>
												<tr>
													<th>No</th>
													<th>Foto</th>
													<th>Nama</th>
													<th>Divisi</th>
													<th>Email</th>
													<th>No HP</th>
													<th>ID Telegram</th>
													<th width="150">Aksi</th>
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
		
		<div id="addModal" class="modal fade" tabindex="-1">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header" style="text-align:center">
						<h3 id="modal-header"></h3>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						
						<input type="hidden" name="id">
						
						<span id="modal-body-add">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label>Nama</label>
										<input name="nama_lengkap" type="text" class="form-control" >
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label class="fto">Foto</label>
										<input name="foto" type="file" class="image form-control" >
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label>Username</label>
										<input name="username" id="username" type="text" class="form-control">
									</div>
									<div class="messages text-danger">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label>Password</label>
										<input name="password" type="password" class="form-control" >
										<!-- <div class="show-password">
											<i class="fa-regular fa-eye"></i>
										</div> -->
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label>Divisi</label>
										<select name="id_divisi" id="id_divisi" class="form-control">
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label>Email</label>
										<input name="email" type="email" class="form-control" >
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label>No HP</label>
										<input name="no_tlp" type="text" class="form-control" >
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group form-group-default">
										<label>ID Telegram</label>
										<input name="id_tele" type="text" class="form-control" >
									</div>
								</div>

								<!-- <div class="form-group form-group-default">
									<label>Foto</label>
									<input name="foto" type="file" class="form-control" >
								</div> -->
							</div>
						</span>
						
						<span id="modal-body-delete" class="row p-3">
							Anda yakin akan menghapus <b id="nameHapus"></b>?
						</span>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
						<button type="button" class="btn btn-primary" id="modal-button">Tambah</button>
						<button type="button" class="btn btn-primary" data-id="id" id="modal-button-edit">Edit</button>
					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>

{{ view('component.script') }}

<script >

	getCboDivisi();
    function getCboDivisi(){
        $.ajax({
            url: "{{ URL::to('api/admin/divisi') }}",
            method: "GET",
            success: function (response) {
                html="";
                for(i=0;i<response.data.length;i++){
                    html += '<option value="'+response.data[i].id+'">'+response.data[i].divisi+'</option>"';
                } 
                $('[name="id_divisi"]').html(html);
            }
        })
    }

	getDivisi();
	function getDivisi() {
		var table =	$('#basic-datatables').DataTable({
			"bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true, 
            "bAutoWidth": true,
            "ordering": false,
            "sAjaxSource": '{{ URL::to('api/admin/teach') }}',
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
				{ "mData": "email" }, 
				{ "mData": "no_tlp" }, 
				{ "mData": "id_tele" }, 
                {
                    "mData": "username",
                    className: 'text-center',
                    render: function (data) {
                        data ='<div class="dropdown"> <button class="btn btn-link btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical fa-xl text-dark"></i></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><a id="btn-update" href="#" class="dropdown-item" data-id="'+ data +'"><i class="fa-solid fa-pen pr-2"></i> Ubah</a><a class="dropdown-item" id="btn-del" href="#"  data-id="'+ data +'"><i class="fa-solid fa-trash pr-2"></i> Hapus</a><a class="dropdown-item" href="/detail-tugas/'+ data +'"><i class="fa-solid fa-eye pr-2"></i>Detail</a></div></div>'
                        return data;
                    }
                }    
            ],
            stateSave: true,
            "bDestroy": true
			});
		}	

	function add(){
        $('#addModal').modal('show');
        $('#modal-body-add').show();
        $('#modal-body-delete').hide();
		$('#modal-button-edit').hide();
		$('#modal-button').show();
        $('.modal-header').html('Tambah Pembimbing');
		$('.fto').html('Foto');
        
        $('[name="username"]').val("");
		$('[name="foto"]').val("");
		$('[name="nama_lengkap"]').val("");
		$('[name="password"]').val("");
		$('[name="id_divisi"]').val("");
		$('[name="email"]').val("");
		$('[name="no_tlp"]').val("");
		$('[name="id_tele"]').val("");

        
        $('#modal-button').attr('onclick','return saveAdd()');
        $('#modal-button').html('Tambah');
    }

	function saveAdd(){
		var foto = $('[name="foto"]');

		var selectDiv = document.getElementById("id_divisi");
		var nama_lengkap = $('[name="nama_lengkap"]').val(); 
		var username = $('[name="username"]').val(); 
		var password = $('[name="password"]').val(); 
		
		if (nama_lengkap == ""){
			alert("Isi nama lengkap");
			return false;
		}else if (password == ""){
			alert("Isi password");
			return false;
		}else if (selectDiv.value === "") {
			alert("Pilih Divisi");
			return false;
		}else if (username == ""){
			alert("Isi Username");
			return false;
		}
        data = new FormData();
	    data.append('username', $('[name="username"]').val());
		data.append('foto', foto);
		data.append('nama_lengkap', $('[name="nama_lengkap"]').val());
		data.append('password', $('[name="password"]').val());
		data.append('id_divisi', $('[name="id_divisi"]').val());
		data.append('email', $('[name="email"]').val());
		data.append('no_tlp', $('[name="no_tlp"]').val());
		data.append('id_tele', $('[name="id_tele"]').val());
		
		if(foto.val()!=""){
	        data.append('foto', $('[name="foto"]')[0].files[0]); 
	    }
		
    
        $.ajax({
            url : "{{ URL::to('api/admin/teach') }}",
        	method : "POST",
        	data : data,
            processData: false,
            contentType: false,
        	success: function(response){
        	    getDivisi();
        	    $('#addModal').modal('hide');
        	},
			error: function(response){
			   var errors = response.responseJSON.errors;

               var errorsHtml = '<div class=""><ul>';

               $.each( errors, function( key, value ) {
                   errorsHtml += '<li>'+ value[0] + '</li>';
               });
               errorsHtml += '</ul></div';

               $('.messages').html(errorsHtml);

			   var username = document.getElementById("username");
			   username.focus();
			}

        })

    }

	$('body').on('click', '#btn-update', function () {
        var id = $(this).attr('data-id');
        $('#addModal').modal('show');
        $('#modal-body-add').show();
        $('#modal-body-delete').hide();
        $('.modal-header').html('Ubah Pembimbing');
		$('.fto').html('Ubah Foto');
        $('#modal-button').hide();
		$('#modal-button-edit').show();
        
		$('body').on('click', '#modal-button-edit', function () {
		var foto = $('[name="foto"]');
		data = new FormData();
		data.append('username', $('[name="username"]').val());
		data.append('foto', $('[name="foto"]').val());
		data.append('nama_lengkap', $('[name="nama_lengkap"]').val());
		data.append('password', $('[name="password"]').val());
		data.append('id_divisi', $('[name="id_divisi"]').val());
		data.append('email', $('[name="email"]').val());
		data.append('no_tlp', $('[name="no_tlp"]').val());
		data.append('id_tele', $('[name="id_tele"]').val());	

		if(foto.val()!=""){
	        data.append('foto', $('[name="foto"]')[0].files[0]); 
	    }

        $.ajax({
            url : "{{ URL::to('api/admin/teach') }}/"+id,
        	method : "POST",
        	data : data,
            processData: false,
            contentType: false,
        	success: function(response){
        	    getDivisi();
        	    $('#addModal').modal('hide');
        	}
        })

	})

        $.ajax({
            url: "{{ URL::to('api/admin/teach/') }}/"+id,
            method: "GET",
            success: function (response) {
                $('[name="username"]').val(response.data.username);
				$('[name="nama_lengkap"]').val(response.data.nama_lengkap);
				$('[name="password"]').val(response.data.password);
				$('[name="id_divisi"]').val(response.data.id_divisi);
				$('[name="email"]').val(response.data.email);
				$('[name="no_tlp"]').val(response.data.no_tlp);
				$('[name="id_tele"]').val(response.data.id_tele);
            }
        })
	})

</script>

<script>
	 $('body').on('click', '#btn-del', function () {
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
									url : "{{ URL::to('api/admin/teach') }}/"+id,
									method: "DELETE",
									cache: false,
									buttons: false,
									success:function(response){ 
										getDivisi();
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