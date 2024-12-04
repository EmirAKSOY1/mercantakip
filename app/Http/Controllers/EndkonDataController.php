<?php

namespace App\Http\Controllers;

use App\Models\DailyData;
use App\Models\EndkonData;
use App\Models\Entegre;
use App\Models\HourlyData;
use App\Models\Kumes;
use Illuminate\Http\Request;
use App\Exports\EndkonDataExport;
use Maatwebsite\Excel\Facades\Excel;

class EndkonDataController extends Controller
{
    public function index(Request $request)
    {
        $entegreler = Entegre::all();
    
        $query = EndkonData::with('kumes');
    
        // Eğer entegre_id mevcutsa, buna göre filtrele
        if ($request->has('entegre_id') && $request->entegre_id) {
            // Seçilen entegreye ait kümeleri al
            $kumesIds = Kumes::where('entegre_id', $request->entegre_id)->pluck('id');

            $query->whereIn('KUMES_ID', $kumesIds);
        }
    
        // Tarihe göre sıralama işlemi
        if ($request->has('sort_by') && $request->sort_by == 'created_at') {
            $order = $request->has('order') && $request->order == 'desc' ? 'desc' : 'asc';
            $query->orderBy('created_at', $order);
        }
        $query->orderBy('created_at', 'desc');

         $datas = $query->paginate(15);

        return view('admin.data.index', compact('datas', 'entegreler'));
    }
    public function show($id){
        $datas = EndkonData::where('KUMES_ID',$id)->paginate(10);
        return view('admin.data.kumes_data',compact('datas'));
    }

    public function kumes_gosterge($id)
    {
        // Verilen ID'ye ait son kaydı al
        $latestData = EndkonData::where('KUMES_ID', $id)->latest('TARIH')->first();
        $latestdailyData = DailyData::where('KUMES_ID', $id)->latest('created_at')->first();
        $latesthourlyData = HourlyData::where('KUMES_ID', $id)->latest('created_at')->first();

        if ($latestData) {
        $latesthourlyData = HourlyData::where('KUMES_ID', $id)->latest('created_at')->first();
            return view('admin.data.kumes_gosterge', compact('latestData','latestdailyData','latesthourlyData'));
        } else {
            return redirect()->back()->with('error', 'Belirtilen kümese ait veri bulunamadı.');
        }
    }
    public function exportExcel($kumesId)
    {
        // Parametreyi alarak Excel'e aktar
        return Excel::download(new EndkonDataExport($kumesId), 'endkon_data_kumes_' . $kumesId . '.xlsx');
    }
 
}
