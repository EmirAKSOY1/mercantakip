<?php

namespace App\Http\Controllers;

use App\Models\DailyData;
use App\Models\EndkonData;
use App\Models\Entegre;
use App\Models\Kumes;
use App\Models\SupportRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EndkonAriza;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index(){

        $today = Carbon::today();
        $arizalar = EndkonAriza::with('kumes.entegre')
        ->whereDate('date', $today)
        ->get();

        $toplamHayvanSayisi = DailyData::select('kumes_id', 'hs')
        ->whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('daily_data')
                ->whereDate('created_at', '<=', now())
                ->groupBy('kumes_id');
        })
        ->sum('hs');

        $data=[
            'data_count' => EndkonData::count(),
            'alarm_count' => EndkonAriza::count(),
            'user_count' => User::count(),
            'entegre_count' => Entegre::count(),
            'kumes_count' => Kumes::count(),
            'request_count' => SupportRequest::count(),
            'open_request_count' => SupportRequest::where('status','!=', 'resolved')->count(),
            'resolved_count' => SupportRequest::where('status','=', 'resolved')->count(),
            'open_count' => SupportRequest::where('status','=', 'open')->count(),
            'in_progress_count' => SupportRequest::where('status','=', 'in_progress')->count(),
            'animal_count' => $toplamHayvanSayisi,
        ];

        //Alarm grafiği
        $alarmsLast7Days = EndkonAriza::selectRaw('DATE(date) as alarm_date, COUNT(*) as alarm_count')
        ->where('date', '>=', now()->subDays(7))
        ->groupBy('alarm_date')
        ->orderBy('alarm_date', 'ASC')
        ->get();

        $last7Days = collect(range(0, 6))->map(function ($day) {
            return now()->subDays($day)->format('Y-m-d');
        })->reverse();

        $alarmChartData = $last7Days->mapWithKeys(function ($date) use ($alarmsLast7Days) {
            $alarm = $alarmsLast7Days->firstWhere('alarm_date', $date);
            return [$date => $alarm ? $alarm->alarm_count : 0];
        });

        /*Hayvan sayısı Grafiği*/
        $dailyTotals = DailyData::selectRaw('DATE(created_at) as date, SUM(hs) as total_animals')
        ->where('created_at', '>=', Carbon::now()->subDays(7)) // Son 7 günü al
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date', 'asc')
        ->get();

        // Veriyi chart için uygun formata getir
        $chartData = [
            'labels' => $dailyTotals->pluck('date'), // Günlük tarihler
            'data' => $dailyTotals->pluck('total_animals'), // Günlük toplam hayvan sayıları
        ];

        $latestData = EndkonData::latest('created_at')->take(6)->get(); 
        return view('admin.dashboard',compact('arizalar','data','latestData','alarmChartData','chartData'));
    }
}
