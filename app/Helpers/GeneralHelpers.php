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

    static function calcDistance($startlat, $startlong, $tarlat, $tarlong)
    {
        $R               = 6378137; // Earths mean radius in meter Contstant Of Havresin Formula
        $dLat            = self::rad ( $tarlat - $startlat );
        $dLong           = self::rad ( $tarlong - $startlong );
        $a               = sin ( $dLat / 2 ) * sin ( $dLat / 2 ) +
                           cos ( self::rad ( $startlat ) ) * cos ( self::rad ( $tarlat ) ) *
                           sin ( $dLong / 2 ) * sin ( $dLong / 2 );
        $c               = 2 * atan2 ( sqrt ( $a ), sqrt ( 1 - $a ) );

        $d = $R * $c;  // the distance in M   
        return sprintf("%.2f", $d);
    }

    static function rad($x)
    {
        return $x * pi() /180;
    }
}