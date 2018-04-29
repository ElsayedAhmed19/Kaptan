<?php

namespace App\Libraries;

use App\Helpers\FirebaseHelper;
use App\Repositories\RequestsRepository;
use App\Helpers\GeneralHelpers;
use App\Repositories\DriversRepository;
use App\Repositories\ClientsRepository;
use App\Repositories\LocationsRepository;
use App\Repositories\NotificationsRepository;
use Datatables;

class RequestLibrary
{
	protected $activeRequestsPath;
	protected $driverHistoricalRequestsPath;
	protected $customerHistoricalRequestsPath;

	function __construct()
	{
		$this->activeRequestsPath = config('constants.REFRENCES_PATHS.ACTIVE_REQUESTS');
		$this->driverHistoricalRequestsPath = config('constants.REFRENCES_PATHS.DRIVER_HISTORICAL_REQUESTS');
		$this->customerHistoricalRequestsPath = 
			config('constants.REFRENCES_PATHS.REFRENCES_PATHS.CUSTOMER_HISTORICAL_REQUESTS');
	}
	public function getRequestsInDatatable($requestsPath)
	{
	    $requests = RequestsRepository::getRequests($requestsPath);
	    
	    if (substr($requestsPath, 1) == $this->activeRequestsPath) {
        	$preparedRequests = GeneralHelpers::prepareDataToDatatable($requests);
    	} else {
			$preparedRequests = GeneralHelpers::prepareHistoryDataDatatable($requests);
    	}

	    $datatableData = Datatables::of($preparedRequests) 
            ->addColumn('customerName', function ($request) {
                $customerName = !isset($request->customerName)? 'unspecified': $request->customerName;
                return $customerName;
            })
            ->addColumn('customerPhone', function ($request) {
                $customerPhone = !isset($request->customerPhone)? 'unspecified': $request->customerPhone;
                return $customerPhone;
            })
            ->addColumn('driverName', function ($request) {
                $driverName = !isset($request->driverName)? 'unspecified': $request->driverName;
                return $driverName;
            })
            ->addColumn('driverPhone', function ($request) {
                $driverPhone = !isset($request->driverPhone)? 'unspecified': $request->driverPhone;
                return $driverPhone;
            })
            ->addColumn('driverOrder', function ($request) {
                $driverOrder = !isset($request->driverOrder)? 'unspecified': $request->driverOrder;
                return $driverOrder;
            })
            ->addColumn('onTrip', function ($request) {
                if (!isset($request->onTrip)) {
                    $onTrip = 'unspecified';
                } else if($request->onTrip) {
                    $onTrip = 'Yes';
                } else {
                    $onTrip = 'No';
                }
                return $onTrip;
            })
            ->addColumn('requestTime', function ($request) {
                $requestTime = !isset($request->requestTime)? 'unspecified': date("d-m-Y H:i:s", $request->requestTime/1000);
                return $requestTime;
            })
            ->addColumn('operations', function ($request) {
                $returnHTML = view('requests.partials.menu')->render();
                return $returnHTML;
            })
            ->make(true);

    	return $datatableData;
    }

    public static function getOnlineDriversLocations()
    {
        $onlineDriversLocations = DriversRepository::getOnlineDriversLocations();
        $locations = [];
        foreach ($onlineDriversLocations as $key => $location) {
            $locations[$key]['lat'] = $location['l'][0];
            $locations[$key]['long'] = $location['l'][1];
        }

        return $locations;
    }

    public static function getOnlineDriversDistancesSorted($customerLocation)
    {
        $driversLocations = self::getOnlineDriversLocations();
        $driversDistances = [];
        foreach ($driversLocations as $key => $driverLocation) {
            $driversDistances[$key] = GeneralHelpers::calcDistance(
                $driverLocation['lat'],
                $driverLocation['long'],
                $customerLocation['lat'],
                $customerLocation['long']
            );
        }

        asort($driversDistances);

        return $driversDistances;
    }


    public static function getDataOfCustomerForRequest($customerId)
    {
        $customer = ClientsRepository::getCustomer($customerId);
        $customerData = [
            'customerID'=>$customer['userID'],
            'customerImageURL'=>$customer['imageURL']?:$customer['imageURL'],
            'customerName'=>$customer['username']?:$customer['username'],
            'customerPhone'=>$customer['phone']?:$customer['phone'],
            'customerToken'=>$customer['token']?:$customer['token']
        ];

        return $customerData;
    }

    public static function getDataOfDriverForRequest($driverId)
    {
        $driver = DriversRepository::getDriver($driverId);

        $driverLatLong = LocationsRepository::getDriverLatLong($driverId);

        $driverData = [
            'driverCarModel'=>$driver['carModel']?: $driver['carModel'],
            'driverCarNumber'=>$driver['carNumber']?: $driver['carNumber'],
            'driverID'=>$driver['userID']?: $driver['userID'],
            'driverImageURL'=>$driver['imageURL']?: $driver['imageURL'],
            'driverLat'=>$driverLatLong['l'][0],
            'driverLng'=>$driverLatLong['l'][1],
            'driverName'=>$driver['username']?: $driver['username'],
            'driverOrder'=>1,
            'driverPhone'=>$driver['phone']?: $driver['phone'],
            'driverToken'=>$driver['token']?: $driver['token']
        ];

        return $driverData;
    }
}