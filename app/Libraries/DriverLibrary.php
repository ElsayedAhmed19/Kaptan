<?php

namespace App\Libraries;

use App\Helpers\FirebaseHelper;
use App\Repositories\RequestsRepository;
use App\Helpers\GeneralHelpers;
use App\Repositories\DriversRepository;
use Datatables;
class DriversLibrary
{
	protected $driversRepo;

	function __construct()
	{
		$this->driversRepo = new DriversRepository;
	}

    public static function deleteDriver($id)
    {
    	$firebaseHelper = new FirebaseHelper();
    	$user = $firebaseHelper->auth->getUser($id);
    	if ($user) {
	     	$firebaseHelper->auth->deleteUser($id);
		}
		$driver = $firebaseHelper->get(DriversRepository::DRIVER_REFERENCE, $id);
		if ($driver) {
			$firebaseHelper->remove(DriversRepository::DRIVER_REFERENCE."/".$id);
		}
    }

    public static function updateDriverBlockStatus($id)
    {
    	$firebaseHelper = new FirebaseHelper();

		$driver = DriversRepository::getDriver($id);

		if ($driver) {
			if ($driver['blocked'] == true) {
				$blocked = false;
			} else {
				$blocked = true;
			}
			$firebaseHelper->update(DriversRepository::DRIVER_REFERENCE, ['id'=>$id, 'blocked'=>$blocked]);
		}
    }
}