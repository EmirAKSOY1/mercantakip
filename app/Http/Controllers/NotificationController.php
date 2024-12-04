<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function index(){
        $notification = Notification::with('user')->paginate(10);
        return view('admin.notification.index',compact('notification'));
    }
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        if (auth()->user()->roles->first()->role_name='admin') {
            $notification->delete();
            return redirect()->route('notifications.index')->with('success', 'Bildirim başarıyla silindi.');
        }

        return redirect()->route('notifications.index')->with('error', 'Bu bildirimi silme yetkiniz yok.');
    }
    public function create()
    {
        return view('admin.notification.create');
    }
    public function store(Request $request){
        //dd(auth()->user()->id);
        $notification = new Notification();
        $notification ->title = $request['title'];
        $notification ->content = $request['content'];
        $notification ->user_id	 = auth()->user()->id;  
        $notification->save();
        return redirect()->route('notifications.index')->with('success', 'Bildirim Başarıyla Eklendi.');
    }
    public function edit(string $id){
        $notification = Notification::findOrFail($id);
        return view ('admin.notification.edit',compact('notification'));
    }
    public function update(Request $request , string $id){
        $notification = Notification::findOrFail($id);
        $notification ->update([
            'title' => $request['title'],
            'content' => $request['content'],
            'user_id' =>  auth()->user()->id,
        ]);
        return redirect()->route('notifications.index')->with('success', 'Bildirim Başarıyla Güncellendi.');
    }
}

