<?php

namespace Kernel\Models;

/**
 * Represents User
 *
 * @property string $salt
 * @property string $password
 */
class User extends Model 
{
    public function __construct($name, $password='')
    {
        if (!$password)
            return $this->data = self::getModelContent()[$name];

        $this->name = $name;

        $this->data = [
            'password' => password_hash($password, PASSWORD_ARGON2ID)
        ];
        $this->save();
    } 
}
