<?php

namespace App\Http\Controllers\Caretaker;

use App\Http\Controllers\Controller;
use App\Models\Kumes;
use Illuminate\Http\Request;

class KumesController extends Controller
{
    public function index(){
        $entegreId = auth()->user()->roleUser->entegre->id;
        //dd($entegreId);
        $coops = Kumes::where('entegre_id', $entegreId)->paginate(10);
        return view('bakıcı.kumes.index',compact('coops'));
    }
}
