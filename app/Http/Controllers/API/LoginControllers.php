<?php

namespace App\Http\Controllers\API;

use App\Classes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginControllers extends Controller
{
    //
    public function connexion(Request $request){
        $identifiant = $request->input('email');
        $mdp = $request->input('pass');

        $res = DB::table("utilisateurs")
            ->where('matricule','=',$identifiant)
            ->where('mot_de_passe','=',$mdp)
            ->count('code');
        if ($res == 1) {
            $result = DB::table("utilisateurs")
                ->where('matricule','=',$identifiant)
                ->where('mot_de_passe','=',$mdp)
                ->select('*')->get();
            if ($result[0]->type_utilisateur==2) {
                $resultat = DB::table("sps")
                    ->join('utilisateurs','utilisateurs.matricule','=','sps.matricule')
                    ->where('sps.matricule','=',$identifiant)
                    ->select('*')->get();
                $resultJson = $resultat->toJson(JSON_PRETTY_PRINT);
                return response($resultJson, 200);
            }elseif ($result[0]->type_utilisateur==1){
                $resultat = DB::table("etudiants")
                    ->join('utilisateurs','utilisateurs.matricule','=','etudiants.matricule')
                    ->where('etudiants.matricule','=',$identifiant)
                    ->select('*')->get();
                $resultJson = $resultat->toJson(JSON_PRETTY_PRINT);
                return response($resultJson, 200);
            }
        }else{
            return response(null,400);
        }
    }

    public function getClasse(){
        $listes_classes = Classes::all();
        return response()->json($listes_classes->toJson(JSON_PRETTY_PRINT),200);
    }
}
