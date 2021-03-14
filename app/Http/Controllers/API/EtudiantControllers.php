<?php

namespace App\Http\Controllers\API;

use App\Etudiant;
use App\Http\Controllers\Controller;
use App\Message;
use App\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Osms\Osms;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

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
            $utilisateur->code = Str::random('4');
            $utilisateur->matricule = $matricule;
            $utilisateur->mot_de_passe = $request->mot_de_passe;
            $voir = (bool)$utilisateur->save();
            $bodymessage = 'Votre matricule est :'.$matricule.' Votre mot de passe est :'.$request->mot_de_passe;
            if ($voir){
                try{
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->SMTPAuth = true;
                    $mail->SMTPSecure = 'ssl';
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = '465';
                    $mail->isHTML();
                    $mail->Username = 'devchristianaka@gmail.com';
                    $mail->Password = 'DevAka20*';
                    $mail->SetFrom($request->email);
                    $mail->Subject = 'IDENTIFIANT PLATEFORME MOBILE';
                    $mail->Body = $bodymessage;
                    $mail->AddAddress($request->email);
                    $mail->Send();
                    $message = new Message();
                    $message->objet = 'IDENTIFIANT PLATEFORME MOBILE';
                    $message->type_message = 1;
                    $message->message = $bodymessage;
                    $message->matricule = $matricule;
                    $message->save();
                } catch (Exception $e) {
                    return response()->json([
                        'status_code' => 400,
                        'message' => 458
                    ]);
                }
                $config = array(
                    'token' => 'your_access_token'
                );
                $osms = new Osms($config);
                $senderAddress = 'tel:+225010101';
                $receiverAddress = 'tel:+225'.$request->contact;
                $message = $bodymessage;
                $senderName = 'Dev Topark';
                $response = $osms->sendSMS($senderAddress, $receiverAddress, $message, $senderName);

                if (empty($response['error'])) {


                    $message2 = new Message();
                    $message2->objet = 'IDENTIFIANT PLATEFORME MOBILE';
                    $message2->type_message = 2;
                    $message2->message = $bodymessage;
                    $message2->matricule = $matricule;
                    $message2->save();


                } else {
                    echo $response['error'];
                }



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
