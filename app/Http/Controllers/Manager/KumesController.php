<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Kumes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Log;
use Illuminate\Support\Facades\Request as IpRequest;

class KumesController extends Controller
{
    public function index()
    {
        $entegreId = auth()->user()->roleUser->entegre->id;
        //dd($entegreId);
        $coops = Kumes::where('entegre_id', $entegreId)
        ->with(['endkonData' => function ($query) {
            $query->latest('TARIH')->take(1); // Her kümesin son kaydı
        }])
        ->paginate(10);
        
        return view('manager.kumes.index',compact('coops'));
        
    }
    public function create(){
        return view('manager.kumes.create');
    }
    public function store(Request $request){
        $kumes = new Kumes();
        $kumes->name = $request['name'];
        $kumes->entegre_id = auth()->user()->roleUser->entegre->id;
        $kumes->capacity = $request['kapasite'];
        $kumes->latitude = $request['latitude'];
        $kumes->longitude = $request['longitude'];
        
        $kumes->save();

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Kümes Ekledi';
        $log->save();

        return redirect()->route('manager_kumes.index')->with('success', 'Kümes başarıyla eklendi.');
    }
    public function destroy(string $id)
    {
                
        $kumes = Kumes::findOrFail($id);
        $entegre_id = $kumes->entegre->id;
        $kumes->delete();

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Kümes Sildi';
        $log->save();

        return redirect()->route('manager_kumes.index')->with('success', 'Kümes başarıyla silindi.');
    }
    public function edit(string $id)
    {
        $kumes = Kumes::findOrFail($id);
        return view('manager.kumes.edit',compact('kumes'));
    }
    public function update(Request $request, string $id)
    {

        $kumes = Kumes::findOrFail($id);
        $kumes->update([
            'name' => $request->input('name'),
            'capacity' => $request->input('kapasite'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Kümes Güncellendi';
        $log->save();
        return redirect()->route('manager_kumes.index', )->with('success', 'Kümes başarıyla güncellendi.');
    }
}
