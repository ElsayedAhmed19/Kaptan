<?php

namespace App\Libraries;

use App\Helpers\FirebaseHelper;
use App\Repositories\DriversRepository;
use App\Repositories\UsersRepository;

class UsersLibrary
{
	protected $usersRepo;

	function __construct()
	{
		$this->usersRepo = new UsersRepository;
	}

	public static function updateUser($reference, $userData)
	{
		$idUpdated = false;
		$firebaseHelper = new FirebaseHelper();

		if ($firebaseHelper->auth->getUser($userData['id'])) {
			$driver = $firebaseHelper->get($reference, $userData['id']);

			$user = $firebaseHelper->auth->changeUserPassword($userData['id'], $userData['password']);
			$user = $firebaseHelper->auth->changeUserEmail($userData['id'], $userData['email']);


			if (!$user || !$driver) {
				$isUpdated = false;
			} else {
				$firebaseHelper->update($reference, $userData);
				$isUpdated = true;
			}
		}

		return $isUpdated;
	}
}