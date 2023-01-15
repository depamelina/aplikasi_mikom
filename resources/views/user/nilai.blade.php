<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" /><body>

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

		@php if(session('id_level')=='user'){ @endphp
        <!-- Sidebar -->
        {{ view('component.sidebar3') }}
        @php } 
        if(session('id_level')=='admin'){ @endphp
        <!-- Sidebar -->
        {{ view('component.sidebar') }}
        @php } 
        if(session('id_level')=='mentor'){ @endphp
        <!-- Sidebar -->
        {{ view('component.sidebar2') }}
        @php } @endphp

        <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header mb-4">
						<h4 class="page-title">Nilai</h4>
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
										@php if(session('id_level')=='mentor' || session('id_level')=='admin'){ @endphp
										<div class="col-md-3">
											<label for="" class="mb-1">Peserta</label>
											<select name="karyawan" id="e1" class="form-control mb-1 pt-2 pb-1">
											</select>
										</div>
										<div class="col-md-3">
											<button class="btn btn-danger mt-3" onclick="return searchLoad()">
												<i class="fas fa-magnifying-glass"></i>
												Cari
											</button>
										</div>
										<!-- <div class="col-md-3">
											<button class="btn btn-danger mt-3" onclick="return searchLoad()">
												<i class="fas fa-magnifying-glass"></i>
												PDF
											</button>
										</div> -->
										@php } @endphp
										@php if(session('id_level')=='user' ){ @endphp
										<button class="btn btn-success btn-sm btn-round ml-auto" onclick="reply()">
											<i class="fa-solid fa-upload"></i>
											Upload File
										</button>
										<button class="btn btn-primary btn-sm btn-round ml-2" onclick="reply()">
											<i class="fas fa-reply"></i>
											Pengajuan
										</button>
										<button class="btn btn-danger btn-sm btn-round ml-2" onclick="add()">
											<i class="fa fa-plus"></i>
											Tambah
										</button>
										@php } @endphp
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover w-100" >
											<thead>
												<tr>
													<th>No</th>
													<th>Kriteria</th>
													<th>Nilai</th>
													@php if(session('id_level')=='user' || session('id_level')=='mentor'){ @endphp
													<th>Aksi</th>
													@php } @endphp
												</tr>
											</thead>
											<tbody>
											</tbody>
											<tfoot align="right">
												<tr>
													<th></th>
													<th></th>
													<th></th>
											</tfoot>
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
										<label>Kriteria Nilai</label>
										<input name="kriteria" type="text" class="form-control" placeholder="Masukkan Kriteria">
								</div>
						</span>
						<span id="modal-body-nilai">
								<div class="form-group form-group-default">
										<label>Kriteria Nilai</label>
										<input name="kriteria" type="text" class="form-control" placeholder="Masukkan Kriteria" readonly>
								</div>
								<div class="form-group form-group-default">
										<label>Nilai</label>
										<input name="nilai" type="text" class="form-control" placeholder="Masukkan Nilai">
								</div>
						</span>

						<span id="modal-body-rep">
								<div class="form-group form-group-default">
									<label>File Permohonan Nilai</label>
									<input name="form_nilai" type="file" required class="form-control">
								</div>

								<small class="text-danger">Mohon Cek Kembali Kriteria Nilai</small> <br>
								<small>Kirim permohonan nilai kepada pembimbing?</small>
						</span>
						
						<span id="modal-body-delete" class="row p-3">
							Anda yakin akan menghapus <b id="nameHapus"></b>?
						</span>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
						<button type="button" class="btn btn-primary" id="modal-button">Tambah</button>
					</div>
				</div>
			</div>
		</div>

