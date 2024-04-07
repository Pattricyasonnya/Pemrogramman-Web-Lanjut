<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Monolog\Level;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{


    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar Level',
            'list' => ['Home', 'Level']  
        ];

        $page = (object)[
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level'; //set saat menu aktif
        $level = LevelModel::all();

        return view('level.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu]);
    }

    // Ambil data level dalam bentuk json untuk datatables 
    public function list(Request $request) 
    { 
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama'); 

                //filter
                if($request->level_id){
                    $levels->where('level_nama', $request->level_nama);
                }
 
        return DataTables::of($levels) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addColumn('aksi', function ($level) {  // menambahkan kolom aksi 
            $btn  = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a> '; 
            $btn .= '<a href="'.url('/level/' . $level->level_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '; 
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/level/'.$level->level_id).'">' 
                    . csrf_field() . method_field('DELETE') .  
                    '<button type="submit" class="btn btn-danger btn-sm" 
                    onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';      
            return $btn; 
        }) 
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true); 
    } 

    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah level baru'
        ];

        $level = LevelModel::all(); //ambil data level untuk ditampilkan di form
        $activeMenu = 'level'; //set menu sedang aktif

        return view('level.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    //UNTUK MENGHANDLE ATAU MENYIMPAN DATA BARU 
    public function store(Request $request){
        $request->validate([
            //level_kode harus diisi, berupa string, minimal 3 karakter dan bernilai unik di table m_level kolom level_kode
            
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::create([
            'level_id' => $request -> level_id,
            'level_kode'=> $request -> level_kode,
            'level_nama'=> $request -> level_nama,

        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    //MENAMPILKAN DETAIL LEVEL 
    public function show(string $id){
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail level'
        ];

        $activeMenu = 'level'; // set menu yang aktif

        return view('level.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit level'
        ];

        $activeMenu = 'level';

        return view('level.edit',[
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode,'.$id.',level_id',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'level_id' => $request -> level_id,
            'level_kode' => $request-> level_kode,
            'level_nama' => $request-> level_nama
        ]);

        return redirect('/level')->with('success', 'Data berhasil diubah');
    }

    public function destroy(string $id){
        $check = LevelModel::find($id);
        if(!$check){
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }
        try{
            LevelModel::destroy($id);

            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){

        return redirect('/level')->with('error', 'Data level gagal dihapus karena terdapat tabel lain yang terkait dengan data ini');
    }
}



//------------------------------------------------------------------------------------------------------------------------------------------------
    /*public function index(){
        $data = LevelModel::all();

        return view('level.index', ['data' => $data]);
    }

    public function create(): View
    {
        return view('level.create_level');
    }

    public function store(Request $request) : RedirectResponse {
        $validate = $request->validate([
            'kodeLevel' => 'required',
            'namaLevel' => 'required',
        ]);

        $request->validate([
            'title'=> 'bail|required|unique:posts|max:255',
            'body'=> 'required',
        ]);

        /*$validateData = $request->validate([
            'title' => ['required', 'unique:posts', 'max:255'],
            'body' => ['required'],
        ]);*/

        /*$validateData = $request->validateWithBag('post', [
            'title' => ['required', 'unique:posts', 'max:255'],
            'body' => ['required'],
        ]);

        LevelModel::create([
            'level_kode' => $request->kodeLevel,
            'level_nama' => $request->namaLevel,
        ]);
        return redirect('/level');
    }
    
    /*public function create(){
        return view('level.create_level');
    }

    public function store(Request $request){
        LevelModel::create([
            'level_kode' => $request->kodeLevel,
            'level_nama' => $request->namaLevel,
        ]);
        return redirect('/level');
    }*/




    /*public function index(){
        //DB::insert('insert into m_level
        //(level_kode, level_nama, created_at) value(?, ?, ?)',
        //['CUS', 'Pelanggan', now()]);
        //return 'Insert data baru berhasil';

        //$row = DB::update('update m_level set level_nama = ?
        //where level_kode = ?', 
        //['Customer', 'CUS']);
        //return 'Update data berhasil. Jumlah data yang di update : ' .$row. ' baris';

        //$row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        //return 'Delete data berhasil. Jumlah data yang dihapus: '.$row. ' baris';

        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }*/
}
