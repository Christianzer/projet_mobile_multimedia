<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    //
    protected $table = 'etudiants';
    protected $primaryKey = 'matricule';
    protected $fillable = ['matricule','nom','prenoms','contact','email','codecl'];
    public $timestamps= false;
    protected $casts =["matricule"=>"string"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = 'matricule';

    public function etudiant_classe(){
        return $this->belongsTo(Classes::class,'codecl','code');
    }

    public function etudiant_utilisateur(){
        return $this->belongsTo(Utilisateur::class,'matricule','matricule');
    }


    public function etudiant_message(){
        return $this->hasMany(Message::class,'matricule','matricule');
    }
}
