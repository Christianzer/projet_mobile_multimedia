<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'code';
    protected $fillable = ['code','libelle'];
    public $timestamps= false;
    protected $casts =["code"=>"string"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = 'code';
}
