<?php

namespace App\Http\Controllers\Api;

use App\Etudiant;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MessageController extends Controller
{
    //
    public function listMessage(){

        $listes = Message::with('message_etudiant')->paginate();
        return response()->json([
            'status_code' => 200,
            'listes' =>$listes
        ]);
    }

    public function sendMessage(Request $request){
        //Mail
        $etudiant = Etudiant::find($request->matricule);
        try {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '465';
            $mail->isHTML();
            $mail->Username = 'devchristianaka@gmail.com';
            $mail->Password = 'DevAka20*';
            $mail->SetFrom($etudiant['email']);
            $mail->Subject = $request->objet;
            $mail->Body = $request->message;
            $mail->AddAddress($etudiant['email']);
            $mail->Send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        //Sms


        $message = new Message();
        $message->objet = $request->objet;
        $message->type_message = $request->type_message;
        $message->message = $request->message;
        $message->matricule = $request->matricule;
        $saved = (bool) $message->save();
        if ($saved) {
            return response()->json([
                'status_code' => 200,
                'message' => 'success'
            ]);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Echec'
            ], 400);
        }



    }

}
