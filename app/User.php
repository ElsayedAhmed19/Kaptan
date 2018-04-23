<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $name;
    public $email;
    public $phone;

    public __construct($name, $email, $phone)
    {
        return (new User($name, $email, $phone));
    }
}