<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'FB',
                'kategori_nama' => 'Food and Beverage',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'BH',
                'kategori_nama' => 'Beauty Health',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'HC',
                'kategori_nama' => 'Home Care',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'BK',
                'kategori_nama' => 'Baby Kid',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'FS',
                'kategori_nama' => 'Fashion',
            ],
            [
                'kategori_id' => 6,
                'kategori_kode' => 'CML',
                'kategori_nama' => 'Camilan'
        ],
        [
                'kategori_id' => 7,
                'kategori_kode' => 'MNR',
                'kategori_nama' => 'Minuman Ringan'
        ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
