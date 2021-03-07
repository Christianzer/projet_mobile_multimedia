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
        $nbreclasse = DB::table('classe')->count('code');
    }

    public function messagesp(){
        $nbremessageenvoye = DB::table('messages')->where('matricule','<>','SPUFR')->count('id');
        $nbremesrecusp = DB::table('messages')->where('matricule','=','SPUFR')->count('id');
    }

    public function messageet($matricule){
        $nbremesrecusp = DB::table('messages')->where('matricule','=',$matricule)->count('id');
    }
}
