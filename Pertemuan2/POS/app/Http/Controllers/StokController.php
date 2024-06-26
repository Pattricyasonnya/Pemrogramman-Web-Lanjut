<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\StokModel;
use App\Models\stokModel as ModelsStokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    public function index() {

        $breadcrumb = (object) [
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok yang terdaftar dalam sistem'
        ];

        $activeMenu = 'stok';
        $barang = BarangModel::all();

        return view('stok.index', 
        ['breadcrumb' => $breadcrumb,
        'page' => $page,
        'barang'=>$barang,
        'activeMenu' => $activeMenu,
        'user' => UserModel::all()
    ]);

   
    }

    public function list(Request $request)
    {

        //filter
        if($request->barang_id){
            $stok = StokModel::with('barang.kategori')->where('barang_id', $request->barang_id)->get();
        }else{
            $stok = StokModel::with('barang.kategori')->get();
        }

        return DataTables::of($stok)
        ->addIndexColumn()
        ->addColumn('aksi', function ($stok) {
            $btn = '<a href="'.url('/stok/' . $stok->stok_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/stok/' . $stok->stok_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/stok/'.$stok->stok_id).'">'
            . csrf_field() . method_field('DELETE') . 
            '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>
            </form>'; 

            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }


    //menampilkan halaman form tambah stok
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok baru'
        ];

        $user = UserModel::all();
        $barang = BarangModel::all();
        $activeMenu = 'stok';

        return view('stok.create', 
        [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'userTambah' => $user, 
            'barang' => $barang, 
            'activeMenu' => $activeMenu,
            'user' => UserModel::all()
        ]);
    }
    //menampilkan halaman form edit stok
    public function edit(string $id)
    {
        $stok = StokModel::with('user')->with('barang')->find($id);
        $barang = BarangModel::all();
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Stok'
        ];

        $activeMenu = 'stok';

        return view('stok.edit', 
        [
            'breadcrumb'=> $breadcrumb, 
            'page' => $page, 
            'barang'=> $barang, 
            'stok' => $stok,
            'userEdit' => $user, 
            'activeMenu' => $activeMenu,
            'user' => UserModel::all()
        ]);
    }
    //menampilkan detail stok
    public function show(string $id)
    {
        $stok = StokModel::with('user')->with('barang')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail stok'
        ];

        $activeMenu = 'stok';
        
        return view('stok.show', 
        [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'stok' => $stok, 
            'activeMenu' => $activeMenu,
            'user' => UserModel::all()
        ]);
    }
    //menyimpan data stok baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'barang_id' => 'required|string|max:100',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer'
           
        ]);

        StokModel::create([
            'user_id' => $request->user_id,
            'barang_id' => $request->barang_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }
    //menyimpan perubahan data stok
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required',
            'barang_id' => 'required|string|max:100',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer'
        ]);

        StokModel::find($id)->update([
            'user_id' => $request->user_id,
            'barang_id' => $request->barang_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }
    //menghapus data stok
    public function destroy(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try{
            StokModel::destroy($id);

            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e){
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}