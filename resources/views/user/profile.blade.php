<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

        {{ view('component.sidebar3') }}

        <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<h4 class="page-title">Profile</h4>
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="ml-2">
                                     <ul class="nav nav-pills nav-danger" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Pengaturan Akun</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Data Pribadi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Program Magang</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-pro" role="tab" aria-controls="pills-pro" aria-selected="false">Tugas Projek</a>
                                        </li>
                                    </ul>
								</div>
                                    <div class="card-body">
                                        <div class="tab-content mb-3" id="pills-tabContent">
                                            <div class="tab-pane fade active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="avatar avatar-xxl mb-3 ml-5">
                                                            <img src="{!! asset('images/'.session('foto'))!!}" alt="user"
                                                            class="avatar-img rounded-circle">
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <input type="file" class="image form-control" name="foto">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Nama Lengkap</label>
                                                                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Username</label>
                                                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                        <label>Password</label>
                                                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                        
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Tanggal Lahir</label>
                                                            <input type="text" class="form-control" id="datepicker" name="tgl_lahir" placeholder="Birth Date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <div class="form-group form-group-default">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-control" name="jk">
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Phone</label>
                                                            <input type="text" class="form-control"  name="no_tlp" placeholder="Phone">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Email</label>
                                                            <input type="text" class="form-control"  name="email" placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>ID Telegram</label>
                                                            <input type="text" class="form-control" name="id_tele" placeholder="Address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Asal Sekolah</label>
                                                            <input type="text" class="form-control" name="asal_sekolah" placeholder="Address">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Alamat</label>
                                                            <textarea name="alamat" id="" class="form-control" cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Tanggal Mulai</label>
                                                                    <input type="text" class="form-control"  name="tgl_mulai" placeholder="Birth Date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Tanggal Akhir</label>
                                                                    <input type="text" class="form-control" name="tgl_akhir" placeholder="Birth Date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Divisi</label>
                                                                    <select name="id_divisi" class="form-control">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group form-group-default">
                                                            <label>SURAT PENGANTAR MAGANG</label><br>
                                                            <button class="btn btn-danger mb-2">Buka</button>
                                                            <!-- <span class="ml-4"><embed src="{{ asset('fileku.pdf') }}" width="actual-width.px" height="500" alt="pdf" /></span>  -->
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="pills-pro" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                <div class="row">
                                                    <div class="col-md-12 mb-2">
                                                        <div class="alert alert-danger fade show" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h4>Isi data dibawah ini jika sudah mempunyai tugas projek misalnya aplikasi </h4> <small class="text-muted">* link dapat berupa url website, github atau gdrive</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Judul Tugas Projek</label>
                                                                    <input type="text" class="form-control"  name="jdl_pro" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Keterangan</label>
                                                                    <textarea name="ket_pro" id="" class="form-control" cols="30" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group form-group-default">
                                                                    <label>Link Projek</label>
                                                                    <input type="text" class="form-control" name="link_pro" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-8 mb-4">
                                                                <button class="btn btn-block btn-success" onclick="return isiPro()">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-header bg-danger text-white">
                                                                <i class="fa-solid fa-link fa-lg mr-2"></i> Daftar Link Projek                                         
                                                            </div>
                                                            <div class="card-body" id="link">
                                                                    
                                                            </div> 
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="card-footer">
                                        <div class="text-right">
                                            <input type="reset" value="Batal" class="btn btn-danger">
                                            <button class="btn btn-success">Simpan</button>
                                        </div>
                                    </div> -->
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
     getPro();

     $( document ).ready(function() {
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                    localStorage.setItem('lastTab', $(this).attr('href'));
            });
            var lastTab = localStorage.getItem('lastTab');
                
            if (lastTab) {
                    $('[href="' + lastTab + '"]').tab('show');
                }
    });  

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
                $('[name="id_divisi"]').html(html);
            }
        })
    }
    
    function firstLoad(){
        $.ajax({
            url : "api/profile",
            method : "GET",
            success: function(response){
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
				$('[name="id_divisi"]').val(response.data.id_divisi); 
				$('[name="id_mentor"]').val(response.data.id_mentor); 
				$('[name="tgl_mulai"]').val(response.data.tgl_mulai); 
				$('[name="tgl_akhir"]').val(response.data.tgl_akhir);       
            }
        })
    }

    function getPro(){
        $.ajax({
            url : "{{ URL::to('api/user/proyek') }}",
            method : "GET",
            success: function(response){
				var html='';
				if(response.message == "FALSE"){return;}
				for(i=0;i<response.data.length;i++){
                    var judul="";
                    var link="";
                    var ket="";
                    if(response.data[i].jdl_pro){judul=response.data[i].jdl_pro;}
                    if(response.data[i].link_pro){link=response.data[i].link_pro;}
                    if(response.data[i].ket_pro){ket=response.data[i].ket_pro;}
                     html += '<div class="row">'
                            + '<div class="col-md-9">'
                            + '<p><b>'+ judul +'</b> '+ '(<a href="'+ link +'">'+ link +'</a>) <br>' + ket +'</p>'
                            + '</div>'
                            + '<div class="col-md-3">'
                            // + '<button class="btn btn-sm btn-danger ml-auto">Detail</button>'
                            + '</div>'
                            + '</div>'
                            + '<hr>';
					}
				$('#link').html(html);  
			}
        })
    }

    function isiPro(){
			var jdl_pro = $('[name="jdl_pro"]').val(); 
			var ket_pro = $('[name="ket_pro"]').val(); 
			var link_pro = $('[name="link_pro"]').val(); 

			data = new FormData();
			data.append('jdl_pro', jdl_pro);
			data.append('ket_pro', ket_pro);
			data.append('link_pro', link_pro);
			
			$.ajax({
				url : "api/user/proyek/",
				method : "POST",
				processData: false,
				contentType: false,
				data : data,
				success: function(response){
					window.location.hash = "#";
                    window.location.hash = "#pills-pro";
				},

			})

		}
</script>
</body>
</html>