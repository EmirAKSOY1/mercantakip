<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\EndkonData;
use App\Models\Kumes;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index(){
        $query = EndkonData::with('kumes');
        $kumesIds = Kumes::where('entegre_id', auth()->user()->roleUser->entegre->id)->pluck('id');
        $datas = $query->whereIn('KUMES_ID', $kumesIds)
                       ->orderBy('TARIH', 'desc')
                       ->paginate(10);
        return view( "manager.data.index",compact('datas'));
    }
}
