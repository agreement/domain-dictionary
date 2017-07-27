<?php

use Goutte\Client;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('domain:check', function () {

    $domains = \App\Domain::whereNull('status')->take(env('DOMAINR_BATCH_SIZE', 50))->get();

    foreach($domains as $domain)
    {
        dispatch(new \App\Jobs\CheckDomainAvailability($domain));
    }

})->describe('Check domains');
