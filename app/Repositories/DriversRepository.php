<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;
use App\References\References;
use App\Repositories\UsersRepository;

class DriversRepository
{
	const DRIVER_REFERENCE = 'users/drivers';
	protected $firebaseHelper;
	function __construct()
	{
		$this->firebaseHelper = new FirebaseHelper; 
	}
	public static function insertDriver($data)
	{
		$helper = new FirebaseHelper;
		$isInserted = $helper->insert(self::DRIVER_REFERENCE, $data);
		return $isInserted;
	}

	public static function getDrivers()
	{
		$helper = new FirebaseHelper;
		$data = $helper->get(self::DRIVER_REFERENCE);

		return $data;
	}

	public static function getDriversWithLocations()
	{
		$helper = new FirebaseHelper;
		$data = $helper->get('locations/allDrivers');

		return $data;	
	}
}
