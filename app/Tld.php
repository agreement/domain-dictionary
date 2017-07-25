<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tld extends Model
{
    public $timestamps = false;

    protected $fillable = ['extension'];
}
