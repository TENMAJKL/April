<?php

namespace Kernel\Controllers\Auth;

use Kernel\Models\User;
use Lemon\Http\Request;

class Login
{
    public function get()
    {
        return view('auth.login', ['error' => null]);
    }

    public function post(Request $request)
    {
        if (!$request->name || !$request->password)
            return view('auth.login', ['error' => 'Any field can\'t be empty']);
        
        $user = User::key($request->name);

        if (!$user)
            return view('auth.login', ['error' => 'No such user']);

        if (!password_verify($request->password, $user->password))
            return view('auth.login', ['error' => 'Invalid password']);

        $_SESSION['name'] = $request->name;
        
        return redirect('/');
    }
}
