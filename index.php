<?php
require_once('tiket_api_class.php');

$obj = new TiketAPI();

try{
	
	$result = $obj->tiketRegisterUser('xxxtokenxxx', 'M Teguh', 'A Suandi', 'mail@domain.com', 'password', 'password', 'id');
}catch(Exception $e){
	
	echo $e->getMessage();
}

var_dump($result);