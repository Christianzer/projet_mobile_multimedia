<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    //
    protected $table = 'etudiants';
    protected $primaryKey = 'matricule';
    protected $fillable = ['matricule','nom','prenoms','date_naissance','genre','nationalite','codecl'];
    public $timestamps= false;
    protected $casts =["matricule"=>"string"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = 'matricule';

    public function etudiant_classe(){
        return $this->belongsTo(Classes::class,'codecl','code');
    }
}
