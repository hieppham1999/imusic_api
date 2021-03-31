<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserAuthController extends Controller
{
    //
    function login(Request $request) {
        $data = $request->input();
        $request->session()->put('user', $data['email']);
        return redirect('profile');
    }

    function check(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6|max:12'
        ]);

        $user = User::where('email','=', $request->email)->first();
        if($user){
            // If password is correct, redirect user to 
            if(Hash::check($request->password, $user->password)) {
                if ($user->user_type == 'admin') {
                    $request->session()->put('LoggedUser', $user->user_id);
                    return redirect('profile');
                }
                    return back()->with('fail', "You don't have admin permission to signin");
            } else {
                return back()->with('fail', 'Invalid password');
            }
        } else {
            return back()->with('fail', "This account doesn't exist!");
        }
    }

    function profile() {
        if (session()->has('LoggedUser')) {
            $user = User::where('user_id', '=', session('LoggedUser'))->first();
            $data = [
                'LoggedUserInfo'=>$user
            ];
        }
        return view('admin.profile', $data);
    }
}
