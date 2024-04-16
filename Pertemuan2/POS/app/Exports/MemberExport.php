<?php

namespace App\Exports;

use App\Models\UserModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MemberExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        $members=UserModel::with('level')->whereRelation('level', 'level_nama', 'Member')->get();
        return view('memberTable', ['members'=>$members]);
    }
}
