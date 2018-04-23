<?php

namespace App\Libraries;

use App\Helpers\FirebaseHelper;
use App\Repositories\RequestsRepository;
use App\Helpers\GeneralHelpers;
use App\Helpers\DriversRepository;
use Datatables;
class DriversLibrary
{
	protected $driversRepo;

	function __construct()
	{
		$this->driversRepo = new DriversRepository;
	}

    function handleDriverInsert($data)
    {
        
    }
}