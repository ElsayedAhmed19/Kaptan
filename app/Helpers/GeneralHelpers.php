<?php

namespace App\Helpers;

class GeneralHelpers
{
	public static function prepareDataToDatatable($nestedArray)
	{
        $preparedData = null;
        foreach ($nestedArray as $key => $element) {
            $element['id'] = $key;
            $preparedData [] = (object) $element;
        }
		return $preparedData;
	}

	public static function prepareHistoryDataDatatable($nestedArray)
	{
        $preparedData = null;
        foreach ($nestedArray as $key => $elements) {
        	foreach ($elements as $key => $element) {
        		$element['id'] = $key;
            	$preparedData [] = (object) $element;
        	}
        }
		
		return $preparedData;
	}
}