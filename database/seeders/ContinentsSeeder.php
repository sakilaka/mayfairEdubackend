<?php

namespace Database\Seeders;

use App\Models\Continent;
use Illuminate\Database\Seeder;

class ContinentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $continents = [
            ['name' => 'Asia', 'status' => 1]
        ];

        foreach ($continents as $continent) {
            Continent::create($continent);
        }
    }
}
