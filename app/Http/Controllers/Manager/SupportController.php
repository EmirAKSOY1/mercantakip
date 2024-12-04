<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\SupportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Log;
use Illuminate\Support\Facades\Request as IpRequest;

class SupportController extends Controller
{
    public function index(){
        $userId = Auth::id();
        $supportRequests = SupportRequest::where('requester_id', $userId)->paginate(10);
        return view('manager.support.index',compact('supportRequests'));
    }
    public function create(){
        return view('manager.support.create');
    }
    public function store(Request $request){
          // Form doğrulama
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Her resim maksimum 2MB
    ]);

    $images = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('support_requests', 'public');
            $images[] = $path;
        }
    }

    // Yeni destek talebi kaydı
    SupportRequest::create([
        'title' => $request->title,
        'description' => $request->description,
        'images' => $images,
        'status' => 'open',
        'requester_id' => Auth::id(),
    ]);

    $log = new Log();
    $log->ip = IpRequest::ip();
    $log->user_id = Auth::id();
    $log->action = 'Talep Oluşturdu';
    $log->save();

    return redirect()->route('manager_support.index')->with('success', 'Destek talebiniz başarıyla oluşturuldu. En kısa sürede yanıtlanacaktır.');
    }
    public function show($id){
        $supportRequest = SupportRequest::findOrFail($id);
        return view('manager.support.show',compact('supportRequest'));
    }
}
