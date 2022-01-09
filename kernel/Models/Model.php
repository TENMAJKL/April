<?php

namespace Kernel\Models;

use Lemon\Utils\Env;

/*
 * Storage file is divided into keys that all contains data with same blueprint
 * This class represents specific key stored under name same as model
 * Static functions are for easier manipulation
 */
class Model
{


    /**
     * Content of storage file
     *
     * @var array $content
     */
    static array $content;

    /**
     * Returns model name from class name
     *
     * @return String
     */
    public static function getModelName()
    {

        $class = explode('\\', get_called_class());

        return strtolower(
            preg_replace(
                "/(?<!^)([A-Z])/",
                "_$1",
                end($class) 
            )
        ) . "s";
    }
    
    /**
     * Returns name of storage file
     *
     * @return String
     */
    public static function getStorageFilename()
    {
        return APP_FOLDER . Env::get("FILE");
    }

    /**
     * Returns content of storage file
     *
     * @return Array
     */
    public static function getStorageContent()
    {
        if (isset(self::$content))
            return self::$content;

        self::$content = json_decode(
            file_get_contents(
                self::getStorageFilename()
            ),
            true
        );
        return self::$content;
    }

    /**
     * Returns content of current model  
     *
     * @return Array
     */
    public static function getModelContent()
    {
        return self::getStorageContent()[self::getModelName()];
    }

    /**
     * Returns Model for given key
     *
     * @param mixed $key
     * @return Model
     */
    public static function key($name)
    {
        if (!isset(self::getModelContent()[$name]))
            return null;

        $class = get_called_class();
        return new $class($name);
    }

    /**
     * Returns all models from storage
     *
     * @return Model[]
     */
    public static function all()
    {
        $all = [];
        foreach (self::getModelContent() as $item => $o_o)
            array_push($all, self::key($item));

        return $all;
    }


    /**
     * Name of child model
     */
    public $model_name;

    /**
     * Key to identify model in storage
     */
    public $name;

    /**
     * Model data from storage found by given name
     */
    public $data;

    /**
     * Finds/Creates Model from storage file
     *
     * @param mixed $name
     * @param Array $data
     */
    public function __construct($name, $data=null)
    {
        $this->name = $name; 
        $this->model_name = self::getModelName();

        if (!$data)
            return $this->data = self::getModelContent()[$name];
        
        $this->data = $data;
        $this->save();
    }

    /**
     * Saves Model content to storage as json
     */
    public function save()
    {
        $storage_content = self::getStorageContent();
        $storage_content[self::getModelName()][$this->name] = $this->data;
        file_put_contents(
            self::getStorageFilename(), 
            json_encode(
               $storage_content 
            )
        );
        return $this;
    }

    /**
     * Returns data saved under key in current model
     *
     * @param mixed $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->data[$key];
    }

    /**
     * Returns data saved under key in current model
     *
     * @param mixed $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->data[$key];
    }

    /**
     * Updates value in data
     *
     * @param mixed $key
     * @param mixed $value 
     */
    public function update($key, $value)
    {
        $this->data[$key] = $value;
        $this->save();
        return $this;
    }


}
