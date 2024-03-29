<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable){
        return $dataTable -> render('category.index');
    }
    
    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        KategoriModel::create(
        [
        'kategori_kode'=> $request->kodeKategori,
        'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/kategori');
    }

    public function edit($kode){
        $kategori=KategoriModel::find($kode);
        return view('edit', ['data' => $kategori]);
    }

    /*public function index(){
        /*$data = [
            'kategori_kode' => 'SNK',
            'kategori_nama' => 'Snack/Makanan Ringan',
            'created_at' => now()
        ];

        DB::table('m_kategori')->insert($data);
        return 'Insert data baru berhasil';*/

        /*$row = DB::table('m_kategori')->where('kategori_kode', 'SNK')
        ->update(['kategori_nama'=>'Camilan']);
        return 'Update data berhasil. Jumlah data yang diupdate : ' .$row .' baris';*/

        /*$row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        return 'Delete data berhasil. Jumlah data yang diupdate : ' .$row .' baris';

        $data = DB::select('select * from m_kategori');
        return view('kategori', ['data' => $data]);
        
    }*/

    
}
