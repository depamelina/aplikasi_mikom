<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}

<body id="body-top">
	<div class="wrapper">
		
        {{ view('component.navbar') }}

        {{ view('component.sidebar') }}

        <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<h5 class="page-title">Tambah Peserta Magang</h5>
					<div class="row justify-content-center">
						<div class="col-lg-11">
							<div class="card">
								<div class="card-header bg-danger">
									<a class="btn btn-sm" href="/users">Kembali</a>
								</div>
                                <div class="card-body" id="here">
									<div class="row mt-3 justify-content-center">
                                        <div class="avatar avatar-xxl mb-3">
                                            <img id="foto" src="{{ asset('template/assets/img/default.png') }}" alt="user" class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4">
                                            <input type="file" class="image form-control" name="foto">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Nama</label>
												<input type="text" class="form-control" id="nama" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" required>
											</div>
											<div class="nama text-danger mb-2">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Email</label>
												<input type="email" class="form-control" name="email" placeholder="Email" required>
											</div>
										</div>
									</div>
                                    <div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Username</label>
												<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
											</div>
											<div class="messages text-danger">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Password</label>
												<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
											</div>
											<div class="password text-danger mb-2">
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Tanggal Lahir</label>
												<input type="date" class="form-control" name="tgl_lahir" required placeholder="Birth Date">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Jenis Kelamin</label>
												<select class="form-control" name="jk" required>
													<option selected="selected" disabled="disabled">Pilih</option>
													<option value="Laki-laki">Laki-laki</option>
													<option value="Perempuan">Perempuan</option>
												</select>
											</div>
										</div>
									</div>
                                    <div class="row">
                                        <div class="col-md-6">
											<div class="form-group form-group-default">
												<label>No Telepon</label>
												<input type="text" class="form-control" name="no_tlp" placeholder="No Telepon Aktif" required>
											</div>
										</div>
                                        <div class="col-md-6">
											<div class="form-group form-group-default">
												<label>ID Telegram</label>
												<input type="text" class="form-control" name="id_tele" placeholder="ID Telegram">
											</div>
										</div>
                                    </div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Alamat</label>
												<input type="text" class="form-control" name="alamat" placeholder="Alamat">
											</div>
										</div>
                                        <div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Asal Sekolah</label>
												<input type="text" class="form-control" name="asal_sekolah" placeholder="Asal Sekolah / Perguruan Tinggi">
											</div>
										</div>
									</div>
                                    <div class="row">
                                        <div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Divisi</label>
												<select name="id_divisi" id="id_divisi" class="form-control">
                                    			</select>
                                        	</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Pembimbing</label>
												<select name="id_mentor" id="id_mentor" class="form-control">
                                    			</select>
											</div>
										</div>
                                    </div>
                                    <div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Tanggal Masuk</label>
												<input type="date" id="valid-tgl" class="form-control" name="tgl_mulai" placeholder="Birth Date">
											</div>
										</div>
										<div class="col-md-6">
                                        <div class="form-group form-group-default">
												<label>Tanggal Berakhir</label>
												<input type="date" id="valid-tgl" class="form-control" name="tgl_akhir" placeholder="Birth Date">
											</div>
										</div>
									</div>
									<div class="row mb-3" id="kotak">
										<div class="col-md-6">
											<small class="text-danger" id="info-tgl"></small>
										</div>
									</div>
                                    <div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Surat Pengantar</label>
												<input type="file" class="form-control" name="surat">
											</div>
										</div>
									</div>
								</div>        
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <button class="btn btn-success" id="btn-add" onclick="return saveUsers()">Simpan</button>
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
    <script>

	firstLoad()
	function firstLoad(){
		$('#kotak').hide();
	}

	getCboDivisi()
    function getCboDivisi(){
        $.ajax({
            url: "{{ URL::to('api/admin/divisi') }}",
            method: "GET",
            success: function (response) {
                html="<option selected="+"selected"+" disabled="+"disabled"+" value="+"Pilih"+">Pilih</option>";
                for(i=0;i<response.data.length;i++){
                    html += '<option value="'+response.data[i].id+'">'+response.data[i].divisi+'</option>"';
                } 
                $('[name="id_divisi"]').html(html);
            }
        })
    }

	getCboTeach()
    function getCboTeach(){
        $.ajax({
            url: "{{ URL::to('api/admin/teach') }}",
            method: "GET",
            success: function (response) {
				html="<option selected="+"selected"+" disabled="+"disabled"+" value="+"Pilih"+">Pilih</option>";
                for(i=0;i<response.data.length;i++){
					html += '<option value="'+response.data[i].username+'">'+response.data[i].nama_lengkap+'</option>"';
                   // html += '<option value="'+response.data[i].username+'">'+response.data[i].nama+'</option>"';
                } 
                $('[name="id_mentor"]').html(html);
            }
        })
    }

	// $("body").on('change', '#username', function() {
		
	// 	$.ajax({
    //         url : "api/admin/rules/",
    //         method : "GET",
    //         processData: false,
    //         contentType: false,
	// 		success: function(response){
	// 			$('#btn-add').attr('disabled',false);   
	// 		},
    //         error: function(response){
	// 			alert('data username sudah ada');
	// 			$('#btn-add').attr('disabled',true);               
    //         }
    //     })
	// });

	$("body").on('change', '#valid-tgl', function() {
		var dari = new Date($('[name="tgl_mulai"]').val());
        var sampai = new Date($('[name="tgl_akhir"]').val());
        diff  = new Date(sampai - dari),
        day  = diff/1000/60/60/24;
        if(day<0){
			$('#kotak').show();
			$('#info-tgl').show();
			$('#info-tgl').html('* cek kembali tanggalnya');
			$('#btn-add').attr('disabled',true)
			return;}
		if(day>=0){
			$('#kotak').hide();
			$('#info-tgl').hide();
			$('#btn-add').attr('disabled',false)
			return;}
        html="";
	});

	function saveUsers(){
		var nama_lengkap = $('[name="nama_lengkap"]').val(); 
		var email = $('[name="email"]').val(); 
		var foto = $('[name="foto"]').val(); 
		var username = $('[name="username"]').val(); 
		var password = $('[name="password"]').val(); 
		var tgl_lahir = $('[name="tgl_lahir"]').val(); 
		var jk = $('[name="jk"]').val(); 
		var no_tlp = $('[name="no_tlp"]').val(); 
		var id_tele = $('[name="id_tele"]').val(); 
		var alamat = $('[name="alamat"]').val(); 
		var asal_sekolah = $('[name="asal_sekolah"]').val(); 
		var id_divisi = $('[name="id_divisi"]').val(); 
		var id_mentor = $('[name="id_mentor"]').val(); 
		var tgl_mulai = $('[name="tgl_mulai"]').val(); 
		var tgl_akhir = $('[name="tgl_akhir"]').val(); 
		var surat = $('[name="surat"]').val(); 

		var validasi = true;
		var here = document.getElementById("here");
		var selectDiv = document.getElementById("id_divisi");
		var selectTe = document.getElementById("id_mentor");
        
		if (nama_lengkap == ""){
			alert("Isi nama lengkap");
			here.scrollIntoView();
			return false;
		}else if (password == ""){
			alert("Isi password");
			here.scrollIntoView();
			return false;
		}else if (selectDiv.value === "Pilih") {
			alert("Pilih Divisi");
			return false;
		} else if (selectTe.value === "Pilih"){
			alert("Pilih Pembimbing");
			return false;
		}else if (username == ""){
			alert("Isi Username");
			here.scrollIntoView();
			return false;
		}

        if(validasi == false){return;}

		data = new FormData();
		data.append('nama_lengkap', nama_lengkap);
		data.append('email', email);
		data.append('foto', foto);
	    data.append('username', username);
		data.append('password', password);
		data.append('tgl_lahir', tgl_lahir);
		data.append('jk', jk);
		data.append('no_tlp', no_tlp);
		data.append('id_tele', id_tele);
		data.append('alamat', alamat);
		data.append('asal_sekolah', asal_sekolah);
		data.append('id_divisi', id_divisi);
		data.append('id_mentor', id_mentor);
		data.append('tgl_mulai', tgl_mulai);
		data.append('tgl_akhir', tgl_akhir);
		data.append('surat', surat);
		
		var foto = $('[name="foto"]');
		if(foto.val()!=""){
	        data.append('foto', $('[name="foto"]')[0].files[0]); 
	    }
		

		$.ajax({
            url : "api/admin/users/",
            method : "POST",
            processData: false,
            contentType: false,
            data : data,
            success: function(response){
                window.location.href = "/users";
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
			   var here = document.getElementById("here");
			   username.focus();
    		   here.scrollIntoView();
			}

        })

	}
	</script>

</body>
</html>