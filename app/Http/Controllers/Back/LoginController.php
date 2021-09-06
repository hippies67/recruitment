<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('back.auth.data');
    }

    public function login(Request $request)
    {
        $remember = $request->remember ? true : false;
        
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt(array('username' => $input['username'], 'password' => $input['password']), $remember)) {
            return redirect()->route('recruitment-data.index');
        } else {
            Alert::error('Error', 'Username atau Password salah!');
            return redirect()->back();
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
