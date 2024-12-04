<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layout.myaccount');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $user = auth()->user();

        // Girdi doğrulaması
        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'required',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
    
        // Eski şifreyi doğrula
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Eski şifre hatalı.']);
        }
    
        // Kullanıcı bilgilerini güncelle
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
    
        // Yeni şifreyi güncelle (eğer girildiyse)
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }
    
        $user->save();
    
        return back()->with('success', 'Bilgileriniz başarıyla güncellendi.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
