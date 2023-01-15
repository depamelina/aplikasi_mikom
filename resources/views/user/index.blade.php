<!DOCTYPE html>
<html lang="en">
<meta charset = "UTF-8" />

{{ view('component.head') }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
 <style type="text/css">
        #results { background:#fff; }

@media (max-width: 576px) {
    #my_camera video {
        max-width: 80%;
        max-height: 80%;
		margin-right : 10px;
    }
}
    </style>


<body>
	<div class="wrapper">

        {{ view('component.navbar') }}


         {{ view('component.sidebar3') }}

		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Dashboard</h4>
						<div class="btn-group btn-group-page-header ml-auto">
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
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title"><i class="fas fa-file-pen mr-1 text-danger"></i> Presensi</h5>
								</div>
								<div class="card-header">
									<div class="row user-stats text-center">
									<!-- <div class="col-md-12 mb-1">
										<h4 class="badge "> <b>Hari ini</b> </h4>
									</div> -->
										<div class="col">
											<div class="title">Hari</div>
											<div> <b> {{date('l')}} </b> </div>
										</div>
										<div class="col">
											<div class="title">Tanggal</div>
											<div> <b> {{date('d F Y')}} </b> </div>

										</div>
										<div class="col">
											<div class="title">Jam</div>
											<b><div id="clock"></div></b>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="user-profile">
										<div>
                                            <small class="text-danger" id="info-lokasi"></small>
                                            <iframe width="100%" height="100%" frameborder="0"
                                            marginheight="0" marginwidth="0" src="" id="maps"></iframe>
                                        </div>
										<input type="hidden" name="lokasi" class="form-control">
										<div class="form-group mt-3" id="cam">
											<button class="btn btn-danger" id="muncul">Buka Kamera</button>
										</div>
										<div id="my_camera"></div>
										<div id="cekrek" class="form-group">
											<button class="btn btn-dark" onClick="take_snapshot()"><i class="fa-solid fa-camera"></i></button>
											<input type="hidden" name="image" class="image-tag">
											<div id="results" class="text-center mt-2">Your captured image will appear here...</div>
										</div>
										<div class="form-group mt-3 mb-1" id="ket">
											<label>Keterangan</label>
											<input type="text" name="ket" class="form-control">
										</div>

										<div id="out">											
											<div class="form-group">
												<label for="largeInput">Foto</label>
												<input type="file" class="image form-control" name="foto_keg">
											</div>
											
											<div class="form-group">
												<label for="comment">Kegiatan</label>
												<textarea class="form-control" rows="5" name="laporan_keg"></textarea>
											</div>
											<div class="form-group">
												<label>Kendala</label>
												<input type="text" name="kendala" class="form-control">
											</div>
											<div class="form-group">
												<label>Solusi</label>
												<input type="text" name="solusi" class="form-control">
											</div>
										</div>
										<div class="view-profile mt-3">
											<!-- <button type="button"  onclick="return savePresensi()" class="btn btn-danger btn-block">Simpan Presensi Masuk</button> -->
											<button class="btn btn-danger btn-block" type="button" id="btn-presensi" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
												Presensi Masuk
											</button>
											<button class="btn btn-danger btn-block" onclick="return presensiOut()" type="button" id="btn-pulang">
												Presensi Pulang
											</button>
										</div>
										<div class="collapse" id="collapseExample">
											<div class="card-body text-center">
												<p>
													<div class="btn-group" role="group" aria-label="Basic example">
														<button type="button" class="btn btn-success pr-4 pl-4" onclick="return savePresensi()">Hadir</button>
														<button type="button" class="btn btn-danger pr-4 pl-4 btn-border"  onclick="izin()">Tidak Hadir</button>
														<!-- <button type="button" class="btn btn-danger pr-4 pl-4 btn-border" onclick="sakit()">Sakit</button> -->
													</div>
													<!-- <button class="btn btn-success mr-2" onclick="return savePresensi()">Hadir</button>
													<button class="btn btn-danger btn-border mr-2" onclick="izin()">Izin</button>
													<button class="btn btn-danger btn-border" onclick="sakit()">Sakit</button> -->
												</p>
											</div>
										</div>
										<!-- <div class="row justify-content-center">
											<div class="col-lg-12">
												<div class="btn-group text-center">
													<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Presensi Masuk
													</button>
													<div class="dropdown-menu">
														<div class="arrow"></div>
														<a class="dropdown-item" href="#">Hadir</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item" onclick="izin()">Izin</a>
														<a class="dropdown-item" href="#">Sakit</a>
													</div>
												</div>
											</div>
										</div> -->
									</div>
								</div>
								<div class="card-footer">
									<div class="row user-stats text-center">
										<div class="col">
											<div class="title">Presensi Masuk</div>
											<b><div class="number" id="waktu-in">00:00</div></b>
										</div>
										<div class="col">
											<div class="title">Presensi Pulang</div>
											<b><div class="number" id="waktu-out">00:00</div></b>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-sm-6  mt-2  col-md-12">
										<div class="card card-stats card-round">
											<div class="card-body ">
												<div class="row">
													<div class="col-6 text-center">
														<div class="numbers">
															<p class="card-category">Jadwal Masuk</p>
															<h4 class="card-title" id="shift"></h4>
														</div>
													</div>
													<div class="col-6 text-center">
														<div class="numbers">
															<p class="card-category">Jadwal Pulang</p>
															<h4 class="card-title"  id="shiftOut"></h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6  mt-2  col-md-6">
										<div class="card card-stats card-round">
											<div class="card-body ">
												<div class="row align-items-center">
													<div class="col-icon">
														<div class="icon-big text-center icon-success">
															<i class="fas fa-calendar-check"></i>
														</div>
													</div>
													<div class="col col-stats ml-3 ml-sm-0">
														<div class="numbers">
															<p class="card-category">Hadir</p>
															<b><h4 class="card-title" id="hadir"></h4></b> 
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 mt-2 col-md-6">
										<div class="card card-stats card-round">
											<div class="card-body ">
												<div class="row align-items-center">
													<div class="col-icon">
														<div class="icon-big text-center icon-danger">
															<i class="fas fa-calendar-xmark"></i>
														</div>
													</div>
													<div class="col col-stats ml-3 ml-sm-0">
														<div class="numbers">
															<p class="card-category">Tidak Hadir</p>
															<h4 class="card-title" id="thadir"></h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 mt-2 col-md-6">
										<div class="card card-stats card-round">
											<div class="card-body ">
												<div class="row align-items-center">
													<div class="col-icon">
														<div class="icon-big text-center icon-success">
															<i class="fa-solid fa-file-circle-check"></i>
														</div>
													</div>
													<div class="col col-stats ml-3 ml-sm-0">
														<div class="numbers">
															<p class="card-category">Tugas Selesai</p>
															<h4 class="card-title">{{ $done }}</h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 mt-2 col-md-6">
										<div class="card card-stats card-round">
											<div class="card-body ">
												<div class="row align-items-center">
													<div class="col-icon">
														<div class="icon-big text-center icon-danger">
														<i class="fa-solid fa-file-circle-xmark"></i>
														</div>
													</div>
													<div class="col col-stats ml-3 ml-sm-0">
														<div class="numbers">
															<p class="card-category">Tugas</p>
															<h4 class="card-title"> {{ $tgs }} </h4>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header">
											<h5 class="card-title"> <i class="fas fa-bullhorn mr-1 text-danger"></i>  Informasi </h5>
										</div>
										<div class="card-body">
											<ul class="nav nav-pills nav-danger nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
												<!-- <li class="nav-item">
													<a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Kehadiran</a>
												</li> -->
												<li class="nav-item">
													<a class="nav-link active" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="true">Pembimbing</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false">Pekerjaan</a>
												</li>
											</ul>
											<div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
												<div class="tab-pane fade" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
												</div>
												<div class="tab-pane fade show active" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
													<div class="card-body">
														<div class="d-flex">
															<div class="flex pt-1">
																<i class="fa-regular fa-lg fa-user"></i>
															</div>
															<div class="flex-1 ml-3 pt-1">
																<h5 class="text-uppercase fw-bold mb-1">Nama Pembimbing</h5>
																<span id="nama" class="text-muted"></span>
															</div>
														</div>
														<div class="separator-dashed"></div>
														<div class="d-flex">
															<div class="flex pt-1">
																<i class="fa-solid fa-lg fa-envelope"></i>
															</div>
															<div class="flex-1 ml-3 pt-1">
																<h5 class="text-uppercase fw-bold mb-1">Email</h5>
																<span id="email" class="text-muted"></span>
															</div>
														</div>
														<div class="separator-dashed"></div>
														<div class="d-flex">
															<div class="flex pt-1">
																<i class="fa-brands fa-whatsapp fa-xl"></i>
															</div>
															<div class="flex-1 ml-3 pt-1">
																<h5 class="text-uppercase fw-bold mb-1">No Whatssapp</h5>
																<span id="no_tlp" class="text-muted"></span>
															</div>
															<div class="float-right pt-1">
																<!-- <i class="fa-solid fa-paper-plane"></i> -->
															</div>
														</div>
														<div class="separator-dashed"></div>
														<div class="d-flex">
															<div class="flex pt-1">
																<i class="fa-brands fa-xl fa-telegram"></i>
															</div>
															<div class="flex-1 ml-3 pt-1">
																<h5 class="text-uppercase fw-bold mb-1">ID Telegram</h5>
																<span id="id_tele" class="text-muted"></span>
															</div>
														</div>
													</div>											
												</div>
												<div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
													<div class="card-body" id="loop_task">
																							
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
	</div>
