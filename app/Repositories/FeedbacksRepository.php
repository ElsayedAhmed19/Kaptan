<?php

namespace App\Repositories;

use App\Helpers\FirebaseHelper;
use App\References\References;
use App\Libraries\UsersLibrary;

class FeedbacksRepository
{
    const CLIENT_FFEEDBACK_REFERENCE = 'feedback/customers';
    const DRIVER_FEEDBACK_REFERENCE = 'feedback/drivers';

    public static function getFeedbacks($refrenceType, $userId = null)
    {
        $helper = new FirebaseHelper;
        $userType = UsersLibrary::getUserType($userId);

        $data = $helper->get($refrenceType);

        return $data;
    }

    public static function getCustomer($customerId)
    {
        $helper = new FirebaseHelper;
        $data = $helper->get(self::CLIENT_REFERENCE . "/" . $customerId);

        return $data;
    }

    public static function getHotelCustomers($hotel_id)
    {
        $helper = new FirebaseHelper;
        $data = $helper->get(self::CLIENT_REFERENCE);
        $data_array = array();
        foreach ($data as $value) {
            if (isset($value['hotelID'])) {
                if ($value['hotelID'] == $hotel_id) {
                    $data_array[] = $value;
                }
            }
        }
//        dump($data_array);
//        die();
        return $data_array;
    }
}