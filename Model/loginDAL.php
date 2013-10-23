<?php

namespace model;

class LoginDAL
{
 	private static $tableName = "member";
	
	private $mysqli;
	private $con;
	
	public function __construct() {

		$this->con = mysqli_connect("localhost", "185594_zh40528", "lolipoP19", "185594-register");
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
	
	public function addUser(user $user)
	{
		$sql = "INSERT INTO ". self::$tableName."
		(
			Name,
			Personalnr,
			Class,
			Phonenr,
			Emailaddress,
			Address,
			Payed_until
			
		)
		VALUES(?,?,?,?,?,?,?)";
		
		$stmt = $this->con->prepare($sql);
		var_dump($stmt);
		
		$name = $user->getName();
		$pnr = $user ->getPersonalNr();		
		$address = $user->getAddres();
		$phnr = $user->getPhoneNr();
		$email = $user->getEmail();		
		$class = $user->getClass();
		$paydate = $user->getPayDate();
		
		
		$stmt->bind_param("sssssss",$name,$pnr,$class,$phnr,$email,$address,$paydate);
		$stmt->execute();
		mysqli_close($this->con);
    }
	
	public function getUsers()
	{
		
		// Check connection
		if (mysqli_connect_errno())
		  {
		  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		
		$result = mysqli_query($this->con,"SELECT * FROM member;");
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			array_push($array,$row);
		  }
		  
	  	return $array;
		mysqli_close($this->con);
	}
}