<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'name',
        'sex',
        'birthday',
        'image_url',
        'graduated_year'
    ];
    public $timestamps=false;
}