</div>

		<div id="addModal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="text-align:center">
						<h3 id="modal-header"></h3>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<span id="modal-body-izin" class="row p-3">
							<div class="form-group form-group-default">
								<label>Alasan Tidak Hadir</label>
								<select name="absen" class="form-control" id="drAbsen" onchange="return cekKet()">
									<option disabled="disabled" selected="selected" value="Pilih">Pilih</option>
									<option value="izin">Izin</option>
									<option value="sakit">Sakit</option>
								</select>
							</div>
							<div class="form-group form-group-default">
								<label>Dari</label>
								<input type="date" id="valid-tgl" min="" class="form-control" name="dari_tgl" required />
							</div>
							<div class="form-group form-group-default">
								<label>Sampai</label>
								<input type="date" id="valid-tgl" class="form-control" name="sampai_tgl" required>
							</div>
							<small class="text-danger mb-2" id="info-tgl"></small>
							<div class="form-group form-group-default" id="surat">
								<label>Surat</label>
								<input type="file" class="form-control" name="surat_absen" required>
							</div>
							<div class="form-group form-group-default">
								<label>Keterangan Tidak Hadir</label>
								<input type="text" class="form-control" name="ket_absen" required />
							</div>
						</span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-info" id="modal-button" onclick="return addIzin()">Simpan</button>
					</div>
				</div>
			</div>
		</div>

