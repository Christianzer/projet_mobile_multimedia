<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

class LoginControllers extends Controller
{
    //
    public function login(Request $request){
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
                $request->session()->put('utilisateur',$resultat);
                return redirect()->route('admin.ok');
            }elseif ($result[0]->type_utilisateur==1){
                Session()->flash('success','Identifiant ou Mot de Passe errone.');

                return redirect()->route('login.admin');


            }
        }else{
            Session()->flash('success','Identifiant ou Mot de Passe errone.');
            return redirect()->route('login.admin');
        }

    }
}
