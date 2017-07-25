<?php

use Goutte\Client;
use Illuminate\Database\Seeder;

class TldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();

        $crawler = $client->request('GET', 'http://docs.aws.amazon.com/Route53/latest/DeveloperGuide/registrar-tld-list.html');


        $crawler->filter('dt > b > span.term')->each(function ($node) {
            $tld = $node->text();

            if(strpos($tld, '.') === 0)
            {
                $parts = explode(' ', $tld);

                $tld = \App\Tld::firstOrCreate([
                    'extension'  => $parts[0],
                ]);
            }
        });
    }
}
