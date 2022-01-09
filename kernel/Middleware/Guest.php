<?php

namespace Kernel\Middleware;

class Guest
{
    public function handle()
    {
        if (isset($_SESSION['name']))
            return redirect('/');
    }
}
