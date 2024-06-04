<?php

namespace App\Charts;

use App\Models\LevelModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class MemberCharts
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
       // Mengambil data total stok berdasarkan tanggal
       $stokData = DB::table('t_stok')
       ->selectRaw(
        'SUM(stok_jumlah) as total_stok, 
        DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal')
       ->groupBy('tanggal')
       ->get();

   // Mengambil data total transaksi berdasarkan tanggal
   $penjualanData = DB::table('t_penjualan')
       ->selectRaw(
        'COUNT(penjualan_id) as total_transaksi, 
        DATE_FORMAT(created_at, "%Y-%m-%d") as tanggal')
       ->groupBy('tanggal')
       ->get();

   // Menggabungkan data stok dan transaksi berdasarkan tanggal
   $gabungData = $stokData->merge($penjualanData)->groupBy('tanggal');

   // Menginisialisasi array untuk menyimpan data yang akan digunakan dalam grafik
   $data = [];
   $date = [];

   // Memproses data yang digunakan dalam grafik
   foreach ($gabungData as $tanggal => $items) {
       $totalStok = 0;
       $totalTransaksi = 0;

       // Menghitung total stok dan total transaksi pada tanggal tertentu
       foreach ($items as $item) {
           if (isset($item->total_stok)) {
               $totalStok += $item->total_stok;
           }
           if (isset($item->total_transaksi)) {
               $totalTransaksi += $item->total_transaksi;
           }
       }

       // Menambahkan data ke array
       $dataStok[] = $totalStok;
       $dataTransaksi[] = $totalTransaksi;
       $date[] = $tanggal;
   }

   return $this->chart->barChart()
       ->setTitle('Grafik Stok dan Penjualan')
       ->setSubtitle('Total Stok dan Total Transaksi Penjualan')
       ->addData('Total Stok', $dataStok)
       ->setXAxis($date);
}
}





// class MemberCharts
// {
//     protected $chart;

//     public function __construct(LarapexChart $chart)
//     {
//         $this->chart = $chart;
//     }

//     public function build(): \ArielMejiaDev\LarapexCharts\BarChart
//     {
//         //mengambil level member untuk grafik
//         $levelMember = LevelModel::where('level_nama', 'Member')->first();
//         $start = Carbon::now()->startOfMonth()->format('Y-m-d');

//         //memilih data untuk grafik, menghitung jumlah user_id yang baru register sebagai member
//         $dataRaw = DB::select(
//         "SELECT count(user_id) as count, DATE_FORMAT(u.created_at, '%W %d %M') as day 
//         from m_user as u 
//         where u.level_id =".$levelMember->level_id." and  u.created_at >=".$start."
//         GROUP by day"
//         );

//         //parse array to collection
//         $dataRaw = collect($dataRaw);
//         //to hold processed data
//         $processedData = collect();

//         // dd(Carbon::now()->subDays(2)->format('l d F'), $dataRaw, (Int) Carbon::now()->format('d'));

//         for ($i=0; $i < ((Int) Carbon::now()->format('d')); $i++) { 
//             $comparisonDate =  Carbon::now()->subDays($i)->format('l d F');

//             $existDate = $dataRaw->where('day', $comparisonDate);

//             // if($i == 1) dd($existDate, $dataRaw, $comparisonDate, $comparisonDate == $dataRaw[$i]->day? true: false);

//             if($existDate->isEmpty()){
//                 $processedData->prepend([
//                     'count' => 0,
//                     'day' => $comparisonDate
//                 ]);
//             }else{
//                 $processedData->prepend([
//                     'count' => $existDate->first()->count,
//                     'day' => $existDate->first()->day
//                 ]);
//             }
//         }

//         //Number of registrants
//         $data =$processedData->pluck('count')->toArray();

//         //Date
//         $date = $processedData->pluck('day')->toArray();
        
       


//         return $this->chart->barChart()
//             ->setTitle('Grafik Member.')
//             ->setSubtitle('Data Member.')
//             ->addData('Jumlah Register', $data)
//             ->setXAxis($date);
//     }
// }
