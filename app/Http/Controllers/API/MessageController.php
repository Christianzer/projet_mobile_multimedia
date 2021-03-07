<?php

namespace App\Http\Controllers\Api;

use App\Etudiant;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Osms\Osms;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MessageController extends Controller
{
    //
    public function listMessage()
    {

        $listes = Message::with('message_etudiant')->paginate();
        return response()->json([
            'status_code' => 200,
            'listes' => $listes
        ]);
    }

    public function sendMessage(Request $request)
    {

        if ($request->element == 1) {
            $etudiant = Etudiant::find($request->matricule);
            $idtype = (int)$request->type_message;
            if ($idtype == 1) {
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
                            'message' => 459
                        ]);
                    }

                } catch (Exception $e) {
                    return response()->json([
                        'status_code' => 400,
                        'message' => 458
                    ]);
                }
            }
            else
            {
                $config = array(
                    'clientId' => 'Y6m0PnbSqTrVJBCOEH89bDhnjg1iij1D',
                    'clientSecret' => '00XehbQoDlhR8aS5'
                );

                $sms = new Osms($config);

                // retrieve an access token
                $response = $sms->getTokenFromConsumerKey();

                if (!empty($response['access_token'])) {
                    $senderAddress = 'tel:+225';
                    $receiverAddress = 'tel:+225'.$etudiant['contact'];
                    $message = $request->message;
                    $senderName = 'Dev Topark';
                    $test = $sms->sendSMS($senderAddress, $receiverAddress, $message, $senderName);
                    if (empty($test['error'])) {
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
                            ]);
                        }
                    } else {
                        return response()->json([
                            'status_code' => 400,
                            'message' => 456
                        ]);
                    }

                } else {

                    return response()->json([
                        'status_code' => 400,
                        'message' => 457
                    ]);
                }
            }
            //Sms
        }else{
            $reset = DB::table('etudiants')
                ->where('codecl','=',$request->matricule)
                ->get();
            $idtype = (int)$request->type_message;
            if ($idtype == 1) {
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
                    foreach ($reset as $etd):
                        $mail->SetFrom($etd->email);
                        $mail->Subject = $request->objet;
                        $mail->Body = $request->message;
                        $mail->AddAddress($etd->email);
                        $mail->Send();
                        $message = new Message();
                        $message->objet = $request->objet;
                        $message->type_message = $request->type_message;
                        $message->message = $request->message;
                        $message->matricule = $etd->matricule;
                        $saved = (bool) $message->save();
                    endforeach;
                    if ($saved) {
                        return response()->json([
                            'status_code' => 200,
                            'message' => 'success'
                        ]);
                    } else {
                        return response()->json([
                            'status_code' => 400,
                            'message' => 459
                        ]);
                    }

                } catch (Exception $e) {
                    return response()->json([
                        'status_code' => 400,
                        'message' => 458
                    ]);
                }

            }
            else
            {
                $config = array(
                    'clientId' => 'Y6m0PnbSqTrVJBCOEH89bDhnjg1iij1D',
                    'clientSecret' => '00XehbQoDlhR8aS5'
                );

                $sms = new Osms($config);

                // retrieve an access token
                $response = $sms->getTokenFromConsumerKey();

                if (!empty($response['access_token'])) {
                    $senderAddress = 'tel:+225';
                    foreach ($reset as $etd):
                        $receiverAddress = 'tel:+225'.$etd->contact;
                        $message = $request->message;
                        $senderName = 'Dev Topark';
                        $test = $sms->sendSMS($senderAddress, $receiverAddress, $message, $senderName);
                    endforeach;
                    if (empty($test['error'])) {
                        $message = new Message();
                        foreach ($reset as $etd):
                            $message->objet = $request->objet;
                            $message->type_message = $request->type_message;
                            $message->message = $request->message;
                            $message->matricule = $etd->matricule;
                            $saved = (bool) $message->save();
                        endforeach;
                        if ($saved) {
                            return response()->json([
                                'status_code' => 200,
                                'message' => 'success'
                            ]);
                        } else {
                            return response()->json([
                                'status_code' => 400,
                                'message' => 'Echec'
                            ]);
                        }
                    } else {
                        return response()->json([
                            'status_code' => 400,
                            'message' => 456
                        ]);
                    }

                } else {

                    return response()->json([
                        'status_code' => 400,
                        'message' => 457
                    ]);
                }
            }


        }

    }
}
