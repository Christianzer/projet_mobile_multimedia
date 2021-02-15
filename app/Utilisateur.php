<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    //
    protected $table = 'utilisateurs';
    protected $primaryKey = 'code';
    protected $fillable = ['code','matricule','mot_de_passe','type_utilisateur'];
    public $timestamps= false;
    protected $casts =["code"=>"string"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = 'code';

    public function utilisateur_etudiant(){
        return $this->hasMany(Etudiant::class,'matricule','matricule');
    }
}
