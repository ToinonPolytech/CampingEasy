<?php
	/**
	TO DO : 
		- Sécurité sur le nom des tables/valeurs update et select
		- Sécurité sur les variables en argument (forcer les types)
	**/
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
		function request($request, $array_where){
			if (!empty($array_where) && !is_array($array_where))
				return;
			
			foreach ($array_where as $key => $value)
			{
				if (strstr($request, "WHERE"))
					$request.=" AND ";
				else
					$request.=" WHERE ";
				
				$request.=$key."=:".$key;
			}
			$this->_objectRequest=$db->prepare($request);
			$this->_objectRequest->execute($array_where);
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
			$request.=" FROM ".$name_table;
			$this->request($request, $array_where);
		}
		function delete($name_table, $array_where){
			$request="DELETE FROM ".$name_table;
			$this->request($request, $array_where);
		}
		function update($name_table, $array_where, $array_update){
			if (!is_array($array_update)) // On ne peut gérer que des tableaux pour la sécurité en PDO.
				return;
			
			foreach ($array_update as $key => $value)
			{
				if (!isset($request))
					$request="UPDATE ".$name_table." SET ".$key."=:".$key;
				else
					$request.=",".$key."=:".$key;
			}
			$this->request($request, $array_where);
		}
		function fetch(){
			return $this->_objectRequest->fetch();
		}
	}
?>