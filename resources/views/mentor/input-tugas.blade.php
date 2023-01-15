<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" /><body>
<style>
	.select2-container-default .select2-selection{
		border: none;
		box-shadow:none;
	}
</style>
<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

    
         {{ view('component.sidebar2') }}
			
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">

						<a class="btn btn-danger btn-sm" href="/mentor-tugas"><i class="fa-solid fa-caret-left fa-xl mr-1"></i>Kembali</a>
					
						<!-- <h4 class="page-title">Tambah Tugas</h4> -->
						<!-- <div class="btn-group btn-group-page-header ml-auto">
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
						</div> -->
					</div>
					<div class="row justify-content-center">
						<div class="col-sm-12 col-md-12">	
							<div class="card">
								<div class="card-header">
										<h4 class="card-title"><i class="fa-solid fa-file-pen text-danger mr-2"></i>Tambah Tugas</h4>
											<div class="card-tools">
											<!-- <a href="/input-tugas" class="btn btn-danger btn-round btn-sm">
												<span class="btn-label">
													<i class="fa fa-print"></i>
												</span>
												Input Tugas
											</a> -->
										</div>
								</div>
								<div class="card-body">
									<div class="row">
                                        <div class="col-md-6">
											<div class="form-group form-group-default select2-container-default ">
												<label>Peserta</label>
												<select name="user_peserta" id="e1" class="form-control select2-selection">
                                    			</select>
                                        	</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Tanggal Deadline</label>
												<input type="datetime-local" name="tgl_deadline" id="valid-tgl" min="" class="form-control">
												<!-- <input type="date" id="valid-tgl" class="form-control" name="tgl_deadline" required /> -->
											</div>
										</div>
                                    </div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Upload File</label> 
												<input type="file" name="file_tugas" class="form-control">	
											</div>
										</div>								
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Catatan</label> 
												<input type="text" name="ctt_tugas" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
                                        <div class="col-md-12">
											<div class="form-group form-group-default">
												<label>Deskripsi Tugas</label>
												<textarea name="desk_tugas" cols="30" rows="10" class="form-control"></textarea>
                                        	</div>
										</div>
                                    </div>
									<div class="row">
                                        <div class="col-md-1 ml-auto">
											<button class="btn btn-danger" onclick="return kirimTugas()">
												Kirim
											</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script >
	$(document).ready(function() { 
		$( "#e1" ).select2({
			theme: "bootstrap"
		});

		let dateInput = document.getElementById("valid-tgl");
		dateInput.min = new Date().toISOString().slice(0,new Date().toISOString().lastIndexOf(":"));
	});
		
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
					$('[name="user_peserta"]').html(html);
				}
			})
		}
	
		function kirimTugas(){
			var user_peserta = $('[name="user_peserta"]').val(); 
			var tgl_deadline = $('[name="tgl_deadline"]').val(); 
			var file = $('[name="file_tugas"]').val(); 
			var ctt = $('[name="ctt_tugas"]').val(); 
			var desk = $('[name="desk_tugas"]').val(); 

			data = new FormData();
			data.append('user_peserta', user_peserta);
			data.append('tgl_deadline', tgl_deadline);
			data.append('file_tugas', file);
			data.append('ctt_tugas', ctt);
			data.append('desk_tugas', desk);
			
			// var file = $('[name="file"]');
			// if(file.val()!=""){
			// 	data.append('file', $('[name="file"]')[0].files[0]); 
			// }
			

			$.ajax({
				url : "api/teach/tugas/",
				method : "POST",
				processData: false,
				contentType: false,
				data : data,
				success: function(response){
					window.location.href = "/mentor-tugas";
				},
				error: function(response){
					var errors = response.responseJSON.errors;

				var errorsHtml = '<div class=""><ul>';

				$.each( errors, function( key, value ) {
					errorsHtml += '<li>'+ value[0] + '</li>';
				});
				errorsHtml += '</ul></div';

				$('.messages').html(errorsHtml);

				
				}

			})

		}
</script>

</body>
</html>