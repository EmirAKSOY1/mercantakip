<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request){
        
        $query = Log::with('user');
        if ($request->has('sort_by') && $request->sort_by == 'date') {
            $order = $request->has('order') && $request->order == 'desc' ? 'desc' : 'asc';
            $query->orderBy('date', $order);
        }
        if ($request->filled('user_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }
        // Filtrelenmiş ve sıralanmış verileri sayfalandır
        $logs = $query->paginate(10);
        return view('admin.log.index',compact('logs'));
    }
}
