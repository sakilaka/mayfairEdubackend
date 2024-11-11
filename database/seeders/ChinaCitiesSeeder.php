<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class ChinaCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Hefei', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 1], // Anhui
            ['name' => 'Beijing', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 2], // Beijing
            ['name' => 'Chongqing', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 3], // Chongqing
            ['name' => 'Fuzhou', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 4], // Fujian
            ['name' => 'Lanzhou', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 5], // Gansu
            ['name' => 'Guangzhou', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 6], // Guangdong
            ['name' => 'Nanning', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 7], // Guangxi
            ['name' => 'Guiyang', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 8], // Guizhou
            ['name' => 'Haikou', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 9], // Hainan
            ['name' => 'Shijiazhuang', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 10], // Hebei
            ['name' => 'Harbin', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 11], // Heilongjiang
            ['name' => 'Zhengzhou', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 12], // Henan
            ['name' => 'Hong Kong', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 13], // Hong Kong
            ['name' => 'Wuhan', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 14], // Hubei
            ['name' => 'Changsha', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 15], // Hunan
            ['name' => 'Hohhot', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 16], // Inner Mongolia
            ['name' => 'Nanjing', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 17], // Jiangsu
            ['name' => 'Nanchang', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 18], // Jiangxi
            ['name' => 'Changchun', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 19], // Jilin
            ['name' => 'Shenyang', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 20], // Liaoning
            ['name' => 'Macau', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 21], // Macau
            ['name' => 'Yinchuan', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 22], // Ningxia
            ['name' => 'Xining', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 23], // Qinghai
            ['name' => 'Xi\'an', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 24], // Shaanxi
            ['name' => 'Jinan', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 25], // Shandong
            ['name' => 'Shanghai', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 26], // Shanghai
            ['name' => 'Taiyuan', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 27], // Shanxi
            ['name' => 'Chengdu', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 28], // Sichuan
            ['name' => 'Tianjin', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 29], // Tianjin
            ['name' => 'Lhasa', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 30], // Tibet
            ['name' => 'Ürümqi', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 31], // Xinjiang
            ['name' => 'Kunming', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 32], // Yunnan
            ['name' => 'Hangzhou', 'status' => 1, 'continent_id' => 1, 'country_id' => 1, 'state_id' => 33], // Zhejiang
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
