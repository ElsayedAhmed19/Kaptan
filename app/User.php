<?php

namespace App;

use App\Helpers\FirebaseHelper;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    public $helper;
    protected $table;
    function __construct()
    {
        $helper = new FirebaseHelper() ;
        $this->table = $helper->queryBuilder('users/');
    }

    use Notifiable;

    public $name;
    public $email;
    public $phone;
    public $password;
}
