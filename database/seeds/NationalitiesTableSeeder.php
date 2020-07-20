<?php

use App\Domain\Book\Models\Nationality;
use Illuminate\Database\Seeder;

class NationalitiesTableSeeder extends Seeder
{
    const NATIONALITIES = [
        'americká',
        'anglická',
        'česká',
        'francouzská',
        'italská',
        'německá',
        'ruská',
        'španěslká',
        'švédská',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(self::NATIONALITIES)->each(function ($nationality) {
            Nationality::create(['name' => $nationality]);
        });
    }
}
