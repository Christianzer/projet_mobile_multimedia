<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginControllers extends Controller
{
    //
    public function connexion(Request $request){
        $identifiant=$request->post('email');
        $mdp=$request->post('pass');
        $test = DB::table('utilisateurs')
            ->where('matricule','=',$identifiant)
            ->where('mot_de_passe','=',$mdp)->get();
        $resultJson = $test->toJson(JSON_PRETTY_PRINT);
        return response($resultJson, 200);
    }
}