{{ view('component.script') }}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	$(document).ready(function() { 
		var today = new Date().toISOString().split('T')[0];
		document.getElementsByName("dari_tgl")[0].setAttribute('min', today);
	});
</script>

<script>
	realtimeClock();
	function getServerTime() {
    return $.ajax({ async: false }).getResponseHeader('Date');
		}
	function realtimeClock() {
		var rtClock = new Date();
	
		var hours = rtClock.getHours();
		var minutes = rtClock.getMinutes();
		var seconds = rtClock.getSeconds();

		hours = ("0" + hours).slice(-2);
		minutes = ("0" + minutes).slice(-2);
		seconds = ("0" + seconds).slice(-2);

		document.getElementById("clock").innerHTML =
			hours + " : " + minutes + " : " + seconds;
		var jamnya = setTimeout(realtimeClock, 500);
	}
</script>

<script>
	firstload();
	getTeach();
	getTugas();


	function firstload(){
		$('#ket').show();
		$('#kamera').hide();
		$('#out').hide();
		$('#cam').hide();
		$('#cekrek').hide();
		$('#btn-pulang').hide();
		$.ajax({
            url: "api/user/dashboard",
            method: "GET",
            success: function (response) {
			
                if (response.message == "LOGOUT") {
                    window.location = "{{ URL::to('/') }}/";
                }
                if (response.data.presensiMasuk == "SUDAH") {
                    $('#out').show();
					$('#ket').hide();
					$('#cam').hide();
					$('#btn-presensi').hide();
					$('#collapseExample').hide();
					$('#btn-pulang').show();

                }
                if (response.data.presensiPulang == "SUDAH") {
					$('#btn-presensi').hide();
					$('#btn-pulang').show();
					$('#btn-pulang').html('Sudah Mengisi Presensi');
					$('#out').hide();
					$('#ket').hide();
					$('#cam').hide();
					$('#btn-pulang').attr('disabled', true);
                }

				if (response.data.status == "P") {
					$('#btn-presensi').hide();
					$('#btn-pulang').show();
					$('#btn-pulang').html('Sedang dalam Pengajuan Absen');
					$('#collapseExample').hide();
					$('#out').hide();
					$('#ket').hide();
					$('#cam').hide();
					$('#btn-pulang').attr('disabled', true);
                }

				if (response.data.status == "I" || response.data.status == "S" ) {
					$('#btn-presensi').hide();
					$('#btn-pulang').show();
					$('#btn-pulang').html('Anda tidak hadir hari ini');
					$('#collapseExample').hide();
					$('#out').hide();
					$('#ket').hide();
					$('#cam').hide();
					$('#btn-pulang').attr('disabled', true);
                }
                
                if(response.data.in_time){ $('#waktu-in').html(response.data.in_time); $('#waktu-in').addClass('text-success'); $('#waktu-in').removeClass('text-danger');}
                if(response.data.out_time){ $('#waktu-out').html(response.data.out_time); $('#waktu-out').addClass('text-success'); $('#waktu-out').removeClass('text-danger');}       
                
            }
        })

		$.ajax({
            url : "{{ URL::to('api/user-dash') }}",
            method : "GET",
            success: function(response){
				$('#hadir').html(response.data);
				$('#thadir').html(response.data2);
				$('#shift').html(response.data3);
				$('#shiftOut').html(response.data4);
				$('#absen').html(response.data5);
			}
        })
	}

	function getHadir(){
        $.ajax({
            url : "{{ URL::to('api/user-dash') }}",
            method : "GET",
            success: function(response){
				$('#hadir').html(response.data);
				$('#thadir').html(response.data2);
				$('#shift').html(response.data3);
				$('#shiftOut').html(response.data4);
			}
        })
    }

	function getTeach(){
        $.ajax({
            url : "{{ URL::to('api/user/teach-bio') }}",
            method : "GET",
            success: function(response){
				$('#nama').html(response.data.nama_lengkap);
				$('#email').html(response.data.email);
				$('#no_tlp').html(response.data.no_tlp);
				$('#id_tele').html(response.data.id_tele);
			}
        })
    }

	function getTugas(){
        $.ajax({
            url : "{{ URL::to('api/user/tugas') }}",
            method : "GET",
            success: function(response){
				var html='';
				if(response.message == "FALSE"){return;}
				for(i=0;i<response.data.length;i++){
                    var judul="";
                    var desk="";
                    var add="";
                    var dd="";
                    if(response.data[i].ctt_tugas){judul=response.data[i].ctt_tugas;}
                    if(response.data[i].desk_tugas){desk=response.data[i].desk_tugas;}
                    if(response.data[i].tgl_add){add=response.data[i].tgl_add;}
					if(response.data[i].tgl_deadline){dd=response.data[i].tgl_deadline;}
                     html += '<div class="d-flex" >'
					 		+ ' <div class="flex-1 ml-3 pt-1">'
							+ '<span class="text-warning"> ' + dd + ' </span>'
							+ '<h5 class="text-uppercase fw-bold mb-1">'+ judul +'</h5>'
							+ '<span class="text-muted">' + desk + '</span>'
							+ '</div>'
							+ '<div class="float-right pt-1 pr-5">'
							+ '<small class="text-muted">' + add +' </small>'
							+ '</div>'
							+ '<div class="">'
							+ '<a class="btn btn-danger btn-sm" href="/isi-tugas/'+ response.data[i].id +'">'
							+ '<i class="fa-solid fa-paper-plane"></i>'
							+ '</a>'
							+ '</div>'
							+ '</div>'
							+ '<hr>';
					}
					
				$('#loop_task').html(html);  

			}
        })
    }
	

	function izin(){
        $('#addModal').modal('show');
        $('#modal-body-izin').show();
		$('#surat').hide();
        $('.modal-header').html('Permohonan Tidak Hadir');
    }

	function cekKet() {
			var a = $('[name="absen"]').val();
			$('#surat').hide();
			if(a == "sakit"){
				$('#surat').show();
			}
		}



