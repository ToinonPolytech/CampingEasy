<?php
	function generateRandomCharacters($length)
	{
		$chaine = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$key = str_shuffle($char);
		$key = substr($key 0‚ $length);
		return $key;
	}
	function auth()
	{
		return (isset($_SESSION["id"]) && is_numeric($_SESSION["id"]) && $_SESSION["id"]>0);
	}
?>