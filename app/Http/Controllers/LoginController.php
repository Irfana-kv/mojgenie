<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //

    public function login()
    {
        $title='Login';
        return view('login',compact('title'));
    }


    public function login_user(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember_me = $request->has('remember') ? true : false;

        if (auth()->guard('web')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember_me)) {
            session()->flash('success', 'Login successfully');
            return redirect()->to('home');
        } else {
            return back()->withInput()->withErrors(['Invalid credentials']);
        }
    }

    public function register()
    {
        $title='Register';
        return view('register',compact('title'));
    }

    public function register_store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|regex:/^[\pL\s]+$/u|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|min:3',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->remember_token = rand(0, 1000000000000);
        if ($user->save()) {
            session()->flash('success', 'Your Account created successfully');
            return redirect('login');
        }
    }

public function logout(){
    Auth::guard('web')->logout();
    return redirect('login');
}

}
