<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['objet', 'message','matricule','type_message'];
    public $timestamps= false;



    public function message_etudiant(){
        return $this->belongsTo(Etudiant::class,'matricule','matricule');
    }
}
