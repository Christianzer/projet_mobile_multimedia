<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    //
    public $table = 'utilisateurs';
    public $primaryKey = 'matricule';
    public $timestamps= false;
    public $casts =["matricule"=>"string"];
    public $incrementing = false;
    public $keyType = 'string';
    public $guarded = 'matricule';

    public function utilisateur_etudiant(){
        return $this->hasMany(Etudiant::class,'matricule','matricule');
    }
}
