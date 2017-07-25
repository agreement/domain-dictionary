<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    public $timestamps = false;

    protected $fillable = ['type', 'definition'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
