<?php
/**
 * Tiket API Class
 *
 * @author     M Teguh A Suandi
 * @link       http://mtasuandi.wordpress.com
 * @license    http://creativecommons.org/licenses/by/3.0/
 *
 */
require_once('tiket_api_request.php');

class TiketAPI{

	##############################################PRIVATE FUNCTION#############################################
		
	private function queryTiketToken($parameters){
		
		return tiket_token($parameters);
		
	}
	
	private function queryTiket($domain, $api_uri, $token, $parameters){
	
		return tiket_api_request($domain, $api_uri, $token, $parameters);
	}
	
	private function verifyResponse($response){
	
		if($response === False){
			
			throw new Exception("Coul not connect to Tiket.com");
		}else{
			
			return ($response);
		}
	}
	
	############################################PUBLIC FUNCTION################################################
	
	public function getTiketToken($key){
		
		$parameters = array("method"	=> "getToken",
							"secretkey"	=> $key);
		$json_response 	= $this->queryTiketToken($parameters);
		
		return $json_response;
	}
	
	public function renewTiketToken($key, $token){
		
		$parameters = array("method"	=> "getToken",
							"secretkey"	=> $key,
							"token"		=> $token);
		$json_response 	= $this->queryTiketToken($parameters);
		
		return $json_response;
	}
	
	###########################################################################################################
	
	# USER MANAGEMENT API
	
