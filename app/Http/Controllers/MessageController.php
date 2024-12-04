<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function markAsRead($id)
{
    $message = Message::findOrFail($id);
    
    // Mesajı okundu olarak işaretle
    $message->is_read = true;
    $message->save();

    return redirect()->back();
}
}
