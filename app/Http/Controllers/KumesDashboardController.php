<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class KumesDashboardController extends Controller
{
    public function index(Request $request , $id){
        
        return view("admin.data.kumes_dashboard",compact("id"));
    }
    public function getData(Request $request, $id)
    {

        
        $mode = $request->query('mode', 'daily'); // Varsayılan günlük veri
        $data = [];

        switch ($mode) {
            case 'hourly':
                // Son 24 saatlik veriler
                $data = DB::table('hourly_data')
                    ->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('HOUR(created_at) as hour'),
                        'st',
                        'created_at as last_created_at'
                    )
                    ->where('kumes_id', $id)
                    ->where('created_at', '>=', now()->subDay()) // Son 24 saat
                    
                    ->get();
                break;

                case 'daily':
                    // Son 7 günün günlük toplamları
                    $data = DB::table('hourly_data')
                        ->select(
                            DB::raw('DATE(created_at) as date'),
                            DB::raw('SUM(st) as st')
                        )
                        ->where('kumes_id', $id)
                        ->where('created_at', '>=', now()->subWeek()) // Son 7 gün
                        ->groupBy(DB::raw('DATE(created_at)')) // Her gün için gruplama yapıyoruz
                        ->orderBy('date', 'asc') // Tarihe göre sıralıyoruz
                        ->get();
                    break;

                    case 'weekly':
                        // Son 4 haftalık su tüketimi
                        $data = DB::table('hourly_data')
                            ->select(
                                DB::raw('YEARWEEK(created_at) as week'),
                                DB::raw('SUM(st) as st')
                            )
                            ->where('kumes_id', $id)
                            ->where('created_at', '>=', now()->subMonth())
                            ->groupBy(DB::raw('YEARWEEK(created_at)'))
                            ->get();
                        break;
                case 'monthly':
                    // Son 12 aylık su tüketimi
                    $data = DB::table('hourly_data')
                    ->select(
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('SUM(st) as st')
                    )
                    ->where('kumes_id', $id)
                    ->where('created_at', '>=', now()->subYear())
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->get();
                break;
        }

        return response()->json($data);
    }



    public function foodData(Request $request, $id)
    {

        
        $mode = $request->query('mode', 'daily'); // Varsayılan günlük veri
        $data = [];

        switch ($mode) {
            case 'hourly':
                // Son 24 saatlik veriler
                $data = DB::table('hourly_data')
                    ->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('HOUR(created_at) as hour'),
                        'yt',
                        'created_at as last_created_at'
                    )
                    ->where('kumes_id', $id)
                    ->where('created_at', '>=', now()->subDay()) // Son 24 saat
                    
                    ->get();
                break;

                case 'daily':
                    // Son 7 günün günlük toplamları
                    $data = DB::table('hourly_data')
                        ->select(
                            DB::raw('DATE(created_at) as date'),
                            DB::raw('SUM(yt) as yt')
                        )
                        ->where('kumes_id', $id)
                        ->where('created_at', '>=', now()->subWeek()) // Son 7 gün
                        ->groupBy(DB::raw('DATE(created_at)')) // Her gün için gruplama yapıyoruz
                        ->orderBy('date', 'asc') // Tarihe göre sıralıyoruz
                        ->get();
                    break;

                    case 'weekly':
                        // Son 4 haftalık su tüketimi
                        $data = DB::table('hourly_data')
                            ->select(
                                DB::raw('YEARWEEK(created_at) as week'),
                                DB::raw('SUM(yt) as yt')
                            )
                            ->where('kumes_id', $id)
                            ->where('created_at', '>=', now()->subMonth())
                            ->groupBy(DB::raw('YEARWEEK(created_at)'))
                            ->get();
                        break;
                case 'monthly':
                    // Son 12 aylık su tüketimi
                    $data = DB::table('hourly_data')
                    ->select(
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('SUM(yt) as yt')
                    )
                    ->where('kumes_id', $id)
                    ->where('created_at', '>=', now()->subYear())
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->get();
                break;
        }
        

        return response()->json($data);
    }

    public function isiData(Request $request, $id)
    {
        $mode = $request->query('mode', 'daily'); // Varsayılan günlük veri
        $data = [];

        switch ($mode) {
            case 'minutely':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                ->select(
                    DB::raw('TIME(tarih) as date'),
                    DB::raw('ISI as isi , SE as se') // Ortalama DI değeri
                )
                ->where('KUMES_ID', $id)
                ->orderBy('tarih', 'desc') // En son veriler
                ->orderBy('date', 'desc') // En son veriler
                ->limit(30) // Son 30 kayıt
                ->get();
            break;
            case 'hourly':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('DATE(tarih) as date'),
                        DB::raw('HOUR(tarih) as hour'),
                        DB::raw('AVG(ISI) as isi ,AVG(SE) as se ')
                    )
                    ->where('KUMES_ID', $id)
                    ->where('tarih', '>=', now()->subDay()) // Son 24 saat
                    ->groupBy(DB::raw('DATE(tarih)'), DB::raw('HOUR(tarih)')) // Tarih ve saat gruplaması
                    ->orderBy('date', 'asc')
                    ->orderBy('hour', 'asc')
                    ->get();
                break;
            

                case 'daily':
                    // Son 7 günün günlük toplamları
                    $data = DB::table('endkon_data')
                        ->select(
                            DB::raw('DATE(tarih) as date'),
                            DB::raw('AVG(ISI) as isi ,AVG(SE) as se')
                        )
                        ->where('kumes_id', $id)
                        ->where('tarih', '>=', now()->subWeek()) // Son 7 gün
                        ->groupBy(DB::raw('DATE(tarih)')) // Her gün için gruplama yapıyoruz
                        ->orderBy('date', 'asc') // Tarihe göre sıralıyoruz
                        ->get();
                    break;

                    case 'weekly':
                        // Son 4 haftalık su tüketimi
                        $data = DB::table('endkon_data')
                            ->select(
                                DB::raw('YEARWEEK(tarih) as week'),
                                DB::raw('AVG(ISI) as isi,AVG(SE) as se')
                            )
                            ->where('kumes_id', $id)
                            ->where('tarih', '>=', now()->subMonth())
                            ->groupBy(DB::raw('YEARWEEK(tarih)'))
                            ->get();
                        break;
                case 'monthly':
                    // Son 12 aylık su tüketimi
                    $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('MONTH(tarih) as tarih'),
                        DB::raw('AVG(ISI) as isi,AVG(SE) as se')
                    )
                    ->where('kumes_id', $id)
                    ->where('tarih', '>=', now()->subYear())
                    ->groupBy(DB::raw('MONTH(tarih)'))
                    ->get();
                break;
        }
        

        return response()->json($data);
    }

    public function ortakData(Request $request, $id)
    {
        $mode = $request->query('mode', 'daily'); // Varsayılan günlük veri
        $data = [];

        switch ($mode) {
            case 'minutely':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                ->select(
                    DB::raw('TIME(tarih) as date'),
                    DB::raw('ISI as isi ,DI as di,NE as ne ,CO as co') // Ortalama DI değeri
                )
                ->where('KUMES_ID', $id)
                ->orderBy('tarih', 'desc') // En son veriler
                ->orderBy('date', 'desc') // En son veriler
                ->limit(30) // Son 30 kayıt
                ->get();
            break;
            case 'hourly':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('DATE(tarih) as date'),
                        DB::raw('HOUR(tarih) as hour'),
                        DB::raw('AVG(ISI) as isi ,AVG(DI) as di,AVG(NE) as ne ,AVG(CO) as co')
                    )
                    ->where('KUMES_ID', $id)
                    ->where('tarih', '>=', now()->subDay()) // Son 24 saat
                    ->groupBy(DB::raw('DATE(tarih)'), DB::raw('HOUR(tarih)')) // Tarih ve saat gruplaması
                    ->orderBy('date', 'asc')
                    ->orderBy('hour', 'asc')
                    ->get();
                break;
            

                case 'daily':
                    // Son 7 günün günlük toplamları
                    $data = DB::table('endkon_data')
                        ->select(
                            DB::raw('DATE(tarih) as date'),
                            DB::raw('AVG(ISI) as isi ,AVG(DI) as di,AVG(NE) as ne ,AVG(CO) as co')
                        )
                        ->where('kumes_id', $id)
                        ->where('tarih', '>=', now()->subWeek()) // Son 7 gün
                        ->groupBy(DB::raw('DATE(tarih)')) // Her gün için gruplama yapıyoruz
                        ->orderBy('date', 'asc') // Tarihe göre sıralıyoruz
                        ->get();
                    break;

                    case 'weekly':
                        // Son 4 haftalık su tüketimi
                        $data = DB::table('endkon_data')
                            ->select(
                                DB::raw('YEARWEEK(tarih) as week'),
                                DB::raw('AVG(ISI) as isi ,AVG(DI) as di,AVG(NE) as ne ,AVG(CO) as co')
                            )
                            ->where('kumes_id', $id)
                            ->where('tarih', '>=', now()->subMonth())
                            ->groupBy(DB::raw('YEARWEEK(tarih)'))
                            ->get();
                        break;
                case 'monthly':
                    // Son 12 aylık su tüketimi
                    $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('MONTH(tarih) as tarih'),
                        DB::raw('AVG(ISI) as isi ,AVG(DI) as di,AVG(NE) as ne ,AVG(CO) as co')
                    )
                    ->where('kumes_id', $id)
                    ->where('tarih', '>=', now()->subYear())
                    ->groupBy(DB::raw('MONTH(tarih)'))
                    ->get();
                break;
        }
        

        return response()->json($data);
    }

    public function diData(Request $request, $id)
    {
        $mode = $request->query('mode', 'daily'); // Varsayılan günlük veri
        $data = [];

        switch ($mode) {
            case 'minutely':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                ->select(
                    DB::raw('TIME(tarih) as date'),
                    DB::raw('DI as di') // Ortalama DI değeri
                )
                ->where('KUMES_ID', $id)
                ->orderBy('tarih', 'desc') // En son veriler
                ->orderBy('date', 'desc') // En son veriler
                ->limit(30) // Son 30 kayıt
                ->get();
            break;
            case 'hourly':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('DATE(tarih) as date'),
                        DB::raw('HOUR(tarih) as hour'),
                        DB::raw('AVG(DI) as di')
                    )
                    ->where('KUMES_ID', $id)
                    ->where('tarih', '>=', now()->subDay()) // Son 24 saat
                    ->groupBy(DB::raw('DATE(tarih)'), DB::raw('HOUR(tarih)')) // Tarih ve saat gruplaması
                    ->orderBy('date', 'asc')
                    ->orderBy('hour', 'asc')
                    ->get();
                break;
            

                case 'daily':
                    // Son 7 günün günlük toplamları
                    $data = DB::table('endkon_data')
                        ->select(
                            DB::raw('DATE(tarih) as date'),
                            DB::raw('AVG(DI) as di')
                        )
                        ->where('kumes_id', $id)
                        ->where('tarih', '>=', now()->subWeek()) // Son 7 gün
                        ->groupBy(DB::raw('DATE(tarih)')) // Her gün için gruplama yapıyoruz
                        ->orderBy('date', 'asc') // Tarihe göre sıralıyoruz
                        ->get();
                    break;

                    case 'weekly':
                        // Son 4 haftalık su tüketimi
                        $data = DB::table('endkon_data')
                            ->select(
                                DB::raw('YEARWEEK(tarih) as week'),
                                DB::raw('AVG(DI) as di')
                            )
                            ->where('kumes_id', $id)
                            ->where('tarih', '>=', now()->subMonth())
                            ->groupBy(DB::raw('YEARWEEK(tarih)'))
                            ->get();
                        break;
                case 'monthly':
                    // Son 12 aylık su tüketimi
                    $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('MONTH(tarih) as tarih'),
                        DB::raw('AVG(DI) as di')
                    )
                    ->where('kumes_id', $id)
                    ->where('tarih', '>=', now()->subYear())
                    ->groupBy(DB::raw('MONTH(tarih)'))
                    ->get();
                break;
        }
        

        return response()->json($data);
    }

    public function nemData(Request $request, $id)
    {
        $mode = $request->query('mode', 'daily'); // Varsayılan günlük veri
        $data = [];

        switch ($mode) {
            case 'minutely':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                ->select(
                    DB::raw('TIME(created_at) as date'),
                    DB::raw('NE as ne') // Ortalama DI değeri
                )
                ->where('KUMES_ID', $id)
                ->orderBy('created_at', 'desc') // En son veriler
                ->orderBy('date', 'desc') // En son veriler
                ->limit(30) // Son 30 kayıt
                ->get();
            break;
            case 'hourly':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('DATE(tarih) as date'),
                        DB::raw('HOUR(tarih) as hour'),
                        DB::raw('AVG(NE) as ne')
                    )
                    ->where('KUMES_ID', $id)
                    ->where('tarih', '>=', now()->subDay()) // Son 24 saat
                    ->groupBy(DB::raw('DATE(tarih)'), DB::raw('HOUR(tarih)')) // Tarih ve saat gruplaması
                    ->orderBy('date', 'asc')
                    ->orderBy('hour', 'asc')
                    ->get();
                break;
            

                case 'daily':
                    // Son 7 günün günlük toplamları
                    $data = DB::table('endkon_data')
                        ->select(
                            DB::raw('DATE(tarih) as date'),
                            DB::raw('AVG(NE) as ne')
                        )
                        ->where('kumes_id', $id)
                        ->where('tarih', '>=', now()->subWeek()) // Son 7 gün
                        ->groupBy(DB::raw('DATE(tarih)')) // Her gün için gruplama yapıyoruz
                        ->orderBy('date', 'asc') // Tarihe göre sıralıyoruz
                        ->get();
                    break;

                    case 'weekly':
                        // Son 4 haftalık su tüketimi
                        $data = DB::table('endkon_data')
                            ->select(
                                DB::raw('YEARWEEK(tarih) as week'),
                                DB::raw('AVG(NE) as ne')
                            )
                            ->where('kumes_id', $id)
                            ->where('tarih', '>=', now()->subMonth())
                            ->groupBy(DB::raw('YEARWEEK(tarih)'))
                            ->get();
                        break;
                case 'monthly':
                    // Son 12 aylık su tüketimi
                    $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('MONTH(tarih) as tarih'),
                        DB::raw('AVG(NE) as ne')
                    )
                    ->where('kumes_id', $id)
                    ->where('tarih', '>=', now()->subYear())
                    ->groupBy(DB::raw('MONTH(tarih)'))
                    ->get();
                break;
        }
        

        return response()->json($data);
    }
    public function coData(Request $request, $id)
    {
        $mode = $request->query('mode', 'daily'); // Varsayılan günlük veri
        $data = [];

        switch ($mode) {
            case 'minutely':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                ->select(
                    DB::raw('TIME(created_at) as date'),
                    DB::raw('CO as co') // Ortalama DI değeri
                )
                ->where('KUMES_ID', $id)
                ->orderBy('created_at', 'desc') // En son veriler
                ->orderBy('date', 'desc') // En son veriler
                ->limit(30) // Son 30 kayıt
                ->get();
            break;
            case 'hourly':
                // Son 24 saatlik veriler
                $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('DATE(tarih) as date'),
                        DB::raw('HOUR(tarih) as hour'),
                        DB::raw('AVG(CO) as co')
                    )
                    ->where('KUMES_ID', $id)
                    ->where('tarih', '>=', now()->subDay()) // Son 24 saat
                    ->groupBy(DB::raw('DATE(tarih)'), DB::raw('HOUR(tarih)')) // Tarih ve saat gruplaması
                    ->orderBy('date', 'asc')
                    ->orderBy('hour', 'asc')
                    ->get();
                break;
            

                case 'daily':
                    // Son 7 günün günlük toplamları
                    $data = DB::table('endkon_data')
                        ->select(
                            DB::raw('DATE(tarih) as date'),
                            DB::raw('AVG(CO) as co')
                        )
                        ->where('kumes_id', $id)
                        ->where('tarih', '>=', now()->subWeek()) // Son 7 gün
                        ->groupBy(DB::raw('DATE(tarih)')) // Her gün için gruplama yapıyoruz
                        ->orderBy('date', 'asc') // Tarihe göre sıralıyoruz
                        ->get();
                    break;

                    case 'weekly':
                        // Son 4 haftalık su tüketimi
                        $data = DB::table('endkon_data')
                            ->select(
                                DB::raw('YEARWEEK(tarih) as week'),
                                DB::raw('AVG(CO) as co')
                            )
                            ->where('kumes_id', $id)
                            ->where('tarih', '>=', now()->subMonth())
                            ->groupBy(DB::raw('YEARWEEK(tarih)'))
                            ->get();
                        break;
                case 'monthly':
                    // Son 12 aylık su tüketimi
                    $data = DB::table('endkon_data')
                    ->select(
                        DB::raw('MONTH(tarih) as tarih'),
                        DB::raw('AVG(CO) as co')
                    )
                    ->where('kumes_id', $id)
                    ->where('tarih', '>=', now()->subYear())
                    ->groupBy(DB::raw('MONTH(tarih)'))
                    ->get();
                break;
        }
        

        return response()->json($data);
    }
}
