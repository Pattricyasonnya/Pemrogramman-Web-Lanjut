<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\LevelModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function penjualan(){
        return view('penjualan');
    }

    public function index(){
        $breadcrumb = (object)[
            'title'=>'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']  
        ];

        $page = (object)[
            'title' => 'Daftar penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan'; //set saat menu aktif
        $penjualan = PenjualanModel::all();

        return view('penjualan.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables 
    public function list(Request $request) 
    { 
        $penjualan = PenjualanModel::with('user'); 

                //filter
                if($request->penjualan_id){
                    $penjualan->where('penjualan_id', $request->penjualan_id);
                }
 
        return DataTables::of($penjualan) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addColumn('aksi', function ($penjualan) {  // menambahkan kolom aksi 
            $btn  = '<a href="'.url('/penjualan/' . $penjualan->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> '; 
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/penjualan/'.$penjualan->penjualan_id).'">' 
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
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah penjualan baru'
        ];

        $barang = StokModel::where('stok_jumlah', '>', 0)->with('barang')->get(); 
        $user = UserModel::all();//ambil data level untuk ditampilkan di form
        $activeMenu = 'penjualan'; //set menu sedang aktif

        return view('penjualan.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'user' => $user,
            'activeMenu' => $activeMenu
        ]);
    }

    //UNTUK MENGHANDLE ATAU MENYIMPAN DATA BARU 
    public function store(Request $request){
        //memvalidasi 
        $request->validate([
            //username harus diisi, berupa string, minimal 3 karakter dan bernilai unik di table m_user kolom username
            'barang_id' => 'required|array',
            'user_id' => 'required|integer',
            'pembeli' => 'required|string',
            'penjualan_kode' => 'required|min:3',
            'penjualan_tanggal' => 'required|date'
        ]);

        $barang = BarangModel::all();
        DB::beginTransaction(); //tanda bahwa transaksi dimulai

        //create penjualan
        $penjualan = PenjualanModel::create($request->all());

        //ambil data dari request yang ada di barang_id
        $barangLaku = $request->only('barang_id');

        //create detail barang transaksi
        foreach ($barangLaku['barang_id'] as $key => $item) {

            PenjualanDetailModel::create([
                'penjualan_id' => $penjualan->penjualan_id,
                'barang_id' => $item[0],
                'harga' => $barang->find($item[0])->harga_jual,
                'jumlah' => 1,
            ]);

            $stok = stokModel::where('barang_id', $item[0])->with('barang')->first();
            $stok->decrement('stok_jumlah', 1);

            if($stok->stok_jumlah < 0 ){
            return back()->with('error', 'Stok '.$stok->barang_nama.' Tidak Mencukupi');
            }
        }
        DB::commit();

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    //MENAMPILKAN DETAIL USER 
    public function show(string $id){
        $penjualan = PenjualanModel::with('user')-> find($id);
        $barangJual = PenjualanDetailModel::where('penjualan_id', $id)->with('barang')->get();

        $breadcrumb = (object)[
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail penjualan'
        ];

        $activeMenu = 'penjualan'; // set menu yang aktif

        return view('penjualan.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'barangJual'=> $barangJual,
            'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $penjualan = PenjualanModel::find($id);
        $user = UserModel::all();
        $detail = PenjualanDetailModel::where('penjualan_id', $id)->first();
        $barang = StokModel::where('stok_jumlah', '>', 0)->with('barang')->get();

        $breadcrumb = (object)[
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit',[
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'user' => $user,
            'detail'=> $detail,
            'barang' => $barang,
            'activeMenu' => $activeMenu
        ]);
    }


    public function update(Request $request, string $id){
        $request->validate([
            'barang_id' => 'nullable|array',
            'user_id' => 'required|min:3',
            'pembeli' => 'nullable|string',
            'penjualan_kode' => 'required|min:3',
            'penjualan_tanggal' => 'required|date'
        ]);
        DB::beginTransaction();

        $penjualan = PenjualanModel::find($id);
        $penjualan->update($request->all());
        $barang = BarangModel::all();

        $barangLaku = $request->only('barang_id');

        if(count($barangLaku) > 0){
            PenjualanDetailModel::where('penjualan_id', $id)->delete();
            foreach($barangLaku as $key => $item){
                PenjualanDetailModel::create([
                    'penjualna_id' => $penjualan->penjualan_id,
                    'barang_id' => $item[0],
                    'harga'=> $barang->find($item[0])->harga_jual,
                    'jumlah'=> 1,
                ]);

                $stok = StokModel::where('barang_id', $item[0])->with('barang')->first();
                $stok->decreement('stok_jumlah', 1);

                if($stok->stok_jumlah < 0){
                    return back()->with('error', 'Stok' .$stok->barang_nama. ' Tidak Mencukupi');
                }
            }
        }
        DB::commit();

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function destroy(string $id){
        //cari id penjualan 
        $check = PenjualanModel::find($id);
        // cek, jika tidak ada maka kembali
        if(!$check){
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            $penjualanDetail = PenjualanDetailModel::where('penjualan_id',$id)->get();

            //dihapus data penjualan detail persatu
            foreach ($penjualanDetail as $key => $item) {
                $item->delete();
            }

            //menghapus data penjualan
            PenjualanModel::destroy($id);

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Throwable $th) {
            // dd($th);
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }    }
}

