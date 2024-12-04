<?php

namespace App\Http\Controllers;

use App\Models\Entegre;
use App\Models\Kumes;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as IpRequest;
use Illuminate\Support\Facades\Auth;
class KumesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('admin.kumes.create',compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kumes = new Kumes();
        $kumes->name = $request['name'];
        $kumes->entegre_id = $request['entegre_id'];
        $kumes->latitude = $request['latitude'];
        $kumes->longitude = $request['longitude'];

        $sn = $request->input('sn');
        if($sn){
            $existingKumes = Kumes::find($sn);
            if ($existingKumes) {
                return redirect()->back()->withErrors([
                    'error' => 'Girilen seri numarası zaten mevcut. Lütfen farklı bir değer giriniz.'
                ]);
            }else{
                $kumes->id = $sn;
            }
        }
        
        $kumes->save();

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Kümes Ekledi|Id:'. $kumes->id;
        $log->save(); 

        return redirect()->route('kumes.show', $request['entegre_id'])->with('success', 'Kümes başarıyla eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entegre = Entegre::with('coops')->find($id);
        if (!$entegre) {
            return response()->json(['message' => 'Branch not found'], 404);
        }
       
        return view('admin.kumes.index', compact( 'entegre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kumes = Kumes::findOrFail($id);
        return view('admin.kumes.edit',compact('kumes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Kümes Güncelledi';
        $log->save(); 

        $kumes = Kumes::findOrFail($id);
        $kumes->update([
            'name' => $request->input('name'),
            'capacity' => $request->input('kapasite'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);
        return redirect()->route('kumes.show', $kumes->entegre->id)->with('success', 'Kümes başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kumes = Kumes::findOrFail($id);
        $entegre_id = $kumes->entegre->id;
        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Kümes Sildi|Id:'. $kumes->id;
        $log->save();
        $kumes->delete();
        return redirect()->route('kumes.show', $entegre_id)->with('success', 'Kümes başarıyla silindi.');
    }
}
