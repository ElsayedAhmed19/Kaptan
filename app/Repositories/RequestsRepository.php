<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;
use App\References\References;
class RequestsRepository
{
	public static function getRequests($requestsPath)
	{
		$helper = new FirebaseHelper;
		$data = $helper->get($requestsPath);

		return $data;
	}
}