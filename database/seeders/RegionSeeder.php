<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            ['name' => 'Aceh', 'code' => 'AC'],
            ['name' => 'Sumatra Utara', 'code' => 'SU'],
            ['name' => 'Sumatra Barat', 'code' => 'SB'],
            ['name' => 'Riau', 'code' => 'RI'],
            ['name' => 'Kepulauan Riau', 'code' => 'KR'],
            ['name' => 'Jambi', 'code' => 'JA'],
            ['name' => 'Bengkulu', 'code' => 'BE'],
            ['name' => 'Sumatra Selatan', 'code' => 'SS'],
            ['name' => 'Kepulauan Bangka Belitung', 'code' => 'BB'],
            ['name' => 'Lampung', 'code' => 'LA'],
            ['name' => 'Banten', 'code' => 'BT'],
            ['name' => 'DKI Jakarta', 'code' => 'JK'],
            ['name' => 'Jawa Barat', 'code' => 'JB'],
            ['name' => 'Jawa Tengah', 'code' => 'JT'],
            ['name' => 'DI Yogyakarta', 'code' => 'YO'],
            ['name' => 'Jawa Timur', 'code' => 'JI'],
            ['name' => 'Bali', 'code' => 'BA'],
            ['name' => 'Nusa Tenggara Barat', 'code' => 'NB'],
            ['name' => 'Nusa Tenggara Timur', 'code' => 'NT'],
            ['name' => 'Kalimantan Barat', 'code' => 'KB'],
            ['name' => 'Kalimantan Tengah', 'code' => 'KT'],
            ['name' => 'Kalimantan Selatan', 'code' => 'KS'],
            ['name' => 'Kalimantan Timur', 'code' => 'KI'],
            ['name' => 'Kalimantan Utara', 'code' => 'KU'],
            ['name' => 'Sulawesi Utara', 'code' => 'SA'],
            ['name' => 'Gorontalo', 'code' => 'GO'],
            ['name' => 'Sulawesi Tengah', 'code' => 'ST'],
            ['name' => 'Sulawesi Barat', 'code' => 'SR'],
            ['name' => 'Sulawesi Selatan', 'code' => 'SN'],
            ['name' => 'Sulawesi Tenggara', 'code' => 'SG'],
            ['name' => 'Maluku', 'code' => 'MA'],
            ['name' => 'Maluku Utara', 'code' => 'MU'],
            ['name' => 'Papua', 'code' => 'PA'],
            ['name' => 'Papua Barat', 'code' => 'PB'],
        ];

        foreach ($regions as $region) {
            DB::table('regions')->insert([
                'name' => $region['name'],
                'code' => $region['code'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
