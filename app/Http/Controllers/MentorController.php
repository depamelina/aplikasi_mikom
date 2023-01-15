<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\CarbonPeriod;

class MentorController extends Controller
{
    public function users(){
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('users')
                    ->select(
                        DB::raw('(@row_number:=@row_number + 1) as no'),
                        'foto',
                        'users.username',
                        'nama_lengkap',
                        'divisi',
                        'asal_sekolah',
                        'email',
                        'no_tlp',
                        'id_tele'
                        )
                    ->where('id_level','=','user')
                    ->where('id_mentor','=',session('username'))
                    ->join('divisi','divisi.id','users.id_divisi')
                    ->join('users_detail','users_detail.username','users.username')
                    ->get();

        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
        ]);
    }

    public function tugas(){
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('tugas')
                    ->select(
                        'id',
                        DB::raw('(@row_number:=@row_number + 1) as no'),
                        DB::raw('DATE_FORMAT(tgl_add,"%d/%m/%Y") as tgl_add'),
                        'user_peserta',
                        'users.nama_lengkap',
                        'tgl_deadline',
                        'file_tugas',
                        'ctt_tugas',
                        'desk_tugas',
                        'file_jawaban',
                        'tgl_jawab',
                        'ctt_jawab',
                        'foto_bukti',
                        DB::raw('if(tugas.status="1","Proses",if(tugas.status="2","Selesai","Dikonfirmasi")) as status')
                        )
                    ->where('user_mentor','=',session('username'))
                    ->join('users','users.username','tugas.user_peserta')
                    ->get();

        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
        ]);
    }

    
    public function tugasById($id){
        $data = DB::table('tugas')
                    ->select(
                        'user_peserta',
                        'id',
                        'tgl_deadline',
                        'file_tugas',
                        'ctt_tugas',
                        'desk_tugas',
                      )
                    ->where('id','=',$id)
                    ->join('users','users.username','tugas.user_peserta')
                    ->get();

        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data[0]
        ]);
    }

    public function addTugas(Request $request){
        $fileTugas = null;
        if($request->file_tugas){
            $fileTugas = time().'.'.$request->file_tugas->extension(); 
            $request->file_tugas->move(public_path('/tugas/'), $fileTugas);
        }

        $data = DB::table('tugas')
                ->insert(
                array(
                    'user_mentor' => session('username'),
                    'user_peserta' => $request->user_peserta,
                    'tgl_add' => date('Y-m-d H:i:s'),
                    'tgl_deadline' => $request->tgl_deadline,
                    'file_tugas' => $fileTugas,
                    'ctt_tugas' => $request->ctt_tugas,
                    'desk_tugas' => $request->desk_tugas,
                    'status' => '1'
                    )
                );
        
        return response()->json([
            'message' => 'TRUE',
            'data' => $data
        ],200);

    }

    public function updateTugas(Request $request,$id)
    { $fileTugas = null;
        if($request->file_tugas){
            $fileTugas = time().'.'.$request->file_tugas->extension(); 
            $request->file_tugas->move(public_path('/tugas/'), $fileTugas);
        }
        $data = DB::table('tugas')
                ->where('id',$id)
                ->update(
                array(
                    'tgl_deadline' => $request->tgl_deadline,
                    'file_tugas' => $fileTugas,
                    'ctt_tugas' => $request->ctt_tugas,
                    'desk_tugas' => $request->desk_tugas
                    )
                );
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function deleteTugas($id){
       
            $data = DB::table('tugas')
            ->where('id',$id)
            ->delete();
        
            
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
                    ->where('user_mentor','=',session('username'))
                    ->join('users','users.username','absen.username')
                    ->get();

        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
        ]);
    }

    public function validAbsen(Request $request, $id){
         
        $s = $request->status;
        $a = $request->status_pre;
        if ($a == "izin"){
            $a = "";
        } else if ($a == "sakit") {
            $a = "S";
        } else if($s == 0){
            $a = "T";
        }

        $data = DB::table('absen')
            ->select('absen')
            ->where('id','=', $id)
            ->update(array('status' => $request->status));

        $data = DB::table('presensi')
            ->where('id_absen','=', $id)
            ->update(array('status' => $a, 'ket' => $request->ket));

        $period = CarbonPeriod::create($request->dari_tgl, $request->sampai_tgl);
        $dates = $period->toArray();

        for($i=1;$i<count($dates);$i++){
            $data = DB::table('presensi')
                    ->insert(array(
                        'username' => $request->username,
                        'tanggal' => $dates[$i],
                        'ket' => $request->ket,
                        'status' => $a
                        )
                    );
        }

        return response()->json([
            'message' => 'TRUE',
            'data' => $data
      ],200);
}

public function absenById($id){
    $data = DB::table('absen')
        ->select('absen','status','ket_absen', 'username',
        DB::raw('DATE_FORMAT(dari_tgl,"%Y-%m-%d") as dari_tgl'),
        DB::raw('DATE_FORMAT(sampai_tgl,"%Y-%m-%d") as sampai_tgl')
        )
        ->where('id','=', $id)
        ->get();

    return response()->json([
        'message' => 'TRUE',
        'data' => $data[0]
  ],200);
}
}
