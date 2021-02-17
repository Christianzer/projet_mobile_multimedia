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
            $mail->SetFrom('elimco02@gmail.com');
            $mail->Subject = 'test';
            $mail->Body = 'test';
            $mail->AddAddress('elimco02@gmail.com');
            $mail->Send();
            echo 'Message envoye';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        /*
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
        */
    }

}