{{ view('component.script') }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script >
		$(document).ready(function() { 
			$( "#e1" ).select2({
				theme: "bootstrap"
			});
			$( "#e2" ).select2({
				theme: "bootstrap"
			});
			$( "#e3" ).select2({
				theme: "bootstrap"
			});
		});

		getNilai();		
		@php if(session('id_level')=='mentor'){ @endphp
		getCboKaryawan()
		function getCboKaryawan(){
			$.ajax({
				url: "{{ URL::to('api/teach/users') }}",
				method: "GET",
				success: function (response) {
					html="";
					for(i=0;i<response.data.length;i++){
						html += '<option value="'+response.data[i].username+'">'+response.data[i].nama_lengkap+'</option>"';
					} 
					$('[name="karyawan"]').html(html);
					$('[name="karyawan"]').val("{{ session('username') }}");
				}
			})
		}
		@php } @endphp

		@php if(session('id_level')=='admin'){ @endphp
		getCboKaryawan()
		function getCboKaryawan(){
			$.ajax({
				url: "{{ URL::to('api/admin/users') }}",
				method: "GET",
				success: function (response) {
					html="";
					for(i=0;i<response.data.length;i++){
						html += '<option value="'+response.data[i].username+'">'+response.data[i].nama_lengkap+'</option>"';
					} 
					$('[name="karyawan"]').html(html);
					$('[name="karyawan"]').val("{{ session('username') }}");
				}
			})
		}
		@php } @endphp

		@php if(session('id_level')=='admin' || session('id_level')=='mentor'){ @endphp
		searchLoad()
		function searchLoad(){
			karyawan = { "name": "karyawan", "value": $('[name="karyawan"]').val() };
			data = [karyawan];

			var table = $('#basic-datatables').DataTable({
				"bPaginate": true,
				"bLengthChange": true,
				"bFilter": true,
				"bInfo": true, 
				"language": {
					"emptyTable": "Data nilai kosong"
				},
				"bAutoWidth": true,
				"ordering": false,
				"sAjaxSource": '{{ URL::to('api/nilai-search') }}',
				"sAjaxDataProp": "data",
				"fnServerParams": function (aoData) {
					@php if(session('id_level')=='mentor' || session('id_level')=='admin'){ @endphp
						if (data) { aoData.push(data[0]); }
					@php }else{ @endphp
						
					@php } @endphp
				},
				"aoColumns": [
                { "mData": "no",className: 'text-center' }, 
                { "mData": "kriteria",className: 'text-center' }, 
				{ "mData": "nilai",className: 'text-center' }, 
				@php if(session('id_level')=='user' || session('id_level')=='mentor'){ @endphp
				{
                    "mData": "id",
                    className: 'text-center',
                    render: function (data) {
                        data = '<button onclick="return beriNilai(' + data + ')" title="Edit" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button>'
                            return data;
                    }
                }
				@php } @endphp
            ],
			"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
            var monTotal = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			$( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1 ).footer() ).html(' ');
            $( api.column( 2 ).footer() ).html(monTotal);
				
			},
			columnDefs: [ { "defaultContent": "-", "targets": "_all" } ],
				stateSave: true,
				"bDestroy": true
			});
		}
		@php } @endphp
		


		function getNilai() {
		var table =	$('#basic-datatables').DataTable({
			"bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true, 
			"language": {
					"emptyTable": "Anda belum mengisi kriteria nilai"
				},
            "bAutoWidth": true,
            "ordering": false,
            "sAjaxSource": '{{ URL::to('api/user/nilai') }}',
            "aoColumns": [
                { "mData": "no",className: 'text-center' }, 
                { "mData": "kriteria",className: 'text-center' }, 
				{ "mData": "nilai",className: 'text-center' }, 
				@php if(session('id_level')=='user' || session('id_level')=='mentor' ){ @endphp
				{
                    "mData": "id",
                    className: 'text-center',
                    render: function (data) {
                        data = '<button onclick="return update(' + data + ')" title="Edit" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button>'
						+ '<button onclick="return remove(' + data + ')" title="Hapus" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button>';
                   		return data;
                    }
                }
				@php } @endphp     
            ],
			"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // computing column Total of the complete result 
            var monTotal = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

			$( api.column( 0 ).footer() ).html('Total');
            $( api.column( 1 ).footer() ).html(' ');
            $( api.column( 2 ).footer() ).html(monTotal);
				
			},

            stateSave: true,
            "bDestroy": true
			});
		}

	function add(){
        $('#addModal').modal('show');
        $('#modal-body-add').show();
		$('#modal-body-rep').hide();
		$('#modal-body-nilai').hide();
        $('#modal-body-delete').hide();
        $('.modal-header').html('Tambah Kriteria');
        
        $('[name="kriteria"]').val("");
        
        $('#modal-button').attr('onclick','return saveAdd()');
        $('#modal-button').html('Tambah');
    }

	function saveAdd(){
        data = new FormData();
	    data.append('kriteria', $('[name="kriteria"]').val());
    
        $.ajax({
            url : "{{ URL::to('api/user/kriteria') }}",
        	method : "POST",
        	data : data,
            processData: false,
            contentType: false,
        	success: function(response){
        	    getNilai();
        	    $('#addModal').modal('hide');
        	}
        })
    }

	function reply(){
        $('#addModal').modal('show');
        $('#modal-body-rep').show();
		$('#modal-body-add').hide();
		$('#modal-body-nilai').hide();
        $('#modal-body-delete').hide();
        $('.modal-header').html('Tambah Divisi');
        
        $('[name="form_nilai"]').val("");
        
        $('#modal-button').attr('onclick','return Pengajuan()');
        $('#modal-button').html('Kirim');
    }

	function Pengajuan(){
		var surat = $('[name="form_nilai"]');
		data = new FormData();
			if(surat.val()!=""){
				data.append('form_nilai', $('[name="form_nilai"]')[0].files[0]); 
			}
    
        $.ajax({
            url : "{{ URL::to('api/user/form-nilai') }}",
        	method : "POST",
        	data : data,
            processData: false,
            contentType: false,
        	success: function(response){
        	    getNilai();
        	    $('#addModal').modal('hide');
        	}
        })
    }

	function beriNilai(id){
        $('#addModal').modal('show');
        $('#modal-body-add').hide();
		$('#modal-body-nilai').show();
		$('#modal-body-rep').hide();
        $('#modal-body-delete').hide();
        $('.modal-header').html('Ubah Kriteria');
        $('#modal-button').attr('onclick','return saveNilai('+id+')');
        $('#modal-button').html('Simpan');
        
        $.ajax({
            url: "{{ URL::to('api/user/kriteria/') }}/"+id,
            method: "GET",
            success: function (response) {
                $('[name="kriteria"]').val(response.data.kriteria);
				$('[name="nilai"]').val(response.data.nilai);

            }
        })
    }

	function saveNilai(id){
        data = new FormData();
	    data.append('nilai', $('[name="nilai"]').val());
    
        $.ajax({
            url : "{{ URL::to('api/user/nilai') }}/"+id,
        	method : "POST",
        	data : data,
            processData: false,
            contentType: false,
        	success: function(response){
        	    searchLoad();
        	    $('#addModal').modal('hide');
        	}
        })
    }

	

	function update(id){
        $('#addModal').modal('show');
        $('#modal-body-add').show();
		$('#modal-body-nilai').hide();
		$('#modal-body-rep').hide();
        $('#modal-body-delete').hide();
        $('.modal-header').html('Ubah Kriteria');
        $('#modal-button').attr('onclick','return saveUpdate('+id+')');
        $('#modal-button').html('Ubah');
        
        $.ajax({
            url: "{{ URL::to('api/user/kriteria/') }}/"+id,
            method: "GET",
            success: function (response) {
                $('[name="kriteria"]').val(response.data.kriteria);
            }
        })
    }

	function saveUpdate(id){
        data = new FormData();
	    data.append('kriteria', $('[name="kriteria"]').val());
    
        $.ajax({
            url : "{{ URL::to('api/user/kriteria') }}/"+id,
        	method : "POST",
        	data : data,
            processData: false,
            contentType: false,
        	success: function(response){
        	    getNilai();
        	    $('#addModal').modal('hide');
        	}
        })
    }

	
	function remove(id){
        $('#addModal').modal('show');
        $('#modal-body-add').hide();
		$('#modal-body-nilai').hide();
        $('#modal-body-delete').show();
        $('.modal-header').html('Hapus Kriteria');
        $('#modal-button').attr('onclick','return saveRemove('+id+')');
        $('#modal-button').html('Hapus');
        
    }
	function saveRemove(id){
        $.ajax({
            url : "{{ URL::to('api/user/kriteria') }}/"+id,
        	method : "DELETE",
            processData: false,
            contentType: false,
        	success: function(response){
        	    getNilai();
        	    $('#addModal').modal('hide');
        	}
        })
    }
</script>

</body>
</html>