<?php

namespace Kernel\Controllers\Auth;

class Logout 
{
    public function handle()
    {
        unset($_SESSION['name']);
        return redirect('/login');
    }
}
