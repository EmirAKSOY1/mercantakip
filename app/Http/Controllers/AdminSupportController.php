<?php

namespace App\Http\Controllers;

use App\Models\SupportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminSupportController extends Controller
{
    public function index(){
        $supportRequests = SupportRequest::paginate(10);
        return view("admin.support.index",compact("supportRequests"));
    }
    public function show($id){
        $supportRequest = SupportRequest::findOrFail($id);
        if($supportRequest->status == 'open'){
            $supportRequest->status = 'in_progress';
            $supportRequest->save();
        }

        return view('admin.support.show',compact('supportRequest'));
    }
    public function update(Request $request, $id){
        $supportRequest = SupportRequest::findOrFail($id);
        $supportRequest->response = $request['response'];
        $supportRequest->responder_id = Auth::id();
        $supportRequest->status = 'resolved';
        $supportRequest->save();
        return redirect()->route('admin_support.index')->with('success', 'Talep Başarıyla Cevaplandı');
        
    }
}