</script>

<script>
	var x = $('[name="lokasi"]');

	if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition, showError);
		} else {
			$('[name="lokasi"]').val("Geolocation is not supported by this browser.");
		}

	function showPosition(position) {
			$('[name="lokasi"]').val(position.coords.latitude + "," + position.coords.longitude);
			$('#maps').attr('src', 'https://www.google.com/maps?q=' + position.coords.latitude + ',' + position.coords.longitude + '&hl=es;z=14&output=embed');
		}

	function showError(error) {
		switch (error.code) {
				case error.PERMISSION_DENIED:
					$('[name="lokasi"]').val("User denied the request for Geolocation.")
					break;
				case error.POSITION_UNAVAILABLE:
					$('[name="lokasi"]').val("Location information is unavailable.")
					break;
				case error.TIMEOUT:
					$('[name="lokasi"]').val("The request to get user location timed out.")
					break;
				case error.UNKNOWN_ERROR:
					$('[name="lokasi"]').val("An unknown error occurred.")
					break;
			}
		}

</script>

<script language="JavaScript">
	 $("body").on('click', '#muncul', function() {
		$('#cekrek').show();
		Webcam.set({
			height: 200,
			image_format: 'jpeg',
			flip_horiz: true,
			jpeg_quality: 90
		});
    
    	Webcam.attach( '#my_camera' );
	});
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'" width="300" height="200"/>';
        } );
    }
