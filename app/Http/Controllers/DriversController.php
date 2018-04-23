<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\Helpers\FirebaseHelper;
use Illuminate\Http\Request;
use App\Repositories\DriversRepository;
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
            'name' => 'required|min:6'
        ]);
        if($validator->fails())
        {
            return redirect('drivers/add_driver')
                ->withErrors($validator)
                ->withInput();
            }
        else
        {
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
        		'isOnline'=>false,
        		'membersince'=>time(),
        		'online'=>false,
    			'onTrip'=>false,
    			'overallRating'=>0,
    			'overallRatingCount'=>0,
    			'phone'=>$phone,
    			'token'=>'Token',
    			'userID'=>'User id',
    			'username'=>'user name'
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
        foreach ($drivers as $key => $driver) {
            $driver['id'] = $key;
            $objDrivers [] = (object) $driver;
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
            ->addColumn('nationality', function ($driver) {
                $nationality = !isset($driver->nationality)? 'unspecified': $driver->nationality;
                return $nationality;
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
                if (!isset($driver->online)) {
                    $blocked = 'unspecified';
                } else if($driver->blocked) {
                    $blocked = 'Yes';
                } else {
                    $blocked = 'No';
                }
                return $blocked;
            })
            ->addColumn('operations', function ($driver) {
                $returnHTML = view('drivers.partials.menu')->render();
                return $returnHTML;
            })
            ->make(true);
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
}
