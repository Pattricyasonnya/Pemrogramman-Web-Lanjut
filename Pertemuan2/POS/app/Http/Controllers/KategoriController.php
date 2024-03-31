<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{

    public function create(): View
    {
        return view('category.create');
    }

    public function store(Request $request) : RedirectResponse {
        /*$validate = $request->validate([
            'kategori_kode' => 'required',
            'kategori_nama' => 'required',
        ]);*/

        $validateData = $request->validate([
            'title' => ['required', 'unique:post', 'max:255'],
            'body' => ['required'],
        ]);

        $validateData = $request->validateWithBag('post', [
            'title' => ['required', 'unique:post', 'max:255'],
            'body' => ['required'],
        ]);
        return redirect('/kategori');
    }




    //PERTEMUAN 5
    public function index(KategoriDataTable $dataTable){
        return $dataTable -> render('category.index');
    }
    
    /*public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        KategoriModel::create([
            'kategori_kode' => $request->kodeKategori,
            'kategori_nama' => $request->namaKategori,
        ]);
        return redirect('/kategori');
    }

    public function edit($id){
        $kategori = KategoriModel::find($id);
        return view('category.edit', ['data' => $kategori]);
    }

    public function update(Request $request, $id){
        $kategori=KategoriModel::find($id);
        $kategori->update($request->all());

        return redirect('/kategori');
    }

    public function delete($id){
        $kategori = KategoriModel::find($id);
        $kategori->delete();

        return redirect('/kategori');
    }*/

    //PERTEMUAN 4
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