</script>

<script>
	 function savePresensi() {
        var location = $('[name="lokasi"]').val();
		var ket = $('[name="ket"]').val();

		if (ket == ""){
			alert("Isi keterangan");
			return false;
		}

        data = new FormData();
        data.append('location', location);
		data.append('ket', ket);

        $.ajax({
            url: "api/save-presensi",
            method: "POST",
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                firstload();

            }
        })
    }

	function presensiOut() {
        
        var location = $('[name="lokasi"]').val();
		var foto_keg = $('[name="foto_keg"]');
        var laporan_keg = $('[name="laporan_keg"]').val();
		var kendala = $('[name="kendala"]').val();
		var solusi = $('[name="solusi"]').val();    

        data = new FormData();
        data.append('location', location);
        data.append('foto_keg', $('[name="foto_keg"]')[0].files[0]);
		data.append('laporan_keg', laporan_keg);
		data.append('kendala', kendala);
		data.append('solusi', solusi);

        $.ajax({
            url: "api/presensi-out",
            method: "POST",
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                firstload();
            }
        })
    }

	function addIzin(){
		var absen = $('[name="absen"]').val();
		var dari = $('[name="dari_tgl"]').val();
        var sampai = $('[name="sampai_tgl"]').val();
		var surat = $('[name="surat_absen"]');
		var ket_absen = $('[name="ket_absen"]').val();

		var mySelect = document.getElementById("drAbsen");
			
		 
		if (mySelect.value === "Pilih") {
			alert("Pilih Alasan absen");
			return false;
		} else if (dari == ""){
			alert("Isi tanggal awal absen");
			return false;
		}else if (sampai == ""){
			alert("Isi tanggal berakhir absen");
			return false;
		}else if (ket_absen == ""){
			alert("Isi keterangan absen");
			return false;
		}

		data = new FormData();
		if(surat.val()!=""){
				data.append('surat_absen', $('[name="surat_absen"]')[0].files[0]); 
			}
        data.append('absen', absen);
        data.append('dari_tgl', dari);
		data.append('sampai_tgl', sampai);
		data.append('ket_absen', ket_absen);
		

        $.ajax({
            url: "api/pengajuan-absen",
            method: "POST",
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
				$('#addModal').modal('hide');
                firstload();
            }
        })
	}

	$("body").on('change', '#valid-tgl', function() {
		var dari = new Date($('[name="dari_tgl"]').val());
        var sampai = new Date($('[name="sampai_tgl"]').val());
        diff  = new Date(sampai - dari),
        day  = diff/1000/60/60/24;
        if(day<0){
			$('#info-tgl').show();
			$('#info-tgl').html('* cek kembali tanggalnya');
			$('#modal-button').attr('disabled',true)
			return;}
		if(day>=0){
			$('#info-tgl').hide();
			$('#modal-button').attr('disabled',false)
			return;}
        html="";		

	});
</script>

</body>
</html>
