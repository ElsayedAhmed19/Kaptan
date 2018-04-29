<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\Helpers\FirebaseHelper;
use Illuminate\Http\Request;
use App\Repositories\DriversRepository;
use App\Repositories\UsersRepository;
use App\Libraries\UsersLibrary;
use App\Libraries\DriversLibrary;
use Datatables;
use Validator;

class DriversController extends Controller
{
    function signIn(Request $request)
    {
        $data = DriversRepository::getDriver($request->get('email'));
    }

	function insertDriver(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6',
            'email' => 'required|email',
            'carNumber' => 'required',
            'carModel' => 'required',
            'phone' => 'required',
            'phone' => 'required|numeric',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return redirect('drivers/add_driver')
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
    		$carModel = $request->get('carModel');
    		$carNumber = $request->get('carNumber');
    		$phone = $request->get('phone');
    		$password = $request->get('password');
        	$isInserted = DriversRepository::insertDriver([
        		'id' => $id,
                'admin'=>false,
        		'blocked'=>true,
        		'admin'=>false,
        		'carModel'=>$carModel,
        		'carNumber'=>$carNumber,
        		'deleted'=>false,
        		'email'=>$email,
        		'fullname'=>$name,
        		'carModel'=>$carModel,
        		'imageURL'=>'',
        		'isAdmin'=>false,
        		'online'=>false,
        		'membersince'=>time(),
        		'online'=>false,
                'onTrip'=>false,
    			'overallRating'=>0,
    			'overallRatingCount'=>0,
    			'phone'=>$phone,
    			'token'=>'Token',
    			'userID'=>$id,
    			'username'=>$name
        	]);
            if ($isInserted) {
                return redirect('drivers');	
            }
        }
    }
    public function allDrivers()
    {
        return view('drivers.all_drivers');
    }

    public function datatable()
    {
        $drivers = DriversRepository::getDrivers();
        $objDrivers = null;
        $i = 0;
        foreach ($drivers as $key => $driver) {
            if (is_array($driver)) {
                $driver['id'] = $key;
                $objDrivers [] = (object) $driver;    
            }            
        }

        return Datatables::of($objDrivers) 
            ->addColumn('fullname', function ($driver) {
                $fullname = !isset($driver->fullname)? 'unspecified': $driver->fullname;
                return $fullname;
            })
            ->addColumn('email', function ($driver) {
                $email = !isset($driver->email)? 'unspecified': $driver->email;
                return $email;
            })
            ->addColumn('phone', function ($driver) {
                $phone = !isset($driver->phone)? 'unspecified': $driver->phone;
                return $phone;
            })
            ->addColumn('onTrip', function ($driver) {
                if (!isset($driver->onTrip)) {
                    $onTrip = 'unspecified';
                } else if($driver->onTrip) {
                    $onTrip = 'Yes';
                } else {
                    $onTrip = 'No';
                }
                return $onTrip;
            })
            ->addColumn('online', function ($driver) {
                if (!isset($driver->online)) {
                    $online = 'unspecified';
                } else if($driver->online) {
                    $online = 'Yes';
                } else {
                    $online = 'No';
                }
                return $online;
            })
            ->addColumn('blocked', function ($driver) {
                if (!isset($driver->blocked)) {
                    $blocked = 'unspecified';
                } else if($driver->blocked == true) {
                    $blocked = 'Yes';
                } else {
                    $blocked = 'No';
                }
                return $blocked;
            })
            ->addColumn('operations', function ($driver) {
                $returnHTML = view('drivers.partials._menu')->with(['name'=>'Elsayed'])->render();
                return $returnHTML;
            })
            ->make(true);
    }

    public function map(){
        $drivers=DriversRepository::getDriversWithLocations();
        $online_drivers=array();
        $offline_drivers=array();
        $busy_drivers=array();

        foreach ($drivers as $value){
            if (isset($value['isOnTrip'])&&$value['isOnTrip']==false &&isset($value['isOnline'])&&$value['isOnline']==false){
                $offline_drivers[]=$value;
            }elseif(isset($value['isOnTrip'])&&$value['isOnTrip']==true &&isset($value['isOnline'])&&$value['isOnline']==false){
                $busy_drivers[]=$value;
            }elseif (isset($value['isOnTrip'])&&$value['isOnTrip']==false &&isset($value['isOnline'])&&$value['isOnline']==true){
                $online_drivers[]=$value;
            }
        }
//        dump($online_drivers);die();


        return view('maps.make_request',compact('online_drivers','offline_drivers','busy_drivers'));
    }
    public function getDriversToMap()
    {
        $returnedDrivers = [];
        $drivers = DriversRepository::getDriversWithLocations();
        foreach ($drivers as $key => $driver) {
            if(isset($driver['latitude'], $driver['longitude']) &&
                is_numeric($driver['latitude']) &&
                is_numeric($driver['longitude'])
            ) {
                $driver['id'] = $key;
                $returnedDrivers [] = $driver;
            }
        }
        return response()->json($returnedDrivers);
    }

    public function editDriver($id)
    {
        $driver = DriversRepository::getDriver($id);

        if ($driver) {
            return view('drivers.add_driver', ['driver'=>$driver, 'edit'=>true]);
        } else {
            return "not found page will be added lately";
        }
    }
    public function updateDriver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|min:6',
            'email' => 'required|email',
            'carNumber' => 'required',
            'carModel' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return redirect('drivers/add_driver')
                ->withErrors($validator)
                ->withInput();
        }

        $data['id'] = $request->get('id');
        $data['fullname'] = $request->get('name');
        $data['email'] = $request->get('email');
        $data['phone'] = $request->get('phone');
        $data['carModel'] = $request->get('carModel');
        $data['carNumber'] = $request->get('carNumber');
        $data['password'] = $request->get('password');

        $isUpdated = UsersLibrary::updateUser(DriversRepository::DRIVER_REFERENCE, $data);
        if ($isUpdated) {
            return redirect('drivers');
        }
    }

    public function deleteDriver(Request $request)
    {
        $id = $request->get("id");
        DriversLibrary::deleteDriver($id);
    }


    public function updateDriverBlockStatus($id)
    {
        DriversLibrary::updateDriverBlockStatus($id);

        return redirect()->back();
    }
}
