<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;
use Privateer\Domainr\Domainr;

class RegisterController extends Controller
{
    public function create(Domain $domain)
    {
        //dd($domain);

        $url = (new Domainr(config("domainr.mashape_key"), config("domainr.api_url")))->register($domain->domain);
        //$url = \Domainr::register('brie.red');

        return redirect($url);
    }
}
