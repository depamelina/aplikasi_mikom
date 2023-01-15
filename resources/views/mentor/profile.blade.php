<!DOCTYPE html>
<html lang="en">

{{ view('component.head') }}

<body>
	<div class="wrapper">
		
        {{ view('component.navbar') }}

        {{ view('component.sidebar2') }}

        <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<h4 class="page-title">Profile</h4>
					<div class="row justify-content-center">
						<div class="col-lg-10">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title"><i class="fas fa-id-card-clip text-danger mr-2"></i>   Informasi Pribadi</h4>
								</div>
                                <form>
                                    <div class="card-body">
                                        <ul class="nav nav-pills nav-danger" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Pengaturan Akun | Kontak</a>
                                            </li>
                                            <!-- <li class="nav-item">
                                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Data Pribadi</a>
                                            </li> -->
                                        </ul>
                                        <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                                <div class="row mt-3 justifiy-content-center">
                                                    <div class="col-md-2">
                                                        <div class="avatar avatar-xxl mb-3">
                                                            <img src="{!! asset('images/'.session('foto'))!!}"  alt="user"
                                                            class="avatar-img rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9 ml-2">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Nama Lengkap</label>
                                                                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>No Telepon</label>
                                                                    <input type="text" class="form-control"  name="no_tlp" placeholder="Phone">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Nama Pengguna</label>
                                                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>Email</label>
                                                                    <input type="text" class="form-control"  name="email" placeholder="Address">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                        <label>Password</label>
                                                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group form-group-default">
                                                                    <label>ID Telegram</label>
                                                                    <input type="text" class="form-control" name="id_tele" placeholder="Address">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                        
                                            </div>
                                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="card-footer">
                                        <div class="text-right">
                                            <input type="reset" value="Batal" class="btn btn-danger">
                                            <button class="btn btn-success">Simpan</button>
                                        </div>
                                    </div> -->
                                </form>
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
                $('[name="id_divisi"]').html(html);
            }
        })
    }
    
    function firstLoad(){
        $.ajax({
            url : "api/teach/profile",
            method : "GET",
            success: function(response){
                $('[name="nama_lengkap"]').val(response.data.nama_lengkap); 
				$('[name="email"]').val(response.data.email); 
				$('[name="username"]').val(response.data.username); 
				$('[name="password"]').val(response.data.password); 
				$('[name="no_tlp"]').val(response.data.no_tlp); 
				$('[name="id_tele"]').val(response.data.id_tele); 
				$('[name="id_divisi"]').val(response.data.id_divisi); 
	       }
        })
    }
</script>
</body>
</html>