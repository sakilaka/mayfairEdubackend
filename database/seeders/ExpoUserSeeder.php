<?php

namespace Database\Seeders;

use App\Models\ExpoModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpoUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 96; $i++) {
            ExpoModule::create([
                'ticket_no' => rand(10000, 99999),
                'id_type' => 'Passport',
                'id_no' => '12345679',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '01817240585',
                'id_type' => 'Passport',
                'id_type' => 'Passport',
                'email' => 'jsjahidmini@gmail.com'
            ]);
        }
    }
}
