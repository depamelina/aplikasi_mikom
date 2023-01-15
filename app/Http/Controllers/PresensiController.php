<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Image;

class PresensiController extends Controller
{

  public function savePresensi(Request $request)
      {
          if(session('username')){
              $location = $request->location;
              $ket = $request->ket;
              $username = session('username');

              $this->validate($request,[
                        'ket' => 'required|min:3|max:20',
                ]);

              $data = DB::table('presensi')
                      ->insert(array( 'username' =>$username ,'tanggal' => date('Y-m-d'),'time_in' => date('Y-m-d H:i:s'),'loc_in' => $location,'ket'=>$ket, 'status' => 'H'));
                      
              return response()->json([
                'message' => 'TRUE',
              ],200);
          }else{
              return response()->json([
                'message' => 'LOGOUT',
              ],200);
          }
      }

  public function presensiOut(Request $request)

  {
      if(session('username')){

            $imageName = time().'.'.$request->foto_keg->extension(); 
            $image = $request->file('foto_keg');
            $destinationPathThumbnail = public_path('images/');
            $img = \Image::make($image->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail.'/'.$imageName);

            $location = $request->location;
            $laporan = $request->laporan_keg;
            $kendala = $request->kendala;
            $solusi = $request->solusi;
            $username = session('username');

            $this->validate($request,[
                'laporan_keg' => 'required|min:3|max:20',
                'foto_keg' => 'required|image|mimes:jpg,png,jpeg|max:2048',
         ]);


            $data = DB::table('presensi')
              ->where('tanggal', date('Y-m-d'))
              ->whereNotNull('time_in')
              ->where('username', $username)
              ->update(array('time_out' => date('Y-m-d H:i:s'),'loc_out' => $location,'foto_keg'=>$imageName,'laporan_keg'=>$laporan, 'kendala'=>$kendala, 'solusi'=> $solusi));
            
              return response()->json([
                'message' => 'TRUE',
              ],200);

          }else{
              return response()->json([
                'message' => 'LOGOUT',
              ],200);
          }
      
  }

    public function historyPresensiSearch(Request $request)
    {
        if(session('username')){
            $username = session('username'); 
            if(session('id_level')=='mentor' || session('id_level')=='admin'){
                $username=$request->karyawan;
            }
            $data = DB::table('presensi')
                    ->select(
                        DB::raw('DATE_FORMAT(tanggal,"%e") as tgl'),
                        'ket',
                        DB::raw('DATE_FORMAT(time_in,"%H:%i") as checkIn'),
                        'loc_in',
                        DB::raw('DATE_FORMAT(time_out,"%H:%i") as checkOut'),
                        'loc_out')
                    ->where('username', $username)
                    ->where(DB::raw('DATE_FORMAT(tanggal,"%m%Y")'), $request->bulan.$request->tahun)
                    ->get(); 
            $date=[];
            for($i=0;$i<date('t',strtotime($request->tahun.'-'.$request->bulan.'-01'));$i++){
                $date[$i]['tgl']=($i+1).date(" F Y",strtotime($request->tahun.'-'.$request->bulan.'-01'));
                $date[$i]['ket']='';
                $date[$i]['checkIn']='';
                $date[$i]['loc_in']='';
                $date[$i]['checkOut']='';
                $date[$i]['loc_out']='';
              
            }                
            foreach($data as $d){
                $date[$d->tgl-1]['ket']=$d->ket;
                $date[$d->tgl-1]['checkIn']=$d->checkIn;
                $date[$d->tgl-1]['loc_in']=$d->loc_in;
                $date[$d->tgl-1]['checkOut']=$d->checkOut;
                $date[$d->tgl-1]['loc_out']=$d->loc_out;
            
            }
            if(count($date)>0){
                return response()->json([
                  'message' => 'TRUE',
                  'data' => $date
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

    public function kegHarianSearch(Request $request)
    {
        if(session('username')){
            $username = session('username'); 
            if(session('id_level')=='mentor' || session('id_level')=='admin'){
                $username=$request->karyawan;
            }
                $data = DB::table('presensi')
                    ->select(
                      DB::raw('DATE_FORMAT(tanggal,"%e") as tgl'),
                      'foto_keg',
                      'laporan_keg',
                      'kendala',
                      'solusi'
                      )
                    ->where('username', $username)
                    ->where(DB::raw('DATE_FORMAT(tanggal,"%m%Y")'), $request->bulan.$request->tahun)
                    ->get(); 
            $date=[];
            for($i=0;$i<date('t',strtotime($request->tahun.'-'.$request->bulan.'-01'));$i++){
                $date[$i]['tgl']=($i+1).date(" F Y",strtotime($request->tahun.'-'.$request->bulan.'-01'));
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
                  'data' => $date
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

    public function addAbsen (Request $request){
      $surat = null;
      if($request->surat_absen){
          $fileJawaban = time().'.'.$request->surat_absen->extension(); 
          $request->surat_absen->move(public_path('/surat/absen/'), $surat);
      }

    //   $cek = DB::table('absen')
    //         ->max('id');
    //   $no = (int) substr($cek, 3, 3);
    //   $no++;
    //   $huruf = "ABS";
    //   $kode = $huruf . sprintf("%03s", $no);

      $data = DB::table('absen')
              ->insert(
              array(
                  'id' => date('YmdHis'),
                  'username' => session('username'),
                  'user_mentor' => session('id_mentor'),
                  'absen' => $request->absen,
                  'tgl_pengajuan' => date('Y-m-d H:i:s'),
                  'dari_tgl' => $request->dari_tgl,
                  'sampai_tgl' => $request->sampai_tgl,
                  'surat_absen' => $surat,
                  'ket_absen' => $request->ket_absen,
                  'status' => '1'
                  )
              );

        $data = DB::table('presensi')
              ->insert(
              array(
                  'id_absen' => date('YmdHis'),
                  'username' => session('username'),
                  'tanggal' => date('Y-m-d H:i:s'),
                  'status' => 'P'
                  )
              );
              
      
      return response()->json([
          'message' => 'TRUE',
          'data' => $data
      ],200);
    }

}