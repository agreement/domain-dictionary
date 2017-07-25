<?php

use Goutte\Client;
use Illuminate\Database\Seeder;

class DictionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();

        $crawler = $client->request('GET', 'http://www.mso.anu.edu.au/~ralph/OPTED/');

        $crawler->filter('a')->each(function ($node) use ($client) {

            $href = $node->attr('href');

            if(strpos($href, '.html') !== false)
            {
                $letter_crawler = $client->request('GET', 'http://www.mso.anu.edu.au/~ralph/OPTED/' . $href);

                $letter_crawler->filter('p')->each(function ($node) {

                    $word = $node->filter('b')->text();

                    $type  = $node->filter('i')->text();

                    $definition = str_replace("{$word} ({$type}) ", '', $node->text());

                    $word = \App\Word::firstOrCreate(['word' => $word]);

                    $word->definitions()->save(new \App\Definition([
                        'type'  => $type,
                        'definition' => $definition
                    ]));
                });
            }
        });
    }
}
