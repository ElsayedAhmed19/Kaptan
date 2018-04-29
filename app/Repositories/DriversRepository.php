<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;
use App\References\References;
use App\Repositories\UsersRepository;

class DriversRepository
{
	const DRIVER_REFERENCE = 'users/drivers';
	const DRIVER_ONLINE_REFERENCE = 'locations/drivers';
	protected $firebaseHelper;

	public static function insertDriver($data)
	{
		$helper = new FirebaseHelper;
		$isInserted = $helper->set(self::DRIVER_REFERENCE, $data);
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

	public static function getOnlineDriversLocations()
	{
		$helper = new FirebaseHelper;
		$data = $helper->get(self::DRIVER_ONLINE_REFERENCE);

		return $data;	
	}

	public static function getDriver($driverId)
	{
		$helper = new FirebaseHelper;
		$data = $helper->get(self::DRIVER_REFERENCE."/".$driverId);
		return $data;
	}
}
