<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    public $timestamps = false;

    protected $fillable = ['domain'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function tld()
    {
        return $this->belongsTo(Tld::class);
    }
}
