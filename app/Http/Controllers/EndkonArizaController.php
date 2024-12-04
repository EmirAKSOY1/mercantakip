<?php

namespace App\Http\Controllers;

use App\Models\EndkonAriza;
use App\Models\Entegre;
use App\Models\Kumes;
use Illuminate\Http\Request;

class EndkonArizaController extends Controller
{
    public function index(Request $request){
        $entegreler = Entegre::all();

        $query=EndkonAriza::with('kumes');

        if ($request->has('entegre_id') && $request->entegre_id) {
            $kumesIds = Kumes::where('entegre_id', $request->entegre_id)->pluck('id');
            $query->whereIn('kumes_id', $kumesIds);
        }


        $arizalar = $query->paginate(10);
    

        return view('admin.ariza.index',compact('arizalar','entegreler'));
    
    }
}
