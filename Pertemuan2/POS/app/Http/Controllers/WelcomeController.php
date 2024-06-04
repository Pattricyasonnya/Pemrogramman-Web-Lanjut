<?php

namespace App\Http\Controllers;

use App\Charts\MemberCharts;
use App\Exports\MemberExport;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class WelcomeController extends Controller
{
    public function index(MemberCharts $chart){
        $breadcrumb = (object)[
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';
        return view('welcome', [
            'breadcrumb' => $breadcrumb, 
            'activeMenu' => $activeMenu,
            'chart' => $chart->build(),
            'user' => UserModel::all()
        ]);
    }

    public function list(Request $request) 
    { 
        $users = UserModel::with('level');
        // ->whereRelation('level', 'level_nama', 'Member');
        //menghilangkan data yang sudah tervalidasi atau memunculkan data yang statusnya 0 
        // ->where('status', 0);

                //filter
                if($request->level_id){
                    $users->where('level_id', $request->level_id);
                }
 
        return DataTables::of($users) 
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addColumn('aksi', function ($user) {  // menambahkan kolom aksi 
            $btn  = '<a href="'.url('/dashboard/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> '; 
            //fungsi sama seperti if else tapi diperpendek. 
            $btn .= '<a href="'.url('/dashboard/' . $user->user_id . '/validasi_member').'" class="btn btn-warning btn-sm">'.($user->status == 0?'Validasi':'Tidak Validasi').'</a> '; 
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/dashboard/'.$user->user_id).'">' 
                    . csrf_field() . method_field('DELETE') .  
                    '<button type="submit" class="btn btn-danger btn-sm" 
                    onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';      
            return $btn; 
        }) 
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true); 
    } 

    public function validasiMember($id){
        $user=UserModel::find($id);
        $user->update([
            //bool : mengubah angka 0 atau 1 menjadi true atau false. ! : kebalikan dari bool (misal boolnyaq 1 jadi ! menjadi 0)
            'status'=>!(bool)$user->status
        ]);

        return redirect()->route('dashboard');
    }


    public function show(string $id){
        $user = UserModel::with('level')-> find($id);

        $breadcrumb = (object)[
            'title' => 'Detail User',
            'list' => ['Home', 'Member', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail user'
        ];

        $activeMenu = 'dashboard'; // set menu yang aktif

        return view('dashboard.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'user' => $user,
            'activeMenu' => $activeMenu]);
    }

    public function destroy(string $id){
        $check = UserModel::find($id);
        if(!$check){
            return redirect()->route('dashboard')->with('error', 'Data user tidak ditemukan');
        }
        try{
            UserModel::destroy($id);

            return redirect()->route('dashboard')->with('success', 'Data user berhasil dihapus');
        }catch(\Illuminate\Database\QueryException $e){

        return redirect('/dashboard')->with('error', 'Data user gagal dihapus karena terdapat tabel lain yang terkait dengan data ini');
    }
}

public function exportPDF(){
    $members = UserModel::with('level')
        ->whereRelation('level', 'level_nama', 'Member')->get();

    $pdf=Pdf::loadView('memberTable', [
        'members' => $members,
        'title'=>'Data Member'
    ]);

    return response()->streamDownload(function() use($pdf){
        echo $pdf->stream();
    }, 'Data Member.pdf');
}

public function exportExcel(){
    return Excel::download(new MemberExport, 'Data Member.xlsx');
}
}
