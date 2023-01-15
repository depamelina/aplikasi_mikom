<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\AuthModel;

class AuthController extends Controller
{
    public function index()
    {
        //Session::flush();
        return response()->json([
            'status' => true,
            'message' => 'true',
        ]);
    }
    public function login(Request $request)
    {
        $info = array(
            'status' => false,
            'message' => 'false',
            'data' => ''
        );
        $username = $request->username;
        $password = $request->password;
        $data = DB::table('users')
                ->select('username', 'password', 'nama_lengkap', 'id_level', 'id_divisi', 'foto','id_mentor')
                ->where('username', $username)
                ->where('password', $password)
                ->first();
        if($data){
            session([
                'username' => $data->username, 
                'nama_lengkap' => $data->nama_lengkap, 
                'id_level' => $data->id_level, 
                'id_divisi' => $data->id_divisi, 
                'foto' => $data->foto,
                'id_mentor' => $data->id_mentor, 
            ]);
            //Session::flush();
            $info = array(
                'status' => true,
                'message' => 'true',
                'data' => $data
            );
        }else{
            $dataa = DB::table('teach')
                    ->select('username', 'password', 'nama_lengkap', 'id_divisi', 'id_level', 'foto')
                    ->where('username', $username)
                    ->where('password', $password)
                    ->first();
            if($dataa){
                session([
                    'username' => $dataa->username, 
                    'nama_lengkap' => $dataa->nama_lengkap, 
                    'id_level' => $dataa->id_level, 
                    'id_divisi' => $dataa->id_divisi, 
                    'foto' => $dataa->foto,
                ]);
            
            $info = array(
                'status' => true,
                'message' => 'true',
                'data' => $dataa
            );
             } else {
                $info = array(
                    'status' => true,
                    'message' => 'false',
                    'data' => ''
                );
             }
        }
        return response()->json([$info],200);
    }

    public function logout()
    {
        Session::flush();
        $info = array(
            'status' => true,
            'message' => 'TRUE',
            'data' => "");
        return response()->json([$info],200);
    }

    public function profile(){
        if(session('username')){
            $username = session('username');
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

    public function teachProfile(){
        if(session('username')){
            $username = session('username');
            $data = DB::table('teach') 
                    ->select(
                        'username', 
                        'password',
                        'nama_lengkap',
                        'id_level',
                        'id_divisi',
                        'foto',
                        'email',
                        'id_tele',
                        'no_tlp'            
                    )
                    ->where('username', $username)
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
}
