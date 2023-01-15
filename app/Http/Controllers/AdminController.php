<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TeachExport;
use App\Exports\UsersExport;
use App\Exports\PresensiExport;
use Illuminate\Support\Facades\Session;
use Image;

class AdminController extends Controller
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
                        'asal_sekolah')
                    ->where('id_level','=','user')
                    ->join('divisi','divisi.id','users.id_divisi')
                    ->join('users_detail','users_detail.username','users.username')
                    ->get();
        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
        ]);
    }

    public function addUsers(Request $request)
    { 
         $this->validate($request,[
                'username' => 'required|unique:users',
            ]);

        $imageName = '';
        if($request->hasFile('foto')){
        $imageName = time().'.'.$request->foto->extension(); 
        $image = $request->file('foto');
        $destinationPathThumbnail = public_path('images/');
        $img = \Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail.'/'.$imageName);
    }
        $data = DB::table('users')
                ->insert(
                array(
                    'username'  => $request->username, 
                    'password'  => $request->password, 
                    'nama_lengkap'  => $request->nama_lengkap, 
                    'id_level' => 'user', 
                    'foto'  => $imageName,
                    'id_divisi' => $request->id_divisi, 
                    'id_mentor'  => $request->id_mentor, 
                    'status' => 1  
                    )
                );
            $data = DB::table('users_detail')
                ->insert(
                array(
                    'username' => $request->username,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jk' => $request->jk,
                    'no_tlp' => $request->no_tlp,
                    'asal_sekolah' => $request->asal_sekolah,
                    'email' => $request->email,
                    'id_tele' => $request->id_tele,
                    'alamat' => $request->alamat,
                    'id_jamker' => 1,
                    'tgl_mulai' => $request->tgl_mulai,
                    'tgl_akhir' => $request->tgl_akhir,
                    'surat' => $request->surat,                  
                    )
                );
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
               
    }

    public function usersById($username)
    {
        $data = DB::table('users') 
                    ->select(
                        'users.username', 
                        'password',
                        'nama_lengkap',
                        'id_level',
                        'id_divisi',
                        'divisi',
                        'foto',
                        'id_mentor',
                        'tgl_lahir',
                        'jk',
                        'no_tlp',
                        'asal_sekolah',
                        'email',
                        'id_tele',
                        'alamat',
                        'tgl_mulai',
                        'tgl_akhir',
                        'surat'                        
                    )
                    ->join('users_detail', 'users_detail.username','=','users.username')
                    ->join('divisi', 'divisi.id','=','users.id_divisi')
                    ->where('users.username', $username)
                    ->get();
                    
            return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data[0]
            ]);
         
    }

    public function updateUsers(Request $request,$username)
    {
            $user = DB::table('users')
                ->select('foto')
                ->where('username',$username)
                ->get();
            $foto = "";
            foreach($user as $u){$foto=$u->foto;}
            $data =            
                array(
                    'username'  => $request->username, 
                    'password'  => $request->password, 
                    'nama_lengkap'  => $request->nama_lengkap, 
                    'id_divisi' => $request->id_divisi, 
                    'id_mentor'  => $request->id_mentor,
                );
            if($request->file('foto')){
                if($foto){
                        unlink(public_path('images/'.$foto));
                }
                    $name = time().'.'.$request->foto->extension(); 
                    $destinationPathThumbnail = public_path('images/');
                    $image = $request->file('foto');
                    $img = \Image::make($image->path());
                    $img->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPathThumbnail.'/'.$name);
                        
                    $data['foto'] = $name;
                }

            $data = DB::table('users')
                  ->where('username',$username)
                  ->update($data);

            
            $data = DB::table('users_detail')
                ->where('username',$username)
                ->update(
                array(
                    'username' => $request->username,
                    'tgl_lahir' => $request->tgl_lahir,
                    'jk' => $request->jk,
                    'no_tlp' => $request->no_tlp,
                    'asal_sekolah' => $request->asal_sekolah,
                    'email' => $request->email,
                    'id_tele' => $request->id_tele,
                    'alamat' => $request->alamat,
                    'tgl_mulai' => $request->tgl_mulai,
                    'tgl_akhir' => $request->tgl_akhir,
                    'surat' => $request->surat,
                    )
                );
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
               
    }

    public function profileUser($username){
        if(session('username')){
            $data = DB::table('users') 
                    ->select(
                        'users.username', 
                        'password',
                        'nama_lengkap',
                        'id_level',
                        'id_divisi',
                        'foto',
                        'id_mentor',
                        'tgl_lahir',
                        'jk',
                        'no_tlp',
                        'asal_sekolah',
                        'email',
                        'id_tele',
                        'alamat',
                        'tgl_mulai',
                        'tgl_akhir',
                        'surat'                 
                    )
                    ->join('users_detail', 'users_detail.username','=','users.username')
                    ->join('divisi', 'divisi.id','=','users.id_divisi')
                    ->where('users.username', $username)
                    ->get();
                    
            return response()->json([
              'message' => 'TRUE',
              'data'    => $data[0]
            ],200);
        }else{
            return response()->json([
              'message' => 'LOGOUT'
            ],200);
        }
    }

    public function proyekUser($username){
        $data = DB::table('proyek')
            ->select(
                'id',
                'username',
                'jdl_pro',
                'ket_pro',
                'link_pro',
                )
        ->where('username','=', $username)
        ->get();

        return response()->json([
        'status' => true,
        'message' => 'ok',
        'data' => $data
        ]);
    }

    public function deleteUsers($username)
    {
        $user = DB::table('users')
                ->select('foto')
                ->where('username',$username)
                ->value('foto');
        unlink(public_path('images/'.$user));

        $data = DB::table('users')
        ->where('username',$username)
        ->delete();
    
        $data = DB::table('users_detail')
            ->where('username',$username)
            ->delete();
        
        return response()->json([
        'message' => 'TRUE',
        'data' => $data
        ],200);      
    }

    public function dataUser($username){
        if(session('username')){
            $data = DB::table('users')
                    ->select('nama_lengkap')
                    ->where('id_mentor','=', $username) 
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
        }else{
            return response()->json([
              'message' => 'LOGOUT',
            ],200);
        }   
    }
    //teach

    public function teach()
    {
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('teach')
                    ->select(
                        DB::raw('(@row_number:=@row_number + 1) as no'),
                        'username',
                        'foto',
                        'nama_lengkap',
                        'divisi',
                        'email',
                        'no_tlp',
                        'id_tele')
                    ->join('divisi','divisi.id','teach.id_divisi')
                    ->get();
            return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
            ]);
    }

    public function teachDash()
    {
        DB::statement(DB::raw('set @row_number=0'));
        
        $data = DB::table('users')
                    ->select(
                        DB::raw('(@row_number:=@row_number + 1) as no'),
                        'teach.username',
                        'teach.nama_lengkap',
                        'divisi',
                        DB::raw('COUNT(users.username) as total'),
                        DB::raw('CONCAT(users.nama_lengkap) as nama')
                    )
                    ->groupBy('users.id_mentor')
                    ->join('teach','teach.username','users.id_mentor')
                    ->join('divisi','divisi.id','teach.id_divisi')
                    ->get();

            return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data,
            ]);
    }

    public function teachDashboard()
    {
        DB::statement(DB::raw('set @row_number=0'));

        $data = DB::table('users')
                    ->select(
                        DB::raw('(@row_number:=@row_number + 1) as no'),
                        'nama_lengkap',
                        'divisi',
                        'status'
                    )
                    ->where('id_level','=', 'user')
                    ->where('id_mentor','=', session('username'))
                    ->join('divisi','divisi.id','users.id_divisi')
                    ->get();

        foreach($data as $d){

            if($d->status = '1'){
                $d->status = '<span class="badge badge-success"> Aktif </span>';
            } else {
                $d->status = '<span class="badge badge-success> Tidak Aktif</span>';
            }

        }

        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
        ]);
    }

    public function addTeach(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|unique:teach',
        ]);

        $imageName = '';
        if($request->hasFile('foto')){
            $imageName = time().'.'.$request->foto->extension(); 
            $image = $request->file('foto');
            $destinationPathThumbnail = public_path('images/');
            $img = \Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail.'/'.$imageName);
        }
        
        $data = DB::table('teach')
                ->insert(
                array(
                    'username' => $request->username,
                    'nama_lengkap' => $request->nama_lengkap,
                    'password' => $request->password,
                    'id_divisi' => $request->id_divisi,
                    'foto' => $imageName,
                    'email' => $request->email,
                    'no_tlp' => $request->no_tlp,
                    'id_tele' => $request->id_tele
                    )
                ); 
        return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
        //}
              
    }

    public function teachById($username)
    {
        $data = DB::table('teach')
                    ->select(
                        'username',
                        'foto',
                        'nama_lengkap',
                        'password',
                        'id_divisi',
                        'email',
                        'no_tlp',
                        'id_tele')
                    ->where('username',$username)
                    ->get();
        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data[0]
            ]);
    }

    public function updateTeach(Request $request,$username)
    {
        $user = DB::table('teach')
            ->select('foto')
            ->where('username',$username)
            ->get();
        $foto = "";
        foreach($user as $u){$foto=$u->foto;}
        $data = 
        array(
            'username' => $request->username,
            'nama_lengkap' => $request->nama_lengkap,
            'password' => $request->password,
            'id_divisi' => $request->id_divisi,
            'email' => $request->email,
            'no_tlp' => $request->no_tlp,
            'id_tele' => $request->id_tele
            );
        if($request->file('foto')){
            if($foto){
                unlink(public_path('images/'.$foto));
            }
            $name = time().'.'.$request->foto->extension(); 
            $destinationPathThumbnail = public_path('images/');
            $image = $request->file('foto');
            $img = \Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail.'/'.$name);
                
            $data['foto'] = $name;
            }

        $data = DB::table('teach')
            ->where('username',$username)
            ->update($data);

            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function deleteTeach($username)
    {
        $data = DB::table('teach')
                ->where('username',$username)
                ->delete();
            
        return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function exportTeach(){
        return Excel::download(new TeachExport, 'pembimbing.xlsx');
    }

    public function exportUsers(){
        return Excel::download(new UsersExport, 'peserta.xlsx');
    }
     
    //divisi
    public function divisi()
    {
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('divisi')
                    ->select(
                        DB::raw('(@row_number:=@row_number + 1) as no'),
                        'id',
                        'divisi')
                    ->get();
        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
        ]);
        
    }

    public function addDivisi(Request $request)
    {
        $data = DB::table('divisi')
                ->insert(
                array(
                    'divisi' => $request->divisi
                    )
                );
            
        return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function divisiById($id)
    {
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('divisi')
                    ->select(
                        'id',
                        'divisi')
                    ->where('id',$id)
                    ->get();
            return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data[0]
            ]);
            
    }

    public function updateDivisi(Request $request,$id)
    {
        $data = DB::table('divisi')
                ->where('id',$id)
                ->update(
                array(
                    'divisi' => $request->divisi
                    )
                );
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function deleteDivisi($id)
    {
            $data = DB::table('divisi')
                ->where('id',$id)
                ->delete();
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    //jamkerja
    public function jamkerja()
    {
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('jamkerja')
                    ->select(
                        DB::raw('(@row_number:=@row_number + 1) as no'),
                        'id',
                        'hari',
                        'jam_in',
                        'jam_out')
                    ->get();
            return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
            ]);
    }

    public function addJam(Request $request)
    {
        $data = DB::table('jamkerja')
                ->insert(
                array(
                    'hari' => $request->hari,
                    'jam_in' => $request->jam_in,
                    'jam_out' => $request->jam_out,
                    )
                );
            
        return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function jamById($id)
    {
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('jamkerja')
                    ->select(
                        'id',
                        'hari',
                        'jam_in',
                        'jam_out')
                    ->where('id',$id)
                    ->get();
        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data[0]
            ]);
    }

    public function updateJam(Request $request,$id)
    {
        $data = DB::table('jamkerja')
                ->where('id',$id)
                ->update(
                array(
                    'hari' => $request->hari,
                    'jam_in' => $request->jam_in,
                    'jam_out' => $request->jam_out
                    )
                );
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function deleteJam($id)
    {
            $data = DB::table('jamkerja')
                ->where('id',$id)
                ->delete();
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function level()
    {
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('level')
                    ->select(
                        DB::raw('(@row_number:=@row_number + 1) as no'),
                        'id',
                        'level')
                    ->get();
        return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data
        ]);
        
    }

    public function addLevel(Request $request)
    {
        $data = DB::table('level')
                ->insert(
                array(
                    'level' => $request->level
                    )
                );
            
        return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function levelById($id)
    {
        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('level')
                    ->select(
                        'id',
                        'level')
                    ->where('id',$id)
                    ->get();
            return response()->json([
              'status' => true,
              'message' => 'ok',
              'data' => $data[0]
            ]);
            
    }

    public function updateLevel(Request $request,$id)
    {
        $data = DB::table('level')
                ->where('id',$id)
                ->update(
                array(
                    'level' => $request->level
                    )
                );
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

    public function deleteLevel($id)
    {
            $data = DB::table('level')
                ->where('id',$id)
                ->delete();
            
            return response()->json([
              'message' => 'TRUE',
              'data' => $data
            ],200);
                
    }

   public function nilaiSearch(Request $request){
        $username=$request->karyawan;

        DB::statement(DB::raw('set @row_number=0'));
        $data = DB::table('nilai')
                   ->select(
                    'id',
                    DB::raw('(@row_number:=@row_number + 1) as no'),
                    'kriteria',
                    'nilai'
                    )
                    ->where('username', $username)  
                    ->where('status', '2')                  
                    ->get();

            return response()->json([
                'status' => true,
                'message' => 'ok',
                'data' => $data
            ]);
   }

   public function addNilai(Request $request, $id){
        $data = DB::table('nilai')
            ->where('id','=', $id)
            ->update(array('nilai' => $request->nilai));

        return response()->json([
                'status' => true,
                'message' => 'ok',
                'data' => $data
            ]);

   }

   public function reportAll(Request $request){
        $data = DB::table('presensi')
            ->select(
                DB::raw('DATE_FORMAT(tanggal,"%d/%m/%Y") as tanggal'),
                'nama_lengkap',
                'divisi',
                'jam_in',
                'jam_out',
                DB::raw('DATE_FORMAT(time_in,"%H:%i") as time_in'),
                DB::raw('DATE_FORMAT(time_out,"%H:%i") as time_out')
                )
            ->join('users','users.username','presensi.username')
            ->join('divisi','divisi.id','users.id_divisi')
            ->join('users_detail','users_detail.username','presensi.username')
            ->join('jamkerja','jamkerja.id','users_detail.id_jamker')
            ->where('tanggal','>=',$request->dari)
            ->where('tanggal','<=',$request->sampai)
            ->orderBy('nama_lengkap','ASC')
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

public function exportexcel(Request $request){
    $dari = $request->dari;
    $sampai = $request->sampai;
    return Excel::download(new PresensiExport($dari,$sampai), 'presensi.xlsx');

}
    
}
