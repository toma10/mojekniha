<?php

use App\Domain\User\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->states('admin')->create(['email' => 'tomas.macala@seznam.cz']);

        $this->call(NationalitiesTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(BooksTableSeeder::class);
    }
}
