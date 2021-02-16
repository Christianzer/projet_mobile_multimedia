<?php

namespace App\Http\Controllers\API;

use App\Etudiant;
use App\Http\Controllers\Controller;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EtudiantControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listes = Etudiant::with(['etudiant_classe','etudiant_utilisateur'])->paginate(10);
        return response()->json([
            'status_code' => 200,
            'listes' =>$listes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $matricule = (!empty($request->matricule)) ? $request->matricule : Str::random('4');
        $etudiant = new Etudiant();
        $etudiant->matricule = $matricule;
        $etudiant->nom = $request->nom;
        $etudiant->prenoms = $request->prenoms;
        $etudiant->email = $request->email;
        $etudiant->contact = $request->contact;
        $etudiant->codecl = $request->codecl;
        $saved = (bool) $etudiant->save();
        if ($saved) {
            $utilisateur = new Utilisateur();
            $utilisateur->code = Str::random();
            $utilisateur->matricule = $matricule;
            $utilisateur->mot_de_passe = $request->mot_de_passe;
            $voir = (bool)$utilisateur->save();
            if ($voir){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'success'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 400,
                    'message' => 'Echec'
                ], 400);
            }
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Echec'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $matricule)
    {

        //

        $etudiant = Etudiant::find($matricule);
        $etudiant->matricule = $request->matricule;
        $etudiant->nom = $request->nom;
        $etudiant->prenoms = $request->prenoms;
        $etudiant->email = $request->email;
        $etudiant->contact = $request->contact;
        $etudiant->codecl = $request->codecl;
        $saved = (bool)$etudiant->save();
        if ($saved) {
            $utilisateur = Utilisateur::find($matricule);
            $utilisateur->matricule = $matricule;
            $utilisateur->mot_de_passe = $request->mot_de_passe;
            $voir = (bool)$utilisateur->save();
            if ($voir){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'success'
                ], 200);
            }else{
                return response()->json([
                    'status_code' => 400,
                    'message' => 'Echec'
                ], 400);
            }
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Echec'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($matricule)
    {
        //
        $cl = Etudiant::find($matricule);
        $delete = (bool) $cl->delete();
        if ($delete) {
            return response()->json([
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'status_code' => 400
            ]);
        }
    }
}
