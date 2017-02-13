<?php
	/**
	TO DO : 
		- Sécurité sur le nom des tables/valeurs update et select
		- Sécurité sur les variables en argument (forcer les types)
	**/
	require_once("config.php");
	
	class Database{
		private $_db;
		private $_objectRequest;
		public function __construct(){
			try
			{
				// On se connecte à MySQL
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$this->_db = new PDO('mysql:host=localhost;dbname=campingeasy', 'root', '', $pdo_options);
			}
			catch(Exception $t)
			{
				// En cas d'erreur précédemment, on affiche un message et on arrête tout
				die('Erreur : '.$t->getMessage().' Numéro : '.$t->getCode());
			}
		}
		public function request($request, $array_where, $array_update=NULL){
			if (!empty($array_where) && !is_array($array_where))
			{
				$this->_objectRequest=$this->_db->query($request);
				return;
			}
				
			
			$array_where2=array();
			foreach ($array_where as $key => $value)
			{
				if (strstr($request, "WHERE"))
					$request.=" AND ";
				else
					$request.=" WHERE ";
				
				if ($value==NULL)
					$request.=$key." IS NULL";
				else
				{
					$request.=$key."=:".$key;
					$array_where2[$key]=$value;
				}
			}
			if ($array_update!=NULL)
			{
				$array_where2=array_merge($array_where2, $array_update);
			}
			$this->_objectRequest=$this->_db->prepare($request);
			$this->_objectRequest->execute($array_where2);
		}
		public function getValue($name_table, $array_where, $colonne){
			$request="SELECT ".$colonne." FROM ".$name_table;
			foreach ($array_where as $key => $value)
			{
				if (strstr($request, "WHERE"))
					$request.=" AND ";
				else
					$request.=" WHERE ";
				
				$request.=$key."=:".$key;
			}
			$this->_objectRequest=$this->_db->prepare($request);
			$this->_objectRequest->execute($array_where);
			$data=$this->fetch();
			return $data[$colonne];
		}
		public function select($name_table, $array_where, $array_select="*"){
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
		public function delete($name_table, $array_where){
			$request="DELETE FROM ".$name_table;
			$this->request($request, $array_where);
		}
		public function update($name_table, $array_where, $array_update){
			if (!is_array($array_update)) // On ne peut gérer que des tableaux pour la sécurité en PDO.
				return;
			
			foreach ($array_update as $key => $value)
			{
				if (!isset($request))
					$request="UPDATE ".$name_table." SET ".$key."=:".$key;
				else
					$request.=",".$key."=:".$key;
			}
			$this->request($request, $array_where, $array_update);
		}
		public function create($name_table, $array_create){
			foreach ($array_create as $key => $value)
			{
				if (!isset($request))
					$request="INSERT INTO ".$name_table." (".$key;
				else
					$request.=",".$key;
			}
			foreach ($array_create as $key => $value)
			{
				if (!strstr($request, "VALUES"))
					$request.=") VALUES (:".$key;
				else
					$request.=",:".$key;
			}
			$request.=")";
			$this->_objectRequest=$this->_db->prepare($request);
			$this->_objectRequest->execute($array_create);
		}
		public function fetch(){
			return $this->_objectRequest->fetch();
		}
		public function count($name_table, $array_where){
			$request="SELECT COUNT(*) FROM ".$name_table;
			$this->request($request, $array_where);
			return $this->_objectRequest->fetchColumn();
		}
	}
?>