<?php

namespace model;

class LoginDAL
{
 	private static $tableName = "member";
	
	private $mysqli;
	private $con;
	
	public function __construct() {

		$this->con = mysqli_connect("register-185594.mysql.binero.se", "185594_zh40528", "lolipoP19", "185594-register");
		
		$this->createTable();
	}
	
	public function createTable()
	{
		$sql ="CREATE TABLE IF NOT EXISTS ".self::$tableName."
		(
			pk INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			user VARCHAR(25),
			password VARCHAR(20)		
		)
		ENGINE = MyISAM;";
		
		if ($this->con->query($sql) === FALSE) {
          throw new \Exception("'$sql' failed " . $this->con->error);
      	}
	}
	
	public function addMember(member $member)
	{
		$name = $member->getName();
		$pnr = $member ->getPersonalNr();		
		$address = $member->getAddres();
		$phnr = $member->getPhoneNr();
		$email = $member->getEmail();		
		$class = $member->getClass();
		$paydate = $member->getPayDate();
		$username = $member->getUserName();

				$sql = "INSERT INTO ".self::$tableName."
			(
				Namn,
				Personnummer,
				Klass,
				Telefonnummer,
				Epostadress,
				Adress,
				Betalat_till,
				Anvnamn
				
			)
			VALUES ('$name','$pnr','$class','$phnr','$email','$address','$paydate','$username');";
			
			$stmt = $this->con->prepare($sql);
			//$stmt->bind_param("sssssss",$name,$pnr,$class,$phnr,$email,$address,$paydate);
			$stmt->execute();
				
			
    }
	
	public function getMembers()
	{
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName);
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			  array_push($array,$row['Personnummer']);
			  array_push($array,$row['Namn']);
			  array_push($array,$row['Klass']);
			  array_push($array,$row['Adress']);
			  array_push($array,$row['Epostadress']);
			  array_push($array,$row['Telefonnummer']);
			  array_push($array,$row['Betalat_till']);
		  }
		  
		/**for($i = 0; $i<count($array); $i++){
			$members = array();
			
			array_push($members, $array[$i]);
		}*/
	  	return $array;
	  	
		mysqli_close($this->con);
	}
}}