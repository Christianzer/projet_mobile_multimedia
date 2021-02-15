<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sp extends Model
{
    //
    protected $table = 'sps';
    protected $primaryKey = 'matricule';
    protected $fillable = ['matricule','nom','prenoms','contact','email'];
    public $timestamps= false;
    protected $casts =["matricule"=>"string"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = 'matricule';
}