	public function tiketRegisterUser($token, $first_name, $last_name, $email, $password, $con_password, $country){
	
		$domain 	= "master18.tiket";
		$api_uri	= "auth/register";
		$token		= $token;
		$parameters = array("firstName"		=>	$first_name,
							"lastName"		=>	$last_name,
							"email"			=>	$email,
							"password"		=>	$password,
							"conPassword"	=>	$con_password,
							"country"		=> 	$country);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketLogin($token, $username, $password){
	
		$domain 	= "master18.tiket";
		$api_uri	= "auth/dologin";
		$token		= $token;
		$parameters = array("username"		=>	$username,
							"password"		=>	$password
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketProfile($token){
	
		$domain 	= "tiket";
		$api_uri	= "myaccount/profile";
		$token		= $token;
		$parameters = array();
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketUpdateProfile($token, $update, $salutation, $firstName, $lastName, $phone, $mobile, $gender, $birthDate, $IdCard, $passport){
	
		$domain 	= "master18.tiket";
		$api_uri	= "myaccount/profile";
		$token		= $token;
		$parameters = array("update"		=>	$update,
							"salutation"	=>	$salutation,
							"firstName"		=> 	$firstName,
							"lastName"		=>	$lastName,
							"phone"			=>	$phone,
							"mobile"		=>	$mobile,
							"gender"		=>	$gender,
							"birthDate"		=>	$birthDate,
							"IdCard"		=>	$IdCard,
							"passport"		=>	$passport
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketUpdateAddress($token, $updateAddress, $addressLabel, $address1, $address2, $postalCode, $country, $addressId){
	
		$domain 	= "master18.tiket";
		$api_uri	= "myaccount/profile";
		$token		= $token;
		$parameters = array("updateAddress"	=>	$updateAddress,
							"addressLabel"	=>	$addressLabel,
							"address1"		=> 	$address1,
							"address2"		=>	$address2,
							"postalCode"	=>	$postalCode,
							"country"		=>	$country,
							"addressId"		=>	$addressId
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketManageOrder($token){
	
		$domain 	= "master18.tiket";
		$api_uri	= "myaccount/orders";
		$token		= $token;
		$parameters = array();
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketPaidOrderDetail($token, $detailId){
	
		$domain 	= "master18.tiket";
		$api_uri	= "myaccount/myorder";
		$token		= $token;
		$parameters = array("detailId"		=> 	$detailId);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketSendVoucher($token, $type, $order_id, $order_detail_id, $order_hash){
	
		$domain 	= "master18.tiket";
		$api_uri	= "myaccount/resendVoucher";
		$token		= $token;
		$parameters = array("type"				=>	$type,
							"order_id"			=>	$order_id,
							"order_detail_id"	=>	$order_detail_id,
							"order_hash"		=>	$order_hash
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketPrintVoucher($token, $type, $order_id, $order_detail_id, $order_hash){
	
		$domain 	= "master18.tiket";
		$api_uri	= "myaccount/printVoucher";
		$token		= $token;
		$parameters = array("type"				=>	$type,
							"order_id"			=>	$order_id,
							"order_detail_id"	=>	$order_detail_id,
							"order_hash"		=>	$order_hash
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	# FLIGHT API
	
	public function tiketFlightSearch($token, $d, $a, $date, $ret_date, $adult, $child, $infant){
	
		$domain 	= "master18.tiket";
		$api_uri	= "search/flight";
		$token		= $token;
		$parameters = array("d"			=>	$d,
							"a"			=>	$a,
							"date"		=>	$date,
							"ret_date"	=>	$ret_date,
							"adult"		=>	$adult,
							"child"		=>	$child,
							"infant"	=>	$infant
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}	
	
	public function tiketFlightGetNearestAirportByIp($token, $ip){
		
		$domain 	= "master18.tiket";
		$api_uri	= "flight_api/getNearestAirport";
		$token		= $token;
		$parameters = array("ip"		=>	$ip
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketFlightGetNearestAirportByLatLong($token, $latitude, $longitude){
		
		$domain 	= "master18.tiket";
		$api_uri	= "flight_api/getNearestAirport";
		$token		= $token;
		$parameters = array("latitude"		=>	$latitude,
							"longitude"		=>	$longitude
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketFlightGetPopularAirportDestination($token, $depart){
		
		$domain 	= "master18.tiket";
		$api_uri	= "flight_api/getPopularDestination";
		$token		= $token;
		$parameters = array("depart"		=>	$depart
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketFlightSearchAirport($token){
	
		$domain 	= "master18.tiket";
		$api_uri	= "flight_api/all_airport";
		$token		= $token;
		$parameters = array();
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketFlightCheckFlightUpdate($token, $d, $a, $date, $adult, $child, $infant, $time){
	
		$domain 	= "master18.tiket";
		$api_uri	= "ajax/mCheckFlightUpdate";
		$token		= $token;
		$parameters = array("d"			=>	$d,
							"a"			=>	$a,
							"date"		=>	$date,
							"adult"		=>	$adult,
							"child"		=>	$child,
							"infant"	=>	$infant,
							"time"		=>	$time
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketFlightGetLionCaptcha($token){
	
		$domain 	= "master18.tiket";
		$api_uri	= "flight_api/getLionCaptcha";
		$token		= $token;
		$parameters = array();
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketFlightAddOrderDomesticFlight($token, $lion, $batavia, $citilink, $flight_id, $ret_flight_id, $lioncaptcha, $lionsessionid, $child, $adult, $conSalutation, $conFirstName, $conLastName, $conPhone, $conEmailAddress, $firstnamea1, $lastnamea1, $ida1, $titlea1, $conOtherPhone, $titlec1, $firstnamec1, $lastnamec1, $birthdatec1, $idc1, $titlei1, $parenti1, $firstnamei1, $lastnamei1, $birthdatei1, $idii1){
	
		$domain 	= "master18.tiket";
		$api_uri	= "order/add/flight";
		$token		= $token;
		$parameters = array("lion"				=>	$lion,
							"batavia"			=>	$batavia,
							"citylink"			=>	$citylink,
							"flight_id"			=>	$flight_id,
							"ret_flight_id"		=>	$ret_flight_id,
							"lioncaptcha"		=>	$lioncaptcha,
							"lionsessionid"		=>	$lionsessionid,
							"child"				=>	$child,
							"adult"				=>	$adult,
							"conSalutation"		=>	$conSalutation,
							"conFirstName"		=>	$conFirstName,
							"conLastName"		=>	$conLastName,
							"conPhone"			=>	$conPhone,
							"conEmailAddress"	=>	$conEmailAddress,
							"firstnamea1"		=>	$firstnamea1,
							"lastnamea1"		=>	$lastnamea1,
							"ida1"				=>	$ida1,
							"titlea1"			=>	$titlea1,
							"conOtherPhone"		=>	$conOtherPhone,
							"titlec1"			=>	$titlec1,
							"firstnamec1"		=>	$firstnamec1,
							"lastnamec1"		=>	$lastnamec1,
							"birthdatec1"		=>	$birthdatec1,
							"idc1"				=>	$idc1,
							"titlei1"			=>	$titlei1,
							"parenti1"			=>	$parenti1,
							"firstnamei1"		=>	$firstnamei1,
							"lastnamei1"		=>	$lastnamei1,
							"birthdatei1"		=>	$birthdatei1,
							"idi1"				=>	$idi1
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketOrder($token){
	
		$domain 	= "master18.tiket";
		$api_uri	= "order";
		$token		= $token;
		$parameters = array();
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketFlightDeleteOrder($token, $detailorderid){
	
		$domain 	= "master18.tiket";
		$api_uri	= "order/delete_order";
		$token		= $token;
		$parameters = array("detail_order_id"	=> $detailorderid);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}	
	
	public function tiketCheckoutPageRequest($token){
	
		$domain 	= "master18.tiket";
		$api_uri	= "order/checkout/119978";
		$token		= $token;
		$parameters = array();
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketCheckoutLoginNonMember($token, $salutation, $firstName, $lastName, $emailAddress, $phone, $saveContinue){
	
		$domain 	= "master18.tiket";
		$api_uri	= "checkout/checkout_customer";
		$token		= $token;
		$parameters = array("salutation"	=>	$salutation,
							"firstName"		=>	$firstName,
							"lastName"		=>	$lastName,
							"emailAddress"	=>	$emailAddress,
							"phone"			=>	$phone,
							"saveContinue"	=>	$saveContinue
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketFlightCheckoutLoginMember($token, $username, $password, $flaglogin){
	
		$domain 	= "master18.tiket";
		$api_uri	= "checkout/checkout_customer";
		$token		= $token;
		$parameters = array("username"		=>	$username,
							"password"		=>	$password,
							"flaglogin"		=>	$flaglogin
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}

	public function tiketFlightAvailablePayment($token){
	
		$domain 	= "master18.tiket";
		$api_uri	= "checkout/checkout_payment";
		$token		= $token;
		$parameters = array();
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}	

	public function tiketFlightCheckoutPaymentBankTransfer($token, $btn_booking){
	
		$domain 	= "master18.tiket";
		$api_uri	= "checkout/checkout_payment/2";
		$token		= $token;
		$parameters = array("btn_booking"	=>	$btn_booking);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketFlightCheckoutPaymentKlikBCA($token, $user_bca){
	
		$domain 	= "master18.tiket";
		$api_uri	= "checkout/checkout_payment/3";
		$token		= $token;
		$parameters = array("user_bca"	=>	$user_bca);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}	
	
	public function tiketFlightConfirmPayment($token, $orderId, $hash, $bankName, $ownName, $total, $datepayment, $note){
	
		$domain 	= "master18.tiket";
		$api_uri	= "confirmpayment/save";
		$token		= $token;
		$parameters = array("orderId"		=>	$orderId,
							"hash"			=>	$hash,
							"bankName"		=>	$bankName,
							"ownName"		=>	$ownName,
							"total"			=>	$total,
							"datepayment"	=>	$datepayment,
							"note"			=>	$note
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	# HOTEL API
	
	public function tiketHotelSearch($token, $q, $startdate, $night, $enddate, $room, $adult, $child, $sort, $minprice, $maxprice, $minstar, $maxstar, $latitude, $longitude){
		
		$domain 	= "master18.tiket";
		$api_uri	= "search/hotel";
		$token		= $token;
		$parameters = array("q"					=>	$q,
							"startdate"			=>	$startdate,
							"night"				=>	$night,
							"enddate"			=>  $enddate,
							"room"				=>	$room,
							"adult"				=>	$adult,
							"child"				=>	$child,
							"sort"				=> 	$short,
							"minprice"			=> 	$minprice,
							"maxprice"			=> 	$maxprice,
							"minstar"			=> 	$minstar,
							"maxstar"			=>	$maxstar,
							"latitude"			=> 	$latitude,
							"longitude"			=>	$longitude
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketHotelSearchHotelPromo($token, $page, $startdate, $enddate){
	
		$domain 	= "master18.tiket";
		$api_uri	= "home/hotelDeals";
		$token		= $token;
		$parameters = array("page"				=>	$page,
							"startdate"			=>	$startdate,
							"enddate"			=>  $enddate
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketHotelSearchAutocomplete($token, $q){
		
		$domain 	= "master18.tiket";
		$api_uri	= "search/autocomplete/hotel";
		$token		= $token;
		$parameters = array("q"	=> $q);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketHotelViewDetailHotel($token, $startdate, $night, $enddate, $room, $adult, $child){
		
		$domain 	= "master18.tiket";
		$api_uri	= "the-101-legian";
		$token		= $token;
		$parameters = array("startdate"			=>	$startdate,
							"night"				=>	$night,
							"enddate"			=>  $enddate,
							"room"				=>	$room,
							"adult"				=>	$adult,
							"child"				=>	$child
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketHotelAddOrder($token, $startdate, $enddate, $night, $room, $adult, $child, $minstar, $minprice, $hotelname, $roomid, $haspromo){
		
		$domain 	= "master18.tiket";
		$api_uri	= "order/add/hotel";
		$token		= $token;
		$parameters = array("startdate"			=>	$startdate,
							"enddate"			=>  $enddate,
							"night"				=>	$night,
							"room"				=>	$room,
							"adult"				=>	$adult,
							"child"				=>	$child,
							"minstar"			=> 	$minstar,
							"minprice"			=> 	$minprice,
							"hotelname"			=> 	$hotelname,
							"room_id"			=>	$roomid,
							"hasPromo"			=>	$haspromo
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
	
	public function tiketHotelCheckoutCustomer($token, $salutation, $firstname, $lastname, $email, $phone, $consalutation, $confirstname, $conlastname, $conemail, $conphone, $detailid, $country){
		
		$domain 	= "master18.tiket";
		$api_uri	= "checkout/checkout_customer";
		$token		= $token;
		$parameters = array("salutation"		=>	$salutation,
							"firstName"			=>  $firstname,
							"lastName"			=>	$lastname,
							"emailAddress"		=>	$email,
							"phone"				=>	$phone,
							"conSalutation"		=>	$consalutation,
							"conFirstName"		=> 	$confirstname,
							"conLastName"		=> 	$conlastname,
							"conEmailAddress"	=> 	$conemail,
							"detailId"			=>	$detailid,
							"country"			=>	$country
							);
	
		$json_response 	= $this->queryTiket($domain, $api_uri, $token, $parameters);
		
		return $json_response;
	}
}
