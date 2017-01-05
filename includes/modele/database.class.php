<?php
	require("config.php");
	class Database{
		private $_db;
		private $_objectRequest;
		function __construct() {
			try
			{
				// On se connecte à MySQL
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$this->_db = new PDO('mysql:host=localhost;dbname=name_db', 'user', 'password', $pdo_options);
			}
			catch(Exception $t)
			{
				// En cas d'erreur précédemment, on affiche un message et on arrête tout
				die('Erreur : '.$t->getMessage().' Numéro : '.$t->getCode());
			}
		}
		function select($name_table, $array_where, $array_select="*"){
			if (is_array($array_select))
			{
				foreach ($array_select as $value)
				{
					if (!isset($request))
						$request="SELECT ".$value;
					else
						$request.=",".$value;
				}
			}
			else if (!empty($array_select))
			{
				$request="SELECT ".$array_select;
			}
			else
			{
				$request="SELECT *";
			}
			$request.=" FROM ".$name_table." WHERE ";
			foreach ($array_where as $key => $value)
			{
				if (strstr($request, "WHERE"))
					$request.=" AND ";
				
				$request.=$key."=:".$key;
			}
			$this->_objectRequest=$db->prepare($request);
			$this->_objectRequest->execute($array_where);
		}
		function fetch(){
			return $this->_objectRequest->fetch();
		}
	}
?>