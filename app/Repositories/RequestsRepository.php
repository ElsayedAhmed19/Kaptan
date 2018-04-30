<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;
use App\References\References;

class RequestsRepository
{
	const CUSTOMERS_ACTIVE_REQUESTS_REFERENCE = 'requests/active/customers';

	const DRIVERS_HISTORY_REQUESTS_REFERENCE = 'requests/history/drivers';

	const REQUEST_SLEEP_PERIOD = '60';


	public static function getRequests($requestsPath)
	{
		$helper = new FirebaseHelper;
		$data = $helper->get($requestsPath);

		return $data;
	}

	public static function createRequest($data)
	{

		$array = [
		'accept'=>false,
		'addressDestination'=>null,
		'addressPickup'=>null,
		'customerID'=>null,
		'customerImageURL'=>null,
		'customerName'=>null,
		'customerPhone'=>null,
		'customerToken'=>null,
		'destination_lat'=>null,
		'destination_lng'=>null,
		'driverCarModel'=>null,
		'driverCarNumber'=>null,
		'driverID'=>null,
		'driverImageURL'=>null,
		'driverLat'=>null,
		'driverLng'=>null,
		'driverName'=>null,
		'driverOrder'=>null,
		'driverPhone'=>null,
		'enabled'=>true,
		'endLat'=>null,
		'endLng'=>null,
		'firstCancel'=>false,
		'onPending'=>true,
		'onTrip'=>false,
		'pickup_lat'=>null,
		'pickup_lng'=>null,
		'priceEstimate'=>null,
		'requestID'=>null,
		'requestTime'=>microtime(true),
		'secondCancel'=>false,
		'startLat'=>null,
		'startLng'=>null,
		'thirdCancel'=>false,
		'timeorder'=>null
	];



		$firebaseHelper = new FirebaseHelper();
		$requestData = $data + $array;


		$customerRequestId = $firebaseHelper->queryBuilder(self::CUSTOMERS_ACTIVE_REQUESTS_REFERENCE."/".$requestData['customerID'])->push($requestData)->getKey();

		$requestData['id'] = $customerRequestId;
		$isDriverRequestInserted = $firebaseHelper->set(self::DRIVERS_HISTORY_REQUESTS_REFERENCE."/".$requestData['driverID'], $requestData);

		if ($customerRequestId || $isDriverRequestInserted) {
			return $customerRequestId;
		}
	}
}