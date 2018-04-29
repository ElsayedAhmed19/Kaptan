<?php

namespace App\Libraries;
use App\Repositories\NotificationsRepository;

class RequestsLibrary
{
	public static function insertNotification($data)
	{
		$notificationData = [
			'messageId' => $data['id'],
			'messageText' => "New Request",
			'messageTime' => microtime(),
			'messageUser' => $data['customerName'],
			'messageUserId' => $data['customerID'],	
			'messageUserToken' => $data['driverToken']
		];


		$isInserted = NotificationsRepository::insertNotification($notificationData);

		dd($isInserted);
	}
}