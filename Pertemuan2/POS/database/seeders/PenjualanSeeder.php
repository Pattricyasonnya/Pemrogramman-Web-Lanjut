<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'Pattricya',
                'penjualan_kode' => 'P1',
                'penjualan_tanggal' => '2024-3-3',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 1,
                'pembeli' => 'Pattricya',
                'penjualan_kode' => 'P2',
                'penjualan_tanggal' => '2024-3-3',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 2,
                'pembeli' => 'Sonnya',
                'penjualan_kode' => 'P3',
                'penjualan_tanggal' => '2024-3-3',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 2,
                'pembeli' => 'Sonnya',
                'penjualan_kode' => 'P4',
                'penjualan_tanggal' => '2024-3-3',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 1,
                'pembeli' => 'Pattricya',
                'penjualan_kode' => 'P5',
                'penjualan_tanggal' => '2024-3-3',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 1,
                'pembeli' => 'Pattricya',
                'penjualan_kode' => 'P6',
                'penjualan_tanggal' => '2024-3-3',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Fridayanti',
                'penjualan_kode' => 'P7',
                'penjualan_tanggal' => '2024-3-3',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Fridayanti',
                'penjualan_kode' => 'P8',
                'penjualan_tanggal' => '2024-3-3',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Fridayanti',
                'penjualan_kode' => 'P9',
                'penjualan_tanggal' => '2024-3-3',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Fridayanti',
                'penjualan_kode' => 'P10',
                'penjualan_tanggal' => '2024-3-3',
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
