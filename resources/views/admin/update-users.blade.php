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
					<h5 class="page-title">Ubah Peserta Magang</h5>
					<div class="row justify-content-center">
						<div class="col-lg-11">
							<div class="card">
								<div class="card-header bg-danger">
									<a class="btn btn-danger btn-sm"  href="/users">Kembali</a>
								</div>
                                <div class="card-body">
									<div class="row mt-3 justify-content-center">
                                        <div class="avatar avatar-xxl mb-3">
                                            <img id="foto" alt="user" src="{{ URL::to('/images/default.png') }}" class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-4">
											<label class="mb-1">UBAH FOTO</label>
                                            <input type="file" class="image form-control" name="foto">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Nama</label>
												<input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" required>
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
												<input type="text" class="form-control" name="username" placeholder="Username" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Password</label>
												<input type="password" class="form-control" name="password" placeholder="Name" required>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Tanggal Lahir</label>
												<input type="date" class="form-control" name="tgl_lahir" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Jenis Kelamin</label>
												<select class="form-control" name="jk" required>
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
												<select name="divisi" class="form-control">
                                    			</select>
                                        	</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Pembimbing</label>
												<select name="id_mentor" class="form-control">
                                    			</select>
											</div>
										</div>
                                    </div>
                                    <div class="row">
										<div class="col-md-6">
											<div class="form-group form-group-default">
												<label>Tanggal Masuk</label>
												<input type="date" class="form-control" name="tgl_mulai" placeholder="Birth Date">
											</div>
										</div>
										<div class="col-md-6">
                                        <div class="form-group form-group-default">
												<label>Tanggal Berakhir</label>
												<input type="date" class="form-control" name="tgl_akhir" placeholder="Birth Date">
											</div>
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
                                            <a href="/users" class="btn btn-danger mr-1">Batal </a>
                                            <button class="btn btn-success" onclick="return saveUsers()">Simpan</button>
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

	firstLoad();
	
	getCboDivisi()
    function getCboDivisi(){
		$.ajax({
            url: "{{ URL::to('api/admin/divisi') }}",
            method: "GET",
            success: function (response) {
                html="";
                for(i=0;i<response.data.length;i++){
                    html += '<option value="'+response.data[i].id+'">'+response.data[i].divisi+'</option>"';
                } 
                $('[name="divisi"]').html(html);
            }
        })
    }

	getCboTeach()
    function getCboTeach(){
        $.ajax({
            url: "{{ URL::to('api/admin/teach') }}",
            method: "GET",
            success: function (response) {
                html="";
                for(i=0;i<response.data.length;i++){
                    html += '<option value="'+response.data[i].username+'">'+response.data[i].nama_lengkap+'</option>"';
                } 
                $('[name="id_mentor"]').html(html);
            }
        })
    }

	function firstLoad(){
        $.ajax({
            url : "{{ URL::to('api/admin/users') }}/{{ $username}}",
            method : "GET",
            success: function(response){
				$('#foto').attr("src","{{ URL::to('/images') }}/"+response.data.foto);
                $('#foto').attr("width","150px");
                $('#foto').attr("height","150px");
				$('[name="nama_lengkap"]').val(response.data.nama_lengkap); 
				$('[name="email"]').val(response.data.email); 
				$('[name="username"]').val(response.data.username); 
				$('[name="password"]').val(response.data.password); 
				$('[name="tgl_lahir"]').val(response.data.tgl_lahir); 
				$('[name="jk"]').val(response.data.jk); 
				$('[name="no_tlp"]').val(response.data.no_tlp); 
				$('[name="id_tele"]').val(response.data.id_tele); 
				$('[name="alamat"]').val(response.data.alamat); 
				$('[name="asal_sekolah"]').val(response.data.asal_sekolah); 
				$('[name="divisi"]').val(response.data.id_divisi); 
				$('[name="id_mentor"]').val(response.data.id_mentor); 
				$('[name="tgl_mulai"]').val(response.data.tgl_mulai); 
				$('[name="tgl_akhir"]').val(response.data.tgl_akhir); 
			}
        })
    }

	function saveUsers(){
		var nama_lengkap = $('[name="nama_lengkap"]').val(); 
		var email = $('[name="email"]').val(); 
		var foto = $('[name="foto"]'); 
		var username = $('[name="username"]').val(); 
		var password = $('[name="password"]').val(); 
		var tgl_lahir = $('[name="tgl_lahir"]').val(); 
		var jk = $('[name="jk"]').val(); 
		var no_tlp = $('[name="no_tlp"]').val(); 
		var id_tele = $('[name="id_tele"]').val(); 
		var alamat = $('[name="alamat"]').val(); 
		var asal_sekolah = $('[name="asal_sekolah"]').val(); 
		var divisi = $('[name="divisi"]').val(); 
		var id_mentor = $('[name="id_mentor"]').val(); 
		var tgl_mulai = $('[name="tgl_mulai"]').val(); 
		var tgl_akhir = $('[name="tgl_akhir"]').val(); 
		var surat = $('[name="surat"]').val(); 

		data = new FormData();
		data.append('nama_lengkap', nama_lengkap);
		data.append('email', email);
	    data.append('username', username);
		data.append('password', password);
		data.append('tgl_lahir', tgl_lahir);
		data.append('jk', jk);
		data.append('no_tlp', no_tlp);
		data.append('id_tele', id_tele);
		data.append('alamat', alamat);
		data.append('asal_sekolah', asal_sekolah);
		data.append('id_divisi', divisi);
		data.append('id_mentor', id_mentor);
		data.append('tgl_mulai', tgl_mulai);
		data.append('tgl_akhir', tgl_akhir);
		data.append('surat', surat);

		if(foto.val()!=""){
	        data.append('foto', $('[name="foto"]')[0].files[0]); 
	    }

		$.ajax({
            url : "{{ URL::to('api/admin/users') }}/{{ $username}}",
            method : "POST",
            processData: false,
            contentType: false,
            data : data,
            success: function(response){
                window.location.href = "/users";
            }
        })

	}

	</script>

</body>
</html>