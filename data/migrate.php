<?php
require __DIR__ . "/../public/index.php";

use Lemon\Utils\Env;

file_put_contents(APP_FOLDER . Env::get("FILE"), "{}");

$storage = APP_FOLDER . "/data/migrations/"; 

echo "\033[33m";

foreach (scandir($storage) as $file)
{
    if (!in_array($file, ["Migration.php", ".", ".."]))
    {
        require_once $storage . $file;
        $classname = explode(".", $file)[0];
        echo "Migrating $classname...\n";
        $class = new $classname();
    }
}

echo "Done\n\033[0m";
