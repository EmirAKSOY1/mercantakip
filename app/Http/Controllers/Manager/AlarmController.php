<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\EndkonAriza;
use App\Models\Kumes;
use Illuminate\Http\Request;

class AlarmController extends Controller
{
    public function index(){
        $kumesIds = Kumes::where('entegre_id', auth()->user()->roleUser->entegre->id)->pluck('id');
        $arizaquery = EndkonAriza::with('kumes');
        $arizadatas = $arizaquery->whereIn('kumes_id', $kumesIds)
                       ->orderBy('date', 'desc')
                       ->paginate(10);
        return view('bakıcı.ariza.index',compact('arizadatas'));
    }
}
