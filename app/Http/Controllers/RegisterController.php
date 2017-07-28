<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;
use Privateer\Domainr\Domainr;

class RegisterController extends Controller
{
    public function create(Domain $domain)
    {
        $url = (new Domainr(config('services.domainr.mashape_key')))->register($domain->domain);

        return redirect($url);
    }
}
