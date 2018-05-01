<?php

namespace App\Helpers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class FirebaseHelper
{
	public $database;
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

    public function insert($reference, $data)
    {
    	$key = null;
    	if (!empty($data)) {
	    	$node = $this->database->getReference($reference)
		   		->push($data);
	   		$key = $node->getKey();;
    	}
    	return $key;
    }

    public function set($reference, $data)
    {
        $isSet = false;
        if (!empty($data)) {
            $this->database->getReference($reference."/".$data['id'])
                ->set($data);
            $isSet = true;
        }
        return $isSet;
    }

    public function get($reference)
    {
    	$data = $this->database->getReference($reference);
    	$snapshot = $data->getSnapshot();

        return $snapshot->getValue();
    }

    public function queryBuilder($reference)
    {
        $query = $this->database->getReference($reference);

        return $query;
    }

    public function update($reference, $data)
    {
        $isSet = false;
        if (!empty($data)) {
            $this->database->getReference($reference."/".$data['id'])
                ->update($data);
            $isSet = true;
        }
        return $isSet;
    }


    public function remove($reference)
    {
        $this->database->getReference($reference)
            ->remove();
    }
}
