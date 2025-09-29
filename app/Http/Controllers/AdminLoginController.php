<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function showForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|string',
            'admin_password' => 'required|string',
        ]);

        $id = env('ADMIN_ID');
        $hash = env('ADMIN_PASSWORD_HASH');

        if ($request->admin_id === $id && password_verify($request->admin_password, $hash)) {
            $request->session()->put('is_admin', true);
            return redirect()->route('submit-blog');
        }

        return back()->withErrors(['Invalid credentials']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');
        return redirect()->route('admin.login.form');
    }
}
