<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;
use Kreait\Firebase;

class NotificationsRepository
{
	const NOTIFICATIONS_REFERENCE = 'notifications';

	const NOTIFICATION_COLUMNS = [
		'messageId' => null,
		'messageText' => null,
		'messageTime' => null,
		'messageUser' => null,
		'messageUserId' => null,	
		'messageUserToken' => null
	];

	public static function insertNotification($data)
	{
		$firebaseHelper = new FirebaseHelper();
		$isInserted = $firebaseHelper->insert(self::NOTIFICATIONS_REFERENCE, $data);

		return $isInserted;
	}
}
