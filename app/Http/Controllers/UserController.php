<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use App\Models\Entegre;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as IpRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::with('roles')->paginate(10);
        //dd($users);
        return view('admin.user.index',compact('users'));
    }
    public function create(){
        $entegreler = Entegre::all();
        $roles = Role::all();
        return view('admin.user.create',compact('entegreler','roles'));
    }
    public function store(Request $request){
        
                $request->validate([
                    'name' => 'required|string|max:255',
                    'surname' => 'required|string|max:255',
                    'mail' => 'required|email|unique:users,email',
                    'entegre_id' => 'required|exists:entegre,id',
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
                $userRole ->entegre_id = $request->entegre_id;
                $userRole ->role_id = $request->role_id;
                
                $userRole->save();
                
                $log = new Log();
                $log->ip = IpRequest::ip();
                $log->user_id = Auth::id();
                $log->action = 'Kullanıcı Ekledi';
                $log->save(); 
        
                return redirect()->route('user.index')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }
    public function destroy(string $id)
    {
        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Kullanıcı Sildi';
        $log->save(); 

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Kullanıcı başarıyla silindi.');
    }
    public function edit($id){
        $user = User::findOrFail($id);
        $entegreler = Entegre::all();
        $roles = Role::all();
        return view('admin.user.edit',compact('entegreler','roles','user'));
    }
    public function update(Request $request , $id){

        $log = new Log();
        $log->ip = IpRequest::ip();
        $log->user_id = Auth::id();
        $log->action = 'Kullanıcı Güncelledi';
        $log->save(); 

        $user = User::findOrFail($id);
        $user_rol = UserRole::where('user_id', $id)->first();

        $user->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'email' => $request->input('email'),
        ]);
        $user_rol->update([
            'role_id' =>$request->input('role_id'),
            'entegre_id' =>$request->input('entegre_id'),
        ]);

        return redirect()->route('user.index')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }
}
