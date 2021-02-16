<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['objet', 'message','matricule','type_message'];
    public $timestamps= false;



    public function etudiant_message(){
        return $this->belongsTo(Message::class,'matricule','matricule');
    }
}
