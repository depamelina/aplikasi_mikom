<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

    
         {{ view('component.sidebar3') }}
			
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content content-full">
				<!-- <div class="page-navs bg-white">
					<div class="nav-scroller">
						<div class="nav nav-tabs nav-line nav-color-primary">
							<a class="nav-link active show" data-toggle="tab" href="#tab1">All
								<span class="count ml-1">(7)</span>
							</a>
							<a class="nav-link" data-toggle="tab" href="#tab2">Starred</a>
							<a class="nav-link" data-toggle="tab" href="#tab3">Trash</a>
						</div>
					</div>
				</div> -->
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">

						<a class="btn btn-danger btn-sm" href="/user-tugas"><i class="fa-solid fa-caret-left fa-xl mr-1"></i>Kembali</a>

						<section class="card mt-4">
								<div class="card-header">
								<h4 class="card-title"><b><i class="fa-solid fa-file-lines text-danger mr-2"></i>Detail Tugas</h4></b>
								</div>
								<div class="list-group list-group-messages list-group-flush">
									<div class="list-group-item unread">
										<!-- <div class="list-group-item-figure">
											<span class="rating rating-sm mr-3">
												<input type="checkbox" id="star1" value="1">
												<label for="star1">
													<span class="fa fa-star"></span>
												</label>
											</span>
										</div> -->
										<div class="list-group-item-body pl-3 pl-md-4">
											<!-- <div class="row">
												<div class="col-12 col-lg-10">
													<h4 class="list-group-item-title"> Catatan Tugas : <br>
														<span id="judul"></span> <small class="text-warning">(</small><small id="dd" class="text-warning"></small><small class="text-danger">)</small>
													</h4>
													<p class="list-group-item-text" id="desk"> </p>
												</div>
												<div class="col-12 col-lg-2 text-lg-right">
													<b><p class="list-group-item-text" id="add"> </p></b>
												</div>
											</div> -->
											<div class="row">
												<div class="col-md-2 text-left" >
													<span>Tugas </span>
												</div>
												<div class="col-md-3 text-left">
													<span class="mr-2">: </span><p id="judul" class="text-capitalize" style="display:inline"></p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2 text-left" >
													<span>Batas Waktu </span>
												</div>
												<div class="col-md-3 text-left">
													<span class="mr-2">: </span><span class="text-warning" id="dd"></span>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2 text-left" >
													<span>Deskripsi Tugas </span>
												</div>
												<div class="col-md-9 text-left">
													<span class="mr-2">: </span><p id="desk" class="text-justify text-xl pl-3"></p>
												</div>
											</div>
											<div class="row">
												<div class="col-md-2 text-left" >
													<span>File Tugas </span>
												</div>
												<div class="col-md-4 text-left">
													<span class="mr-2">: </span> <a class="btn btn-danger btn-border btn-sm">Lihat File</a>
												</div>
											</div>
										</div>
										<!-- <div class="list-group-item-figure">
											<div class="dropdown">
												<button class="btn-dropdown" data-toggle="dropdown">
													<i class="fa fa-ellipsis-v"></i>
												</button>
												<div class="dropdown-arrow"></div>
												<div class="dropdown-menu dropdown-menu-right">
													<a href="#" class="dropdown-item">Mark as read</a>
													<a href="#" class="dropdown-item">Mark as unread</a>
													<a href="#" class="dropdown-item">Toggle star</a>
													<a href="#" class="dropdown-item">Trash</a>
												</div>
											</div>
										</div> -->
									</div>
								</div>
							</section>
							<section class="card mt-4">
								<div class="card-header">
									<h4 class="card-title"><b><i class="fa-solid fa-file-pen text-danger mr-2"></i>Edit Tugas</h4></b>
								</div>
								<div class="list-group list-group-messages list-group-flush">
									<div class="list-group-item unread">
										<div class="list-group-item-body pl-3">

											<div class="row">
												<div class="col-md-6">
													<div class="row">
														<div class="col-12 col-lg-10">
															<h5 class="list-group-item-title">
																File Jawaban
															</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<input type="file" name="file_jawaban" id="" class="form-control">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="row">
														<div class="col-12 col-lg-10">
															<h5 class="list-group-item-title">
																Foto Bukti Pekerjaan
															</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<input type="file" name="foto_bukti" id="" class="form-control">
														</div>
													</div>
												</div>
											</div>
											<div class="row mt-4">
												<div class="col-md-12">
													<div class="row">
														<div class="col-12 col-lg-10">
															<h5 class="list-group-item-title">
																Catatan
															</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<input type="hidden" name="id">
															<input type="text" name="ctt_jawab" id="" class="form-control">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="list-group-item-figure">
											<div class="dropdown">
												<button class="btn-dropdown" data-toggle="dropdown">
													<i class="fa fa-ellipsis-v"></i>
												</button>
												<div class="dropdown-arrow"></div>
												<div class="dropdown-menu dropdown-menu-right">
													<a href="#" class="dropdown-item">Mark as read</a>
													<a href="#" class="dropdown-item">Mark as unread</a>
													<a href="#" class="dropdown-item">Toggle star</a>
													<a href="#" class="dropdown-item">Trash</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
								<button type="button" class="btn btn-danger d-none d-sm-inline-block" onclick="return kirimTugas()">Simpan</button>
								</div>
							</section>
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
	
		function kirimTugas(id){
			var id = $('[name="id"]').val(); 
			var ctt_jawab = $('[name="ctt_jawab"]').val(); 
			var foto_bukti = $('[name="foto_bukti"]').val(); 
			var file_jawaban = $('[name="file_jawaban"]').val(); 
	
			data = new FormData();
			data.append('id', id);
			data.append('ctt_jawab', ctt_jawab);
			data.append('foto_bukti', foto_bukti);
			data.append('file_jawaban', file_jawaban);

			$.ajax({
				url : "{{ URL::to('api/user/tugas') }}/{{ $id}}",
				method : "POST",
				processData: false,
				contentType: false,
				data : data,
				success: function(response){
					window.location = "/user-tugas"
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

		function firstLoad(){
        $.ajax({
            url : "{{ URL::to('api/user/tugas') }}/{{ $id}}",
            method : "GET",
            success: function(response){
				$('[name="id"]').html(response.data.id);
				$('[name="ctt_jawab"]').val(response.data.ctt_jawab);
				$('#judul').html(response.data.ctt_tugas);
				$('#desk').html(response.data.desk_tugas);
				$('#dd').html(response.data.tgl_deadline);
				$('#add').html(response.data.tgl_add);
			}
        })
    }
</script>

</body>
</html>