<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseTrait;
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
                'confirmed',
            ],

        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => UserRoleEnum::CUSTOMER,
        ]);
        return $this->successResponse();
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
            if (hash::check($request->password,$user->password)) {
                auth()->login($user, true);
                return $this->successResponse();
            }else {
                return $this->errorResponse('Password not match');
            }
        }else {
            return $this->errorResponse('This email is not registered');
        }
    }

    public function logout(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('homepage');

    }
}
