<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public $timestamps = false;

    protected $fillable = ['word'];

    public function definitions()
    {
        return $this->hasMany(Definition::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
}
