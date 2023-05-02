<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected function guard()
    {
        return Auth::guard('alt');
    }

    public function username()
    {
    return 'user_name';
    }

    public function login(Request $request)
    {
        // if user is already logged in, log them out
        if (User::getCurrent()) {
            User::logout();
        }

         $requestUser = User::where('user_email', $request->input('email'))->first();

        if ($requestUser) {
            if (Hash::check($request->input('password'), $requestUser->user_pass)) {
                // The passwords match...
                // Manually log in the user
                User::setCurrent($requestUser);
                return redirect()->route('homePage');
            }
        }
        // The credentials do not match...
        return redirect()->back()->withErrors(['credentials' => 'The provided credentials do not match our records.']);
    }

    public function logout()
    {
        User::logout();
        return redirect()->route('loginPage');
    }

    public function register(Request $request){


        if($request->input('password') != $request->input('password_repeat')){
            return redirect()->back()->withErrors(['credentials' => 'The provided passwords do not match.']);
        }
        if(User::where('user_email', $request->input('email'))->first()){
            return redirect()->back()->withErrors(['credentials' => 'The provided email is already taken.']);
        }

        $user = new User();
        $user->user_name = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->user_email = $request->input('email');
        $user->user_pass = Hash::make($request->input('password'));
        $user->user_super = 0;	// 0 = not admin, 1 = admin
        $user->save();

        return redirect()->route('loginPage');
    }
}

