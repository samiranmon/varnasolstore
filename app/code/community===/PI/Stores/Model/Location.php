<?php

class PI_Stores_Model_Location extends Varien_Object
{
   
	public function getLatLongArray($_Country, $_Zip ,$_City,$Address1)
		{
		$Address =  str_replace(" ","+",trim($Address1));
		$address = $Address."+".$_City."+".$_Country."+".$_Zip;
		$_CountryName = Mage::app()->getLocale()->getCountryTranslation($_Country);

	  $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&Region='$_Country'";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		curl_close($ch);
		$response_a = json_decode($response);
		//print_r($response_a); return;
			
		if(!empty($response_a->results))
		{
				$lat = $response_a->results[0]->geometry->location->lat;
				$long = $response_a->results[0]->geometry->location->lng;
		}
		else
		{
				$lat = null;
				$long =null;
		}
		
		return array(
			'latitude'	=> $lat,
			'longitude'	=> $long,
		);
	}
    

}
