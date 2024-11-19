<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class ChinaProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            ['name' => 'Anhui', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Beijing', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Chongqing', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Fujian', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Gansu', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Guangdong', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Guangxi', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Guizhou', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Hainan', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Hebei', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Heilongjiang', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Henan', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Hong Kong', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Hubei', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Hunan', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Inner Mongolia', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Jiangsu', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Jiangxi', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Jilin', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Liaoning', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Macau', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Ningxia', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Qinghai', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Shaanxi', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Shandong', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Shanghai', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Shanxi', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Sichuan', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Tianjin', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Tibet', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Xinjiang', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Yunnan', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
            ['name' => 'Zhejiang', 'status' => 1, 'continent_id' => 1, 'country_id' => 1],
        ];

        foreach ($provinces as $province) {
            State::create($province);
        }
    }
}
