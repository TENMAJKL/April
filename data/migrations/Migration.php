<?php

use Lemon\Utils\Env;

abstract class Migration
{
    public function __construct()
    {
        $key_name = 
            strtolower(
                preg_replace(
                    "/(?<!^)([A-Z])/",
                    "_$1", 
                    get_class($this)
                )
            );
        $file = APP_FOLDER . Env::get("FILE");
        $content = file_get_contents($file);
        $data = json_decode($content, true);
        $data[$key_name] = [];
        file_put_contents($file, json_encode($data));

        $this->up();
    }

    abstract function up();
}
