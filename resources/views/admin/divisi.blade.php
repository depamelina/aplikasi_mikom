<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.umd.min.js"></script>
 

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

		{{ view('component.sidebar') }}

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header mb-4">
						<h4 class="page-title">Data Divisi</h4>
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
						<div class="col-md-9">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<button class="btn btn-danger btn-round ml-auto" onclick="add()">
											<i class="fa fa-plus"></i>
											Tambah
										</button>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="text-center display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Divisi</th>
													<th>Aksi</th>
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
			<!-- <input id="datepicker"/> -->
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
										<label>Nama Divisi</label>
										<input name="divisi" type="text" class="form-control" placeholder="Masukkan Divisi">
								</div>
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
		
	
	</div>
</div>


<!-- <script>
      const picker = new easepick.create({
        element: document.getElementById('datepicker'),
        css: [
          'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.css',
        ],
        plugins: ['RangePlugin'],
        RangePlugin: {
          tooltipNumber(num) {
            return num += 0;
          },
          locale: {
            one: 'hari',
            other: 'hari',
          },
        },
      });
    </script> -->

{{ view('component.script') }}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
            "sAjaxSource": '{{ URL::to('api/admin/divisi') }}',
            "aoColumns": [
                { "mData": "no",className: 'text-center' }, 
                { "mData": "divisi" }, 
                {
                    "mData": "id",
                    className: 'text-center',
                    render: function (data) {
                        data = '<button onclick="return update(' + data + ')" title="Edit" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button>'
                             + '<button onclick="return remove(' + data + ')" title="Hapus" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button>';
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
        $('.modal-header').html('Tambah Divisi');
        
        $('[name="divisi"]').val("");
        
        $('#modal-button').attr('onclick','return saveAdd()');
        $('#modal-button').html('Tambah');
    }
	
	function saveAdd(){
        data = new FormData();
	    data.append('divisi', $('[name="divisi"]').val());
    
        $.ajax({
            url : "{{ URL::to('api/admin/divisi') }}",
        	method : "POST",
        	data : data,
            processData: false,
            contentType: false,
        	success: function(response){
        	    getDivisi();
        	    $('#addModal').modal('hide');
        	}
        })

    }
	function update(id){
        $('#addModal').modal('show');
        $('#modal-body-add').show();
        $('#modal-body-delete').hide();
        $('.modal-header').html('Ubah Divisi');
        $('#modal-button').attr('onclick','return saveUpdate('+id+')');
        $('#modal-button').html('Ubah');
        
        $.ajax({
            url: "{{ URL::to('api/admin/divisi/') }}/"+id,
            method: "GET",
            success: function (response) {
                $('[name="divisi"]').val(response.data.divisi);
            }
        })
    }
	function saveUpdate(id){
        data = new FormData();
	    data.append('divisi', $('[name="divisi"]').val());
    
        $.ajax({
            url : "{{ URL::to('api/admin/divisi') }}/"+id,
        	method : "POST",
        	data : data,
            processData: false,
            contentType: false,
        	success: function(response){
        	    getDivisi();
        	    $('#addModal').modal('hide');
				alert.success('Data telah diubah');
        	}
        })
    }

	function remove(id){
        $('#addModal').modal('show');
        $('#modal-body-add').hide();
        $('#modal-body-delete').show();
        $('.modal-header').html('Hapus Divisi');
        $('#modal-button').attr('onclick','return saveRemove('+id+')');
        $('#modal-button').html('Delete');
        
    }
	function saveRemove(id){
        $.ajax({
            url : "{{ URL::to('api/admin/divisi') }}/"+id,
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


</body>
</html>