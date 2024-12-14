<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


class UserStatController extends Controller
{
    use HasRoles;
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
    public function create()
    {
        return view('admin.userprocess.create' );
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
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return back with errors if validation fails
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    
        // Create a new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);  // Encrypt the password
        $user->save();
    
        // Assign the default 'user' role
        $user->assignRole('user');  // This will assign the "user" role to the created user
    
        // Redirect back with success message
        return redirect()->route('admin.userprocess.index')->with('success', 'User created successfully!');
    }
}
