<?php
	$db_user="user";
	$db_pass="pass";
	$db_name="dbname";
	$puissance=0;
	define("CAN_LOG", $puissance); $puissance++;
	
	/** CAN_ USER **/
	define("CAN_CREATE_SUBACCOUNT", $puissance); $puissance++;
	define("CAN_CREATE_ACTIVITIES", $puissance); $puissance++;
	define("CAN_JOIN_ACTIVITIES", $puissance); $puissance++;
	define("CAN_PAY", $puissance); $puissance++;
	$puissance_max=$puissance;
	/**
		TODO : A FAIRE
	**/
	
	/** CAN_ STAFF **/
	$puissance=1;
	define("CAN_CREATE_ACCOUNT_STAFF", $puissance); $puissance++;
	define("CAN_EDIT_ACCOUNT_STAFF", $puissance); $puissance++;
	define("CAN_EDIT_RESTAURANT_STAFF", $puissance); $puissance++;
	define("CAN_ADD_RESTAURANT_STAFF", $puissance); $puissance++;
	
	if ($puissance_max>$puissance)
		$puissance=$puissance_max;
?>