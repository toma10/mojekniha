<?php

use App\Domain\Book\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    const LANGUAGES = [
        'angličtina',
        'čeština',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(self::LANGUAGES)->each(function ($language) {
            Language::create(['name' => $language]);
        });
    }
}
