<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function index($letter = null)
    {
        // if no letter is passed through it must be the homepage
        if(empty($letter)) return view('words.index');

        // only retrieve words that have domains that start with the letter provided
        $words = Word::has('domains')
            ->with('definitions')
            ->where('word', 'LIKE', "{$letter}%")
            ->paginate();

        return view('words.index', compact('words', 'letter'));
    }
}
