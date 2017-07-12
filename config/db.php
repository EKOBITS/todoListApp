<?php

/**
 * 
 */
 class db
 {
 	private $host = "localhost";
 	private $user = "phpmyadmin"; // your user = root
 	private $pswd = "password"; // ""
 	private $dbName = "todoApp";

 	function __construct()
 	{
 		# code... ;
 	}

/**
 Using PDO to connect to our Database.
 we have basically two ways
 1. Mysqli => a). OOP way b). Procedural
 2. PHP Data Object (PDO)
*/
 	function connect() {
 		$con_str = "mysql:host=$this->host;dbname=$this->dbName";
 		
 		try {
 			$conn = new PDO($con_str, $this->user, $this->pswd);
 			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 		} catch(PDOException $ex) {
 			echo "Error: ".$ex->getMessage();
 		}

 		return $conn;
 	}


 	
 } 