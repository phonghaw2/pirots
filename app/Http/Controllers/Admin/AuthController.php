<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function login()
    {
        return view('admin.auth.login');
    }

    public function login_action(request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',

            ],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (hash::check($request->password,$user->password) && $user->role === UserRoleEnum::ADMIN) {
                auth()->login($user, true);
                return redirect()->route('admin.dashboard');
            }else {
                return redirect()->route('admin.login')->with('fail', 'Password not match');
            }
        }else {
            return redirect()->route('admin.login')->with('fail', 'Check your email :v');
        }
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function register_action(request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'min:6',
            ],

        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRoleEnum::ADMIN,
        ]);
        return redirect()->route('admin.login')->with('success', 'Please Login!');
    }
    public function logout(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');

    }
    public function password()
    {
        return view('admin.auth.password');
    }
    public function change_password(request $request)
    {
        $request->validate([
            'old_password' => [
                'required',
                'current_password',
            ],
            'new_password' => [
                'required',
                'confirmed',
            ],

        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return redirect()->back()->with('success','Your password has been changed');
    }
}
