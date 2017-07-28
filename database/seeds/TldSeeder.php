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

        $crawler = $client->request('GET', 'https://domainr.com/about/tlds');


        $crawler->filter('div.domains a')->each(function ($node) {
            $tld = $node->text();

            if(strpos($tld, '.') === 0)
            {
                $parts = explode(' ', $tld);

                if (!preg_match('/[^a-z.]/', $parts[0])) // '/[^a-z\d]/i' should also work.
                {
                    $tld = \App\Tld::firstOrCreate([
                        'extension'  => $parts[0],
                    ]);

                    $response = \Domainr::status('domaincheck.' . $tld->extension);

                    $tld->active = ! in_array($response[0]->summary, ['unknown', 'undelegated', 'pending', 'unregistrable']);

                    $tld->save();

                    // now crawl to the TLD page and grab the subdomains!
                }
            }
        });
    }

    public function runRoute53()
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
