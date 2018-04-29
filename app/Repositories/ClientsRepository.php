<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;
use App\References\References;
class ClientsRepository
{
	const ACTIVE_TYPE = 'active';
	const HISTORY_TYPE = 'history';

	const CLIENT_REFERENCE = 'users/customers';
	const CLIENT_ACTIVE_REQUESTS_REFERENCE = 'requests/active/customers';
	const CLIENT_HISTORY_REQUESTS_REFERENCE = 'requests/history/customers';

	public static function insertClient($data)
	{
		$helper = new FirebaseHelper;
		$isInserted = $helper->set(self::CLIENT_REFERENCE, $data);
		return $isInserted;;
	}

	public static function getClients()
	{
		$helper = new FirebaseHelper;
		$data = $helper->get(self::CLIENT_REFERENCE);

		return $data;
	}

	// public static function getClientRequests($customerId, $status)
	// {

	// 	$helper = new FirebaseHelper;
	// 	$data = $helper->get(self::CLIENT_REFERENCE."/".$customerId);

	// 	return $data;
	// }

	public static function getCustomer($customerId)
	{
		$helper = new FirebaseHelper;
		$data = $helper->get(self::CLIENT_REFERENCE."/".$customerId);

		return $data;
	}
}