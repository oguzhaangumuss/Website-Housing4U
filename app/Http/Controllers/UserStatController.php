<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserStatController extends Controller
{
    public function index()
    {
        // Kullanıcıları sayfalı olarak almak için paginate() kullanıyoruz
        $users = User::paginate(10);  // 10, sayfa başına gösterilecek kullanıcı sayısıdır
    
        return view('admin.userprocess.index', compact('users'));
    }

    // Kullanıcıyı gösterme
    public function show(User $user)
    {
        return view('admin.userprocess.show', compact('user'));
    }

    // Kullanıcıyı düzenleme formu
    public function edit(User $user)
    {
        $roles = Role::all();  // Tüm roller
        return view('admin.userprocess.edit', compact('user', 'roles'));
    }

    // Kullanıcıyı güncelleme
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->syncRoles([$request->role]);  // Rolü güncelle
        $user->save();

        return redirect()->route('admin.userprocess.index')->with('success', 'User updated successfully!');
    }

    // Kullanıcıyı silme
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.userprocess.index')->with('success', 'User deleted successfully!');  // 'users.index' yerine 'admin.userprocess.index' kullanılmalı
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|exists:roles,name',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);  // Şifreyi şifrele
    $user->save();

    // Kullanıcıya rol atama
    $user->assignRole($request->role);

    return redirect()->route('admin.userprocess.index')->with('success', 'User created successfully!');
}
}
