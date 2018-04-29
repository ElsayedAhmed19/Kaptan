<?php

namespace App\Libraries;

use App\Helpers\FirebaseHelper;
use App\Repositories\RequestsRepository;
use App\Helpers\GeneralHelpers;
use App\Repositories\ClientsRepository;
use Datatables;
class ClientsLibrary
{
	protected $clientsRepo;

	function __construct()
	{
		$this->clientsRepo = new ClientsRepository;
	}

    public static function deleteClient($id)
    {
    	$firebaseHelper = new FirebaseHelper();
    	$user = $firebaseHelper->auth->getUser($id);
    	if ($user) {
	     	$firebaseHelper->auth->deleteUser($id);
		}
		$client = $firebaseHelper->get(ClientsRepository::CLIENT_REFERENCE, $id);
		if ($client) {
			$firebaseHelper->remove(ClientsRepository::CLIENT_REFERENCE."/".$id);
		}
    }

    public static function updateClientBlockStatus($id)
    {
    	$firebaseHelper = new FirebaseHelper();

		$client = clientsRepository::getCustomer($id);

		if ($client) {
			if ($client['blocked'] == true) {
				$blocked = false;
			} else {
				$blocked = true;
			}
			$firebaseHelper->update(ClientsRepository::CLIENT_REFERENCE, ['id'=>$id, 'blocked'=>$blocked]);
		}
    }
}