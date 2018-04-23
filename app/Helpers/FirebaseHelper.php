<?php

namespace App\Helpers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class FirebaseHelper
{
	protected $database;
    public $auth;
	public function __construct()
	{
		$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/driveme-73fd6-firebase-adminsdk-9j0rm-c464b41e3c.json');
		$firebase = (new Factory)
		    ->withServiceAccount($serviceAccount)
		    ->create();

	    $this->database = $firebase->getDatabase();

        $this->auth = $firebase->getAuth();
    }

    public function insert($reference, $data = [])
    {
    	$isInserted = false;
    	if (!empty($data)) {
	    	$this->database->getReference($reference)
		   		->push($data);
	   		$isInserted = true;
    	}
    	return $isInserted;
    }

    public function get($reference)
    {
    	$data = $this->database->getReference($reference);
    	$snapshot = $data->getSnapshot();

        return $snapshot->getValue();
    }
}
