<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;

class UsersRepository extends FirebaseHelper
{
	protected $firebaseHelper;
	function __construct()
	{
		$this->firebaseHelper = new FirebaseHelper();
		dd($this->firebaseHelper->auth);
	}
}
