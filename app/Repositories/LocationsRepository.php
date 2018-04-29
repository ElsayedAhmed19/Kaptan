<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;
use App\References\References;
class LocationsRepository
{
	const LOCATIONS_REFERENCE = 'locations/drivers';

    public static function getDriverLatLong($driverId)
    {
        $helper = new FirebaseHelper;
		$data = $helper->get(self::LOCATIONS_REFERENCE."/".$driverId);

		return $data;
    }
}