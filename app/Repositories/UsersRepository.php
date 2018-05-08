<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;

class UsersRepository extends FirebaseHelper
{
	protected $firebaseHelper;
	function __construct()
	{
		$this->firebaseHelper = new FirebaseHelper();
	}

	public function updateUser($userData)
	{
		$firebaseHelper = new FirebaseHelper();
		$user = $firebaseHelper->auth->changeUserPassword($userData['id'], $userData['password']);
		$user = $firebaseHelper->auth->changeUserEmail($userData['id'], $userData['email']);

		dd($user);
	}

    public static function getUserByID($id){
        $helper = new FirebaseHelper;
        $data = $helper->get('users/customers'.'/'.$id);
        return $data;
    }
}
