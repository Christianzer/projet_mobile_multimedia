<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

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
