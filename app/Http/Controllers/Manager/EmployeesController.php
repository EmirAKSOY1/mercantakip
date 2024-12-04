<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Log;
use Illuminate\Support\Facades\Request as IpRequest;

class EmployeesController extends Controller
{
    public function index(){
        $entegreId = auth()->user()->roleUser->entegre->id;
        $employees  = User::whereHas('roleUser', function($query) use ($entegreId) {
            $query->where('entegre_id', $entegreId);
        })->get();
        //dd($employees);
        return view('manager.employees.index', compact('employees'));
    }
    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Çalışan Sildi';
        $log->save();

        return redirect()->route('manager_employees.index')->with('success', 'Kullanıcı başarıyla silindi.');
    }
    public function create(){
        $roles = Role::whereIn('role_name', ['bakıcı', 'veteriner'])->get();
        return view('manager.employees.create',compact('roles'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'mail' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'pass' => 'required|min:8|same:pass_verify',
            'pass_verify' => 'required|min:8'
        ]);

        $user = new User([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->mail,
            'password' => Hash::make($request->pass),
        ]);
        
        $user->save();
        $userRole = new UserRole();
        $userRole ->user_id = $user->id;
        $userRole ->entegre_id = auth()->user()->roleUser->entegre->id;
        $userRole ->role_id = $request->role_id;
        
        $userRole->save();

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Çalışan Oluşturdu';
        $log->save();

        return redirect()->route('manager_employees.index')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }
    public function edit($id){
        $user = User::findOrFail($id);
        $roles = Role::whereIn('role_name', ['bakıcı', 'veteriner'])->get();
        return view('manager.employees.edit',compact('roles','user'));
    }
    public function update($id, Request $request){
        $user = User::findOrFail($id);
        $user_rol = UserRole::where('user_id', $id)->first();

        $user->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
        ]);
        $user_rol->update([
            'role_id' =>$request->input('role_id'),
        ]);

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Çalışan Güncelledi';
        $log->save();

        return redirect()->route('manager_employees.index')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }
}
