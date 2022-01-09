<?php

use Kernel\Models\User;

include "Migration.php";

class Users extends Migration
{
    public function up()
    {
        $password = uniqid();
        echo "\033[31mPassword to root is " . $password . PHP_EOL . 
             "PLEASE CHANGE IT USING <todo make the command ok>\033[33m" . PHP_EOL;

        
        new User('root', $password);
    }
}
