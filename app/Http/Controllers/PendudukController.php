<?php

namespace App\Http\Controllers;

use App\Helpers\formatAPI;
use App\Models\Penduduk;
use Exception;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Penduduk::all();

      if($data){
         return formatAPI::createAPI(200, 'Success', $data);
      }
      else{
         return formatAPI::createAPI(400, 'Failed');
      }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $penduduk = Penduduk::create($request->all());

            $data = penduduk::where('nik','=',$penduduk->nik)->get();

            if($data){
                return formatAPI::createAPI(200, 'Berhasil', $data);
             }
             else{
                return formatAPI::createAPI(400, 'Failed');
             }
            }catch(Exception $error){
                return formatAPI::createAPI(400, 'Gagal',$error);

            }
        }
        public function update(Request $request, $id)
        {
            try{
                $penduduk = Penduduk::findorfail($id);
                $penduduk->update($request->all());

                $data = Penduduk::where('id','=',$penduduk->id)->get();
                if($data){
                    return formatAPI::createAPI(200, 'Success', $data);
                 }else{
                    return formatAPI::createAPI(400, 'Failed');
                 }
            }catch(Exception $error){
                return formatAPI::createAPI(400, 'Failed',$error);
            }
         }

         public function show($id)
         {
             try{
                 $data = Penduduk::where('id', '=',$id)->first();
                 if($data){
                     return formatAPI::createAPI(200, 'Success', $data);
                 }else{
                     return formatAPI::createAPI(400, 'Failed');
                 }
             }catch(Exception $error){
                 return formatAPI::createAPI(400, 'Failed',$error);
     
             }
         }

         public function destroy($id)
         {
            try{
                $Penduduk = Penduduk::findorfail($id);

                $data = $Penduduk->delete();
                if($data){
                    return formatAPI::createAPI(200, 'Success', $data);
                 }else{
                    return formatAPI::createAPI(400, 'Failed');
                 }
                }catch(Exception $error){
                    return formatAPI::createAPI(400, 'Failed',$error);
                }
        }
    }