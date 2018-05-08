<?php

namespace App\Http\Controllers;

use App\Repositories\DriversRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\Helpers\FirebaseHelper;
use Illuminate\Http\Request;
use App\Repositories\ClientsRepository;
use App\Libraries\ClientsLibrary;
use Datatables;
use Validator;

class ClientsController extends Controller
{
    public function __construct()
    {
        // if (Session::get('user')['isAdmin'] == false && Session::get('user')['isHotel'] == false && !empty(Session::get('user'))) {
        //     return abort(404);
        // } elseif (empty(Session::get('user'))) {
        //     return Redirect::to('login')->send();
        // }
    }

    function insertClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return redirect('clients/add_client')
                ->withErrors($validator)
                ->withInput();
        } else {
            $firebaseHelper = new FirebaseHelper;

            $createdUser = $firebaseHelper->auth->createUserWithEmailAndPassword(
                $request->get('email'),
                $request->get('password')
            );
            $id = $createdUser->getUid();
            $name = $request->get('name');
            $email = $request->get('email');
            $phone = $request->get('phone');
            $password = $request->get('password');
            $isHotel = false;
            $hotelID = 0;
            if (!empty(Session::get('user')) && Session::get('user')['isHotel'] == true && isset(Session::get('user')['hotelID'])) {
                $hotelID = Session::get('user')['userID'];
            }

            $isInserted = ClientsRepository::insertClient([
                'id' => $id,
                'admin' => false,
                'blocked' => true,
                'attendance' => 0,
                'balance' => 0,
                'behavior' => 0,
                'isHotel' => $isHotel,
                'hotelID' => $hotelID,
                'behaviorCount' => 0,
                'deleted' => false,
                'email' => $email,
                'fullname' => $name,
                'imageURL' => '',
                'isAdmin' => false,
                'isOnline' => false,
                'membersince' => time(),
                'nationality' => '',
                'online' => false,
                'onTrip' => false,
                'overallRatingCount' => 0,
                'phone' => $phone,
                'token' => 'Token',
                'userID' => $id,
                'username' => $name
            ]);
            return redirect('clients');
        }
    }

    public function allClients()
    {
        return view('clients.all_clients');
    }

    public function datatable()
    {
        if (!empty(Session::get('user')) && Session::get('user')['isHotel'] == true &&Session::get('user')['isAdmin'] == false && isset(Session::get('user')['hotelID'])) {
            $clients = ClientsRepository::getHotelCustomers(Session::get('user')['userID']);
        } else {
            $clients = ClientsRepository::getClients();
        }

        $objClients = null;
        foreach ($clients as $key => $client) {
            if (is_array($client)) {
                $client['id'] = $key;
                $objClients [] = (object)$client;
            }
        }

        return Datatables::of($objClients)
            ->addColumn('fullname', function ($client) {
                $fullname = !isset($client->fullname) ? 'unspecified' : $client->fullname;
                return $fullname;
            })
            ->addColumn('email', function ($client) {
                $email = !isset($client->email) ? 'unspecified' : $client->email;
                return $email;
            })
            ->addColumn('phone', function ($client) {
                $phone = !isset($client->phone) ? 'unspecified' : $client->phone;
                return $phone;
            })
            ->addColumn('onTrip', function ($client) {
                if (!isset($client->onTrip)) {
                    $onTrip = 'unspecified';
                } else if ($client->onTrip) {
                    $onTrip = 'Yes';
                } else {
                    $onTrip = 'No';
                }
                return $onTrip;
            })
            ->addColumn('online', function ($client) {
                if (!isset($client->online)) {
                    $online = 'unspecified';
                } else if ($client->online) {
                    $online = 'Yes';
                } else {
                    $online = 'No';
                }
                return $online;
            })
            ->addColumn('blocked', function ($client) {
                if (!isset($client->onTrip)) {
                    $blocked = 'unspecified';
                } else if ($client->blocked) {
                    $blocked = 'Yes';
                } else {
                    $blocked = 'No';
                }
                return $blocked;
            })
            ->addColumn('operations', function ($client) {
                $returnHTML = view('clients.partials.menu')->render();
                return $returnHTML;
            })
            ->make(true);
    }

    public function getCreateRequest()
    {
        $clients = ClientsRepository::getClients();

        return view('clients.make_request', ['clients' => array_values($clients)]);
    }

    public function editClient($id)
    {

        $client = ClientsRepository::getCustomer($id);

        if ($client) {
            return view('clients.add_client', ['client' => $client, 'edit' => true]);
        } else {
            return "not found page will be added lately";
        }
    }

    public function updateClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|min:6',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return redirect('clients/add_client')
                ->withErrors($validator)
                ->withInput();
        }

        $data['id'] = $request->get('id');
        $data['fullname'] = $request->get('name');
        $data['email'] = $request->get('email');
        $data['phone'] = $request->get('phone');
        $data['password'] = $request->get('password');

        $isUpdated = UsersLibrary::updateUser(ClientsRepository::CLIENT_REFERENCE, $data);
        if ($isUpdated) {
            return redirect('clients');
        }
    }

    public function map()
    {
        $drivers = DriversRepository::getDriversWithLocations();
        $online_drivers = array();
        $offline_drivers = array();
        $busy_drivers = array();
        foreach ($drivers as $value) {
            if (isset($value['isOnTrip']) && $value['isOnTrip'] == false && isset($value['isOnline']) && $value['isOnline'] == false) {
                $offline_drivers[] = $value;
            } elseif (isset($value['isOnTrip']) && $value['isOnTrip'] == true && isset($value['isOnline']) && $value['isOnline'] == false) {
                $busy_drivers[] = $value;
            } elseif (isset($value['isOnTrip']) && $value['isOnTrip'] == false && isset($value['isOnline']) && $value['isOnline'] == true) {
                $online_drivers[] = $value;
            }
        }
        if (Session::get('user')['isHotel'] == true &&Session::get('user')['isAdmin'] == false && !empty(Session::get('user')) && isset(Session::get('user')['userID'])) {
            $offline_drivers = 0;
            $busy_drivers = 0;
        }

        return view('maps.make_request', compact('online_drivers', 'offline_drivers', 'busy_drivers'));
    }

    public function filterMap($id)
    {
        $drivers = DriversRepository::getDriversWithLocations();
        $online_drivers = array();
        $offline_drivers = array();
        $busy_drivers = array();
        foreach ($drivers as $value) {
            if (isset($value['isOnTrip']) && $value['isOnTrip'] == false && isset($value['isOnline']) && $value['isOnline'] == false) {
                $offline_drivers[] = $value;
            } elseif (isset($value['isOnTrip']) && $value['isOnTrip'] == true && isset($value['isOnline']) && $value['isOnline'] == false) {
                $busy_drivers[] = $value;
            } elseif (isset($value['isOnTrip']) && $value['isOnTrip'] == false && isset($value['isOnline']) && $value['isOnline'] == true) {
                $online_drivers[] = $value;
            }
        }
        if ($id == 1) {
            $offline_drivers = null;
            $busy_drivers = null;
        } elseif ($id == 2) {
            $online_drivers = null;
            $busy_drivers = null;
        } elseif ($id == 3) {
            $offline_drivers = null;
            $online_drivers = null;
        }
        return view('maps.mapDiv', compact('online_drivers', 'offline_drivers', 'busy_drivers'));
    }


    public function deleteClient(Request $request)
    {
        $id = $request->get("id");
        ClientsLibrary::deleteClient($id);
    }


    public function updateClientBlockStatus($id)
    {
        ClientsLibrary::updateClientBlockStatus($id);

        return redirect()->back();
    }

    public function clientRequestsDatatable(Request $request)
    {
        // $requestsType = $request->get('requestsType');

        // // $customerId = 'from auth';
        // $customerId = '2Y4aY2hBwUhga3Zvjm8a0DQIATH2';
        // $requestsType == ClientsRepository::HISTORY_TYPE)? ClientsRepository::HISTORY_TYPE: ClientsRepository::ACTIVE_TYPE;

        // $clientRequests = ClientsRepository::getClientRequests($customerId, $requestsType)

        // return Datatables::of($clientRequests) 
        //     ->addColumn('destination', function ($request) {
        //         $addressDestination = !isset($request->addressDestination)? 'unspecified': $request->addressDestination;
        //         return $addressDestination;
        //     })
        //     ->addColumn('pickup', function ($client) {
        //         $addressPickup = !isset($client->addressPickup)? 'unspecified': $client->addressPickup;
        //         return $addressPickup;
        //     })
        //     ->addColumn('carModel', function ($client) {
        //         $driverCarModel = !isset($client->driverCarModel)? 'unspecified': $client->driverCarModel;
        //         return $driverCarModel;
        //     })
        //     ->addColumn('driverName', function ($client) {
        //         $driverName = !isset($client->driverName)? 'unspecified': $client->driverName;
        //         return $driverName;
        //     })
        //     ->addColumn('requestTime', function ($request) {
        //         $requestTime = !isset($request->requestTime)? 'unspecified': date("d-m-Y H:i:s", $request->requestTime/1000);
        //         return $requestTime;
        //     })
        //     ->addColumn('onTrip', function ($client) {
        //         if (!isset($client->onTrip)) {
        //             $onTrip = 'unspecified';
        //         } else if($client->onTrip) {
        //             $onTrip = 'Yes';
        //         } else {
        //             $onTrip = 'No';
        //         }
        //         return $onTrip;
        //     })
        //     ->make(true);
    }
}
