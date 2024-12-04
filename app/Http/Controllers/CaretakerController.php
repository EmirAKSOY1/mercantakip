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
        $query = EndkonData::with('kumes');
        $kumesIds = Kumes::where('entegre_id', auth()->user()->roleUser->entegre->id)->pluck('id');
        $datas = $query->whereIn('KUMES_ID', $kumesIds)
                       ->orderBy('TARIH', 'desc')
                       ->take(10)
                       ->get();
        
        $arizaquery = EndkonAriza::with('kumes');
        $arizadatas = $arizaquery->whereIn('kumes_id', $kumesIds)
                       ->orderBy('date', 'desc')
                       ->take(10)
                       ->get();

// Controller'da güncellemeyi şu şekilde yapabiliriz:
$deathCounts = DailyData::whereIn('kumes_id', $kumesIds)
    ->where('created_at', '>=', Carbon::now()->subDays(5))
    ->select('os', 'created_at')
    ->orderBy('created_at', 'asc') // Eskiden yeniye sıralama
    ->get()
    ->groupBy(function($data) {
        return Carbon::parse($data->created_at)->format('Y-m-d'); // Günlük grupla
    })
    ->map(function($dayRecords) {
        return $dayRecords->sum('os'); // Günlük ölüm sayılarını toplar
    });
    /**
     Buradan aşağısını yeni ekledim 
     */
    $entegre = Entegre::with('coops')->find(auth()->user()->roleUser->entegre->id);
    if (!$entegre) {
        return response()->json(['message' => 'Branch not found'], 404);
    }
   
    

                   
        return view('bakıcı.dashboard', compact('datas','arizadatas','deathCounts','entegre'));
    }
}
