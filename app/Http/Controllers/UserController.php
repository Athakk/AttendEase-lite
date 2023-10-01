<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    function index() {
        $user = User::get();
        return view('admin.user.index', compact('user'));
    }

    function create() {
        return view('admin.user.create');
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'whatsapp' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'in:user,admin',
            'avatar' => 'nullable',
            'file' => 'required',
        ]);

        if ($request->file('file')) {
            $file_name = time() . '-' . $request->file('file')->getClientOriginalName();
            $image = $request->file('file')->storeAs('public/user', $file_name);
            $request['avatar'] = $file_name;
        }
        
        $request['password'] = bcrypt($request['password']);

        User::create($request->all());
        
        return redirect()->route('user.index')->with('success', 'User berhasil ditambah!');
    }
    
    function show() {
        
    }

    function edit(User $user) {
        return view('admin.user.edit', compact('user'));
    }
    
    function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required',
            'whatsapp' => 'required',
            'email' => 'required',
            'level' => 'in:user,admin',
            'avatar' => 'nullable',
            'file' => 'required'
            
        ]);
        if ($request->file('file')) {
            File::delete('storage/user/'. $user->avatar);
            $file_name = time() . '-' . $request->file('file')->getClientOriginalName();
            $image = $request->file('file')->storeAs('public/user', $file_name);
            $user->avatar = $file_name;
        }

        if (!isset($request['password']) || $request['password'] != '') {
            $user->password = bcrypt($request['password']);
        } 

        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->update();
        
        return redirect()->route('user.index')->with('success', 'User berhasil diubah!');
    }

    function destroy(User $user) {
        if (Auth::user()->id == $user->id) {
            return redirect()->route('user.index')->with('error', 'Tidak bisa menghapus user!');
        }
        File::delete('storage/user/'. $user->avatar);
        User::destroy($user->id);
        return response()->json(['status' => 'User berhasil dihapus!']);
    }
}