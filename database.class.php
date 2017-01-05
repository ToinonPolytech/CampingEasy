<?php
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
		function select($name_table, $array){
			$request="SELECT * FROM ".$name_table." WHERE ";
			foreach ($array as $key => $value)
			{
				if (strstr($request, "WHERE"))
					$request.=" AND ";
				
				$request.=$key."=:".$key;
			}
			$this->_objectRequest=$db->prepare($request);
			$this->_objectRequest->execute($array);
		}
		function fetch(){
			return $this->_objectRequest->fetch();
		}
	}
?>