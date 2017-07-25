<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(DictionarySeeder::class);
         $this->call(TldSeeder::class);
         $this->call(DomainSeeder::class);
    }
}
