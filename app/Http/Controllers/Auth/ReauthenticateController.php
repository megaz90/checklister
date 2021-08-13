<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReauthenticateController extends Controller
{
    public function reauth_show()
    {
        return view('auth.reauth');
    }

    public function reauth_check(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $user = User::find(auth()->user()->id);

        if (Hash::check($request->password, $user->password)) {
            session(['reauth' => TRUE]);
            return redirect()->route('admin.assign.permission-role.create');
        }

        return redirect()->route('admin.reauth.show')->with('error', 'Password not Matched');
    }
}
