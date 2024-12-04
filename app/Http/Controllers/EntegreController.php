<?php

namespace App\Http\Controllers;

use App\Models\Entegre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use Illuminate\Support\Facades\Request as IpRequest;
class EntegreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entegreler = Entegre::withCount('coops')->paginate(10);
        return view('admin.entegre.index',compact('entegreler'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.entegre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $entegre = new Entegre();
        $entegre ->entegre_isim = $request['entegre'];
        $entegre->save();

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Entegre Eklendi';
        $log->save(); 

        return redirect()->route('entegreler.index')->with('success', 'Entegre Başarıyla Eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entegre = Entegre::findOrFail($id);
        return view('admin.entegre.edit',compact('entegre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $entegre = Entegre::findOrFail($id);
        $entegre ->update([
            'entegre_isim' => $request['entegre_isim'],
        ]);

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Entegre güncelledi';
        $log->save(); 
        
        return redirect()->route('entegreler.index')->with('success', 'Entegre Başarıyla Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Entegre Silindi';
        $log->save();  

        $entegre = Entegre::findOrFail($id);
        $entegre->delete();
        return response()->json(['success' => 'Entegre başarıyla silindi.']);
    }
}
