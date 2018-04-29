<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\Helpers\FirebaseHelper;
use Illuminate\Http\Request;
use App\Repositories\RequestsRepository;
use App\Repositories\NotificationsRepository;
use App\Libraries\RequestLibrary;

class RequestsController extends Controller
{
    protected $requestsLibrary;
    public function __construct()
    {
        $this->requestsLibrary = new RequestLibrary;
    }
    public function allRequests()
    {
        return view('requests.all_requests');
    }

    public function datatable(Request $request)
    {
        $currentPath = $request->get('currentPath');
        $datatableData = $this->requestsLibrary->getRequestsInDatatable($currentPath);

        return $datatableData;
    }

    public function createRequest(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'pickup_lat' => 'required',
            'pickup_long' => 'required',
            'pickup' => 'required',
            'destination' => 'required',
            'customerId' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('clients/create_request')->withInput()->withErrors($validator);
        }
        $data['pickupLat'] = $request->get('pickup_lat');
        $data['pickupLong'] = $request->get('pickup_long');

        $data['startLat'] = $request->get('pickup_lat');
        $data['startLng'] = $request->get('pickup_long');
        
        $data['destination_lat'] = $request->get('destination_lat');
        $data['destination_lng'] = $request->get('destination_long');

        $data['endLat'] = $request->get('destination_lat');
        $data['endLong'] = $request->get('destination_long');

        $data['addressPickup'] = $request->get('pickup');
        $data['addressDestination'] = $request->get('destination');

        $data['customerID'] = $request->get('customerId');

        $isCreated = self::makeRequest($data);

        if ($isCreated) {
            return redirect('requests/active/customers');
        }
    }

    public function makeRequest($data)
    {
        $driversDistances = RequestLibrary::getOnlineDriversDistancesSorted(
            ['lat'=>$data['pickupLat'], 'long'=>$data['pickupLong']]
        );

        $isCreated = false;

        $requestData = [];
        foreach ($driversDistances as $driverId => $driverDistance) {
            $driverData = RequestLibrary::getDataOfDriverForRequest($driverId);
            $customerData = RequestLibrary::getDataOfCustomerForRequest($data['customerID']);
            $requestData = $data + $driverData + $customerData;

            $requestId = RequestsRepository::createRequest($requestData);

            NotificationsRepository::insertNotification($requestData);

            $isCreated = true;
            // sleep(RequestsRepository::REQUEST_SLEEP_PERIOD);
        }

        return $isCreated;
        // $d = \App\Libraries\RequestLibrary::getOnlineDriversDistances(['lat'=>31.021, 'long'=>30.122]);
    }
}
