<?php

namespace Kernel\Middleware;

class Authenticated
{
    public function handle()
    {
        if (!isset($_SESSION['name']))
            return redirect('/login');
    }
}
