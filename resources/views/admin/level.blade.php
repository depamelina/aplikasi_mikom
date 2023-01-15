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
						<h4 class="page-title">Level User</h4>
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
						<div class="col-md-8">
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
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th width="80">No</th>
													<th>Level</th>
													<th width="140">Aksi</th>
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
									<label>Level</label>
									<input name="level" type="text" class="form-control" placeholder="Masukkan Level">
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
            "sAjaxSource": '{{ URL::to('api/admin/level') }}',
            "aoColumns": [
                { "mData": "no",className: 'text-center' }, 
                { "mData": "level" }, 
                {
                    "mData": "id",
                    className: 'text-center',
                    render: function (data) {
                        data = '<button onclick="return update(' + data + ')" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task" title="Edit"> <i class="fa fa-edit"></i> </button>'
                             + '<button onclick="return remove(' + data + ')" class="btn btn-link btn-danger" data-original-title="Remove" title="Hapus"> <i class="fa fa-times"></i> </button>';
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
        $('.modal-header').html('Tambah Level');
        
        $('[name="level"]').val("");
        
        $('#modal-button').attr('onclick','return saveAdd()');
        $('#modal-button').html('Tambah');
    }

	function saveAdd(){
        data = new FormData();
	    data.append('level', $('[name="level"]').val());
    
        $.ajax({
            url : "{{ URL::to('api/admin/level') }}",
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
        $('.modal-header').html('Ubah Level');
        $('#modal-button').attr('onclick','return saveUpdate('+id+')');
        $('#modal-button').html('Ubah');
        
        $.ajax({
            url: "{{ URL::to('api/admin/level/') }}/"+id,
            method: "GET",
            success: function (response) {
                $('[name="level"]').val(response.data.level);
            }
        })
    }
	function saveUpdate(id){
        data = new FormData();
	    data.append('level', $('[name="level"]').val());
    
        $.ajax({
            url : "{{ URL::to('api/admin/level') }}/"+id,
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

	function remove(id){
        $('#addModal').modal('show');
        $('#modal-body-add').hide();
        $('#modal-body-delete').show();
        $('.modal-header').html('Hapus Level');
        $('#modal-button').attr('onclick','return saveRemove('+id+')');
        $('#modal-button').html('Delete');
        
    }
	function saveRemove(id){
        $.ajax({
            url : "{{ URL::to('api/admin/level') }}/"+id,
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