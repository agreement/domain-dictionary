<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Word;
use Illuminate\Http\Request;

class WordsController extends Controller
{
    public function index($letter = null)
    {
        // if no letter is passed through it must be the homepage
        if(empty($letter))
        {
            // find a random domain that is available
            $domain = Domain::with('word')
                        ->where('available', '=', 1)
                        ->inRandomOrder()
                        ->first();

            return view('words.index', compact('domain'));
        }

        // only retrieve words that have domains that start with the letter provided
        $words = Word::has('domains')
            ->with('definitions')
            ->where('word', 'LIKE', "{$letter}%")
            ->paginate();

        return view('words.index', compact('words', 'letter'));
    }
}
