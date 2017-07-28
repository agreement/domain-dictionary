<?php

use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tlds = \App\Tld::get();

        foreach($tlds as $tld)
        {
            $str = str_replace('.', '', $tld->extension);

            $words = \App\Word::where('word', 'LIKE', "%{$str}")->get();

            foreach($words as $word)
            {
                if(strpos($word->word, ' ') !== false || strpos($word->word,'-') === 0) continue;

                $domain = strtolower(preg_replace('/' . $str . '$/', $tld->extension, $word->word));

                if($domain != strtolower($word->word) && $domain != $tld->extension)
                {
                    $domain = str_replace('-.', '.', $domain);

                    \App\Domain::firstOrCreate([
                        'word_id'    => $word->id,
                        'tld_id'    => $tld->id,
                        'domain'    => $domain
                    ]);

                    if(strpos($domain, '-') !== false)
                    {
                        \App\Domain::firstOrCreate([
                            'word_id'    => $word->id,
                            'tld_id'    => $tld->id,
                            'domain'    => str_replace('-', '', $domain)
                        ]);
                    }
                }
            }
        }
    }
}
