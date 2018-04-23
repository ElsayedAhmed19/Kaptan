<?php

namespace App\Libraries;

use App\Helpers\FirebaseHelper;
use App\Repositories\RequestsRepository;
use App\Helpers\GeneralHelpers;
use Datatables;
class RequestsLibrary
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
}