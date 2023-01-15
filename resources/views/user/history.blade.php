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
					<div class="page-header">
						<h4 class="page-title">Riwayat Kehadiran</h4>
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
									<div class="row">
										<div class="col-md-3">
											<label for="" class="mb-1">Tahun</label>
											<select name="tahun" id="e2" class="form-control select-search select2 mb-1">
												@php for($i=date('Y');$i>=2022;$i--){ @endphp
												<option value="{{ $i }}">{{ $i }}</option>
												@php } @endphp
											</select>
										</div>
										<div class="col-md-3">
											<label for="" class="mb-1">Bulan</label>
											<select name="bulan" id="e3" class="form-control select-search select2 mb-1">
												@php 
												$bulan=["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
												for($i=0;$i<12;$i++){ 
													$b = $i+1; if($i<9){$b ="0".$i+1;} 
													$select=""; if($b == date('m')){$select="selected";} @endphp
												<option value="{{ $b }}" {{ $select }}>{{ $bulan[$i] }}</option>
												@php } @endphp
											</select>
										</div>
										@php if(session('id_level')=='mentor' || session('id_level')=='admin'){ @endphp
										<div class="col-md-3">
											<label for="" class="mb-1">Peserta</label>
											<select name="karyawan" id="e1" class="form-control mb-1 pt-2 pb-4">
											</select>
										</div>
										@php } @endphp
										<div class="col-md-3">
											<button class="btn btn-danger mt-3" onclick="return searchLoad()">
												<i class="fas fa-magnifying-glass"></i>
												Cari
											</button>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="table table-striped table-hover w-100" >
											<thead>
												<tr>
													<th>Tanggal</th>
													<th>Keterangan</th>
													<th>Jam Masuk</th>
													<th>Lokasi Masuk</th>
													<th>Jam Pulang</th>
													<th>Lokasi Pulang</th>
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
		
	getHistory();

	@php if(session('id_level')=='mentor' || session('id_level')=='admin'){ @endphp
    getCboKaryawan()
    function getCboKaryawan(){
        $.ajax({
				@php if(session('id_level')=='admin'){ @endphp
					url: "{{ URL::to('api/admin/users') }}",
				@php } @endphp
				@php if(session('id_level')=='mentor'){ @endphp
					url: "{{ URL::to('api/teach/users') }}",
				@php } @endphp
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

	function getHistory() {
		var table =	$('#basic-datatables').DataTable({
			"bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true, 
            "bAutoWidth": true,
            "ordering": false,
            "sAjaxSource": '{{ URL::to('api/user/history') }}',
            "aoColumns": [
                { "mData": "tgl",className: 'text-center' }, 
				{ "mData": "ket" },
                { "mData": "checkIn",className: 'text-center' }, 
                { "mData": "loc_in",className: 'text-center',
                    render: function (data) {
                        data = '<a href="https://www.google.com/maps?q='+data+'&hl=es;z=14" target="_blank">'+data+'</a>';
                        return data;
                    }
                }, 
                { "mData": "checkOut",className: 'text-center' }, 
                { "mData": "loc_out",className: 'text-center',
                    render: function (data) {
                        data = '<a href="https://www.google.com/maps?q='+data+'&hl=es;z=14" target="_blank">'+data+'</a>';
                        return data;
                    }
                }
            ],
            stateSave: true,
            "bDestroy": true
			});
		}

		 function searchLoad(){
			tahun = { "name": "tahun", "value": $('[name="tahun"]').val() };
			bulan = { "name": "bulan", "value": $('[name="bulan"]').val() };
			data = [tahun, bulan];
			@php if(session('id_level')=='mentor' || session('id_level')=='admin'){ @endphp
			karyawan = { "name": "karyawan", "value": $('[name="karyawan"]').val() };
			data = [tahun, bulan, karyawan];
			@php } @endphp
        
			var table = $('#basic-datatables').DataTable({
				"bPaginate": true,
				"bLengthChange": true,
				"bFilter": true,
				"bInfo": true, 
				"bAutoWidth": true,
				"ordering": false,
				"sAjaxSource": '{{ URL::to('api/history-presensi-search') }}',
				"sAjaxDataProp": "data",
				"fnServerParams": function (aoData) {
					@php if(session('id_level')=='mentor' || session('id_level')=='admin'){ @endphp
						if (data) { aoData.push(data[0], data[1], data[2]); }
					@php }else{ @endphp
						if (data) { aoData.push(data[0], data[1]); }
					@php } @endphp
				},
				"aoColumns": [
                { "mData": "tgl",className: 'text-center' }, 
				{ "mData": "ket" },
                { "mData": "checkIn",className: 'text-center' }, 
                { "mData": "loc_in",className: 'text-center',
                    render: function (data) {
                        data = '<a href="https://www.google.com/maps?q='+data+'&hl=es;z=14" target="_blank">'+data+'</a>';
                        return data;
                    }
                }, 
                { "mData": "checkOut",className: 'text-center' }, 
                { "mData": "loc_out",className: 'text-center',
                    render: function (data) {
                        data = '<a href="https://www.google.com/maps?q='+data+'&hl=es;z=14" target="_blank">'+data+'</a>';
                        return data;
                    }
                }
            ],
				stateSave: true,
				"bDestroy": true
			});
		}	
	</script>

</body>
</html>