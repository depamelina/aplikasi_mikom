<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        if(session('username')){
            $username = session('username'); 
            $data = DB::table('presensi')
                    ->select(
                        DB::raw('TIME_FORMAT(time_in,"%H:%i") as in_time'),
                        DB::raw('TIME_FORMAT(time_out,"%H:%i") as out_time'),
                        DB::raw('IF( time_in,"SUDAH","BELUM") as presensiMasuk'),
                        DB::raw('IF( time_out,"SUDAH","BELUM") as presensiPulang'),
                        'status',
                        )
                    ->where('username', $username)
                    ->where('tanggal', date('Y-m-d'))
                    // ->join('jamkerja','jamkerja.id','users_detail.id_jamker')
                    // ->join('users_detail','users_detail.username','presensi.username')
                    ->get();
            if(count($data)>0){
                return response()->json([
                  'message' => 'TRUE',
                  'data' => $data[0]
                ],200);
            }else{
                return response()->json([
                  'message' => 'FALSE'
                ],200);
            }
        }else{
            return response()->json([
              'message' => 'LOGOUT',
            ],200);
        }   
    }

    public function userDash()
    {
       $data = DB::table('presensi')
            ->select('status')
            ->where('status','=', 'H')
            ->where('username','=', session('username'))
            ->count();

        $dataa = DB::table('presensi')
            ->select('status')
            ->where(function ($query){
                $query->where('status', '=', 'I')
                ->orWhere('status', '=', 'S');
            })
            ->where('username','=', session('username'))
            ->count();

        $datap = DB::table('presensi')
            ->select('status')
            ->where('status','=', 'P')
            ->where('username','=', session('username'))
            ->count();

        $jadwal = DB::table('users_detail')
            ->select( 'jam_in')
            ->join('jamkerja','jamkerja.id','users_detail.id_jamker')
            ->where('username','=', session('username'))
            ->value('jam_in');

        $jadwaal = DB::table('users_detail')
            ->select('jam_out')
            ->join('jamkerja','jamkerja.id','users_detail.id_jamker')
            ->where('username','=', session('username'))
            ->value('jam_out');
        
        return response()->json([
            'status' => true,
            'message' => 'ok',
            'data' => $data,
            'data2' => $dataa,
            'data3' => $jadwal,
            'data4' => $jadwaal,
            'data5' => $datap
        ]);
    }

    public function teachBio()
    {
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('teach')
                    ->select(
                        'teach.nama_lengkap',
                        'email',
                        'no_tlp',
                        'id_tele'
                    )
                    ->where('teach.username','=', session('id_mentor'))
                    ->join('users','users.id_mentor','teach.username')
                    ->get();
            return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data[0]
            ]);
    }

    public function history()
    {
        if(session('username')){
            $username = session('username'); 
            $data = DB::table('presensi')
                    ->select(
                        DB::raw('DATE_FORMAT(tanggal,"%e") as tgl'),
                        'ket',
                        DB::raw('DATE_FORMAT(time_in,"%H:%i") as checkIn'),
                        DB::raw('DATE_FORMAT(time_out,"%H:%i") as checkOut'),
                        'loc_in',
                        'loc_out',
                    )
                    ->where('username', $username)
                    ->where(DB::raw('DATE_FORMAT(tanggal,"%m%Y")'), date('mY'))
                    ->get();
            $date=[];
            for($i=0;$i<date('t');$i++){
                $date[$i]['tgl']=($i+1).date(" F Y");
                $date[$i]['ket']='';
                $date[$i]['checkIn']='';
                $date[$i]['checkOut']='';
                $date[$i]['loc_in']='';
                $date[$i]['loc_out']='';        
            }                
            foreach($data as $d){
                $date[$d->tgl-1]['ket']=$d->ket;
                $date[$d->tgl-1]['checkIn']=$d->checkIn;
                $date[$d->tgl-1]['checkOut']=$d->checkOut;
                $date[$d->tgl-1]['loc_in']=$d->loc_in;
                $date[$d->tgl-1]['loc_out']=$d->loc_out;
            }
            if(count($date)>0){
                return response()->json([
                'message' => 'TRUE',
                'data' => $date,
                ],200);
            }else{
                return response()->json([
                'message' => 'FALSE'
                ],200);
            }
        }else{
            return response()->json([
            'message' => 'LOGOUT',
            ],200);
        }
    }

public function kegharian()
{
    if(session('username')){
        $username = session('username'); 
        $data = DB::table('presensi')
                ->select(
                    DB::raw('DATE_FORMAT(tanggal,"%e") as tgl'),
                    'foto_keg',
                    'laporan_keg',
                    'kendala',
                    'solusi',
                )
                ->where('username', $username)
                ->where(DB::raw('DATE_FORMAT(tanggal,"%m%Y")'), date('mY'))
                ->get();
        $date=[];
        for($i=0;$i<date('t');$i++){
            $date[$i]['tgl']=($i+1).date(" F Y");
            $date[$i]['foto_keg']='';
            $date[$i]['laporan_keg']='';
            $date[$i]['kendala']='';
            $date[$i]['solusi']='';        
        }                
        foreach($data as $d){
            $date[$d->tgl-1]['foto_keg']=$d->foto_keg;
            $date[$d->tgl-1]['laporan_keg']=$d->laporan_keg;
            $date[$d->tgl-1]['kendala']=$d->kendala;
            $date[$d->tgl-1]['solusi']=$d->solusi;
        }
        if(count($date)>0){
            return response()->json([
              'message' => 'TRUE',
              'data' => $date,
            ],200);
        }else{
            return response()->json([
              'message' => 'FALSE'
            ],200);
        }
    }else{
        return response()->json([
          'message' => 'LOGOUT',
        ],200);
    }
}

    public function nilai()
    {
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('nilai')
                        ->select(
                            'id',
                            DB::raw('(@row_number:=@row_number + 1) as no'),
                            'kriteria',
                            'nilai'
                        )
                        ->where('username', '=', session('username'))                    
                        ->get();

            foreach($data as $d)
            {
              if($d->status = 2){
                    $d->status = '<span class="badge badge-danger"> Pending </span>';
                } else {
                     $d->status = '<span class="badge badge-success> Success</span>';
                }                
            }
            
            return response()->json([
                'status' => true,
                'message' => 'ok',
                'data' => $data
                ]);
    }

    
    public function addKriteria(Request $request)
    {
        $data = DB::table('nilai')
                ->insert(
                array(
                    'username' => session('username'),
                    'kriteria' => $request->kriteria,
                    'status' => 1
                    )
                );
            
        return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function kriteriaById($id)
    {
        $data = DB::table('nilai')
                    ->select(
                        'id',
                        'kriteria',
                        'nilai')
                    ->where('id',$id)
                    ->get();
            return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data[0]
            ]);
            
    }

    public function updateKriteria(Request $request,$id)
    {
        $data = DB::table('nilai')
                ->where('id',$id)
                ->update(
                array(
                    'kriteria' => $request->kriteria
                    )
                );
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function deleteKriteria($id)
    {
            $data = DB::table('nilai')
                ->where('id',$id)
                ->delete();
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function formNilai(Request $request){
            $suratName = null;
            if($request->form_nilai){
                $suratName = time().'.'.$request->form_nilai->extension(); 
                $request->form_nilai->move(public_path('/surat/'), $suratName);
            }
        
            $data = DB::table('users_detail')
                ->where('username','=',session('username'))
                ->update(array('form_nilai'  => $suratName));

            $data = DB::table('nilai')
                ->where('username','=',session('username'))
                ->update(array('status' => 2));

            return response()->json([
                'message' => 'TRUE',
                'data' => $data
          ],200);
    }

    public function tugas()
    {
        $data = DB::table('tugas')
                        ->select(
                            'id',
                            'ctt_tugas',
                            'desk_tugas',
                            DB::raw('DATE_FORMAT(tgl_deadline,"%d/%m/%Y") as tgl_deadline'),
                            DB::raw('DATE_FORMAT(tgl_add,"%H:%i") as tgl_add'),
                        )
                        ->where('status','=','1')
                        ->where('user_peserta', '=', session('username'))    
                        ->limit(5)                
                        ->get();
            
                        if(count($data)>0){
                            return response()->json([
                              'message' => 'TRUE',
                              'data' => $data
                            ],200);
                        }else{
                            return response()->json([
                              'message' => 'FALSE'
                            ],200);
                        }
    }

    public function tugasTampil(){
       
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('tugas')
                    ->select(
                    'id',
                    DB::raw('(@row_number:=@row_number + 1) as no'),
                    'ctt_tugas',
                    'ctt_jawab',
                    DB::raw('DATE_FORMAT(tgl_deadline,"%d/%m/%Y %H:%i") as tgl_deadline'),
                    DB::raw('DATE_FORMAT(tgl_add,"%d/%m/%Y %H:%i") as tgl_add'),
                    DB::raw('if(tugas.status="1","Belum Dikerjakan",if(tugas.status="2","Selesai","Dikonfirmasi")) as status')
                    )
                    ->where('user_peserta','=', session('username')) 
                    ->orderBy('status','ASC')   
                    ->orderBy('tgl_add','DESC')             
                    ->get();
    
                return response()->json([
                    'status' => true,
                    'message' => 'ok',
                    'data' => $data
                    ]);
    }

    public function tugasById($id)
    {
        $data = DB::table('tugas')
                    ->select(
                        'id',
                        'ctt_tugas',
                        'desk_tugas',
                        'ctt_jawab',
                        DB::raw('DATE_FORMAT(tgl_deadline,"%d/%m/%Y %H:%i") as tgl_deadline'),
                        DB::raw('DATE_FORMAT(tgl_add,"%H:%i") as tgl_add')
                    )
                    ->where('id',$id)
                    ->get();
            return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data[0]
            ]);
            
    }
  
    public function addTugas(Request $request, $id){
        $fileJawaban = null;
        $fotoBukti = null;
        if($request->file_jawaban){
            $fileJawaban = time().'.'.$request->file_tugas->extension(); 
            $request->file_tugas->move(public_path('/tugas/file/'), $fileJawaban);
        }
        if($request->foto_bukti){
            $fotoBukti = time().'.'.$request->foto_bukti->extension(); 
            $request->foto_bukti->move(public_path('/tugas/foto/'), $fotoBukti);
        }

        $data = DB::table('tugas')
                ->where('id', '=', $id)
                ->update(
                array(
                    'tgl_jawab' => date('Y-m-d H:i:s'),
                    'file_jawaban' => $fileJawaban,
                    'ctt_jawab' => $request->ctt_jawab ,
                    'foto_bukti' => $fotoBukti,
                    'status' => '2'
                    )
                );
                
        
        return response()->json([
            'message' => 'TRUE',
            'data' => $data
        ],200);
    }

    public function absen(){
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('absen')
                    ->select(
                        DB::raw('(@row_number:=@row_number + 1) as no'),
                        'id',
                        'users.nama_lengkap',
                        'absen',
                        DB::raw('DATE_FORMAT(tgl_pengajuan,"%d/%m/%Y") as tgl_pengajuan'),
                        DB::raw('DATE_FORMAT(dari_tgl,"%d/%m/%Y") as dari_tgl'),
                        'sampai_tgl',
                        'surat_absen',
                        'ket_absen',
                        DB::raw('if(absen.status="1","Tertunda",if(absen.status="0","Ditolak","Dikonfirmasi")) as status')
                        )
                    // ->where('absen.status','=','1')
                    ->where('absen.username','=',session('username'))
                    ->join('users','users.username','absen.username')
                    ->get();

        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
        ]);
    }

    public function absenById($id){
        $data = DB::table('absen')
            ->select(
                'id',
                'username',
                'absen',
                'user_mentor',
                DB::raw('DATE_FORMAT(tgl_pengajuan,"%d/%m/%Y") as tgl_pengajuan'),
                DB::raw('DATE_FORMAT(dari_tgl,"%d/%m/%Y") as dari_tgl'),
                DB::raw('DATE_FORMAT(sampai_tgl,"%d/%m/%Y") as sampai_tgl'),
                'surat_absen',
                'ket_absen',
                DB::raw('if(absen.status="1","Menunggu Konfirmasi",if(absen.status="0","Ditolak","Sudah Dikonfirmasi")) as status')
                )
        ->where('id','=', $id)
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'ok',
            'data' => $data[0]
      ]);
    }

    public function proyek(){
        $data = DB::table('proyek')
        ->select(
            'id',
            'username',
            'jdl_pro',
            'ket_pro',
            'link_pro',
             )
        ->where('username','=',session('username'))
        ->get();

        return response()->json([
        'status' => true,
        'message' => 'ok',
        'data' => $data
        ]);
    }

    public function addPro(Request $request){
        $data = DB::table('proyek')
                ->insert(
                array(
                    'username' => session('username'),
                    'jdl_pro' => $request->jdl_pro,
                    'ket_pro' => $request->ket_pro,
                    'link_pro' => $request->link_pro,
                    )
                );
            
        return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
    }

    
}
