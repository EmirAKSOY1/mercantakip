<?php

namespace App\Http\Controllers;

use App\Models\DailyData;
use App\Models\EndkonAriza;
use App\Models\EndkonData;
use App\Models\Entegre;
use App\Models\Kumes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CaretakerController extends Controller
{
    public function index()
    {
        $kumesIds = Kumes::where('entegre_id', auth()->user()->roleUser->entegre->id)->pluck('id');

        $entegreId = auth()->user()->roleUser->entegre->id;
        //dd($entegreId);
        $datas = Kumes::where('entegre_id', $entegreId)
        ->with(['endkonData' => function ($query) {
            $query->latest('TARIH')->take(1); // Her kümesin son kaydı
        }])
        ->paginate(2);

        $arizaquery = EndkonAriza::with('kumes');
        $arizadatas = $arizaquery->whereIn('kumes_id', $kumesIds)
                       ->orderBy('date', 'desc')
                       ->take(10)
                       ->get();
    $entegre = Entegre::with('coops')->find(auth()->user()->roleUser->entegre->id);
    if (!$entegre) {
        return response()->json(['message' => 'Kümes Bulunamadı'], 404);
    }
   
    

                   
        return view('bakıcı.dashboard', compact('datas','arizadatas','entegre'));
    }
}
