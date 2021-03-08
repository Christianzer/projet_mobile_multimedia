<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompteControllers extends Controller
{
    //
    public function nbreCalculer(){
        $nbreet = DB::table('etudiants')->count('matricule');
        $nbreclasse = DB::table('classes')->count('code');
        $nbremessageenvoye = DB::table('messages')->where('matricule','<>','SPUFR')->count('id');
        $nbremesrecusp = DB::table('messages')->where('matricule','=','SPUFR')->count('id');
        return response()->json([
            'status_code' => 200,
            'nbreet' =>$nbreet,
            'nbreclass'=>$nbreclasse,
            'messagsend'=>$nbremessageenvoye,
            'messrecu'=>$nbremesrecusp
        ]);

    }



    public function messageet($matricule){
        $nbremesrecusp = DB::table('messages')->where('matricule','=',$matricule)->count('id');
    }
}
