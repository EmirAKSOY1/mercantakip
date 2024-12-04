<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\DailyData;
use App\Models\EndkonAriza;
use App\Models\EndkonData;
use App\Models\Kumes;
use App\Models\UserRole;
use App\Models\SupportRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManagerController extends Controller
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
        



    // Son 7 gün içerisindeki alarm verilerini al
    $alarmsLast7Days = EndkonAriza::whereIn('kumes_id', $kumesIds)
        ->where('date', '>=', now()->subDays(7))
        ->selectRaw('DATE(date) as alarm_date, COUNT(*) as alarm_count')
        ->groupBy('alarm_date')
        ->orderBy('alarm_date', 'ASC')
        ->get();

    // Son 7 günü oluştur
    $last7Days = collect(range(0, 6))->map(function ($day) {
        return now()->subDays($day)->format('Y-m-d');
    })->reverse();

    // Son 7 güne göre verileri tamamla
    $alarmChartData = $last7Days->mapWithKeys(function ($date) use ($alarmsLast7Days) {
        $alarm = $alarmsLast7Days->firstWhere('alarm_date', $date);
        return [$date => $alarm ? $alarm->alarm_count : 0];
    });

        // İlgili kümeler için en son kaydı bul
        $lastRecords = DailyData::whereIn('kumes_id', $kumesIds)
        ->select('kumes_id', 'hs')
        ->whereIn('id', function ($query) use ($kumesIds) {
            $query->from('daily_data')
                ->selectRaw('MAX(id)')
                ->whereIn('kumes_id', $kumesIds)
                ->groupBy('kumes_id');
        })
        ->get();

        $total_death = DailyData::whereIn('kumes_id', $kumesIds)
        ->select('kumes_id', 'os')
        ->whereIn('id', function ($query) use ($kumesIds) {
            $query->from('daily_data')
                ->selectRaw('MAX(id)')
                ->whereIn('kumes_id', $kumesIds)
                ->groupBy('kumes_id');
        })
        ->get();

    $detail = [
        'data_count' => EndkonData::whereIn('kumes_id', $kumesIds)->count(),
        'animal_count' => $lastRecords->sum('hs'),
        'total_alarms' => EndkonAriza::whereIn('kumes_id', $kumesIds)->count(),
        'total_employess' => UserRole::where('entegre_id',$entegreId)->count(),
        'total_coop' => Kumes::where('entegre_id',$entegreId)->count(),
        'total_death' => $total_death->sum('os'),
        'total_request' => SupportRequest::where('requester_id', Auth::id()),
        'today_alarm' =>  EndkonAriza::whereIn('kumes_id', $kumesIds)->whereDate('date', now()->toDateString()) ->count()
        
    ];
    
                       
        return view('manager.dashboard', compact('datas','alarmChartData','detail'));
    }
}
