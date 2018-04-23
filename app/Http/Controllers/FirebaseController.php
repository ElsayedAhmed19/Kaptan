<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\Helpers\FirebaseHelper;
use Illuminate\Http\Request;
use App\Repositories\DriverRepository;

class FirebaseController extends Controller
{
	function insertDriver(Request $request)
	{

	}
    public function index()
    {
    	DriverRepository::getDrivers();
    	// DriverRepository::insertDriver(["ssds"=>'fdf5dd']);
    }
}
