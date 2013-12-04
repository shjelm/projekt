<?php

namespace model;

require_once realpath(dirname(__DIR__)).'/Model/member.php';
require_once realpath(dirname(__DIR__)).'/Model/simpleMember.php';

class LoginDAL
{
	/**
	 * @var string
	 */
 	private static $tableName = "member";
	
	/**
	 * @var mysqli
	 */
	private $con;
	
	public function __construct() {
		$this->createMemberTable();	
	}
	
	public function openCon()
	{		
		$this->con = mysqli_connect("register-185594.mysql.binero.se", "185594_zh40528", "lolipoP19", "185594-register");	
	}

	private function createMemberTable()
	{
		$this->openCon();
		$sql ="CREATE TABLE IF NOT EXISTS ".self::$tableName."
		(
			Fornamn VARCHAR(20) NOT NULL ,
			Efternamn VARCHAR(30) NOT NULL ,
	 		Personnummer VARCHAR(20) NOT NULL ,
			Klass VARCHAR(5) NOT NULL ,
	 		Telefonnummer VARCHAR(20) NOT NULL ,
	 		Epostadress VARCHAR(50) NOT NULL ,
	 		Adress VARCHAR(100) NOT NULL ,
	 		Betalat_till DATE,
	 		Anvnamn VARCHAR(10) NOT NULL ,
	 		Losenord VARCHAR(50) NOT NULL			
		);";
		
		if ($this->con->query($sql) === FALSE) {
          throw new \Exception("'$sql' failed " . $this->con->error);
      	}
	}
	
	/**
	 * @param /model/member
	 */
	public function addMember(member $member)
	{
		$this->openCon();
		$firstName = $member->getFirstName();
		$lastName = $member->getLastName();
		$pnr = $member ->getPersonalNr();		
		$address = $member->getAddres();
		$phnr = $member->getPhoneNr();
		$email = $member->getEmail();		
		$class = $member->getClass();
		$paydate = $member->getPayDate();
		$username = $member->getUserName();
		$password = $member->getPassword();		

		$sql = "INSERT INTO ".self::$tableName."
				(
					Fornamn,
					Efternamn,
					Personnummer,
					Klass,
					Telefonnummer,
					Epostadress,
					Adress,
					Betalat_till,
					Anvnamn,
					Losenord
					
				)
				VALUES (?,?,?,?,?,?,?,?,?,?);";
				
		$stmt = $this->con->prepare($sql);
		
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ssssssssss", $firstName,$lastName,$pnr,$class,$phnr,$email,$address,$paydate,$username,$password);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}			
			
		$stmt->close();
	  	
		mysqli_close($this->con);
    }
	
	/**
	 * @param string
	 * @return array
	 */
	public function getMembers()
	{
		$sql = "SELECT Fornamn, Efternamn, Personnummer, Klass, Telefonnummer, Epostadress, Adress, Betalat_till 
				FROM ".self::$tableName." 
				ORDER BY Personnummer DESC";
				
		$stmt = $this->con->prepare($sql);
		
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($firstName, $lastName, $personalnr, $class, $phonenr, $email, $address, $paydate);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		 
		while($stmt->fetch()) {
			$array[] = new member($firstName, $lastName, $personalnr, $class, $phonenr, $email, $address, $paydate);
		}
		
		$stmt->close();
		  
	  	return $array;
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getNumberOfMembers()
	{
		$sql = "SELECT Personnummer FROM ".self::$tableName;
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($pnr);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		
		while($stmt->fetch()) {
			$array[] = $pnr;
		}
		 
		$stmt->close();
	  	
	  	return count($array);
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @param string
	 * @return array
	 */
	public function getMembersSimple()
	{
		$sql = "SELECT Fornamn, Efternamn, Klass, Epostadress 
				FROM ".self::$tableName." 
				ORDER BY Efternamn ASC";
				
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($firstName, $lastName, $class, $email);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		
		while($stmt->fetch()) {
			$array[] = new SimpleMember($firstName, $lastName, $class, $email);
		}
		
	  	$stmt->close();
	  	
	  	return $array;
	  	
		mysqli_close($this->con);
	}
	
	
	/**
	 * @param string
	 * @return array
	 */
	public function getMemberToShow($pnr)
	{
		$sql = "SELECT Personnummer 
				FROM ".self::$tableName;
				
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($pnrFromDb);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		
		while($stmt->fetch()) {
			$array[] = $pnrFromDb;
		}
		for ($i=0; $i <count($array) ; $i++) {
			  if($pnr == $array[$i]){
			  	return $array[$i];
			  }
		  }
		
	  	$stmt->close();
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @param string
	 * @return array
	 */
	public function getUserToShow($username)
	{
		$result = mysqli_query($this->con,"SELECT Anvnamn FROM ".self::$tableName);
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			  array_push($array,$row['Anvnamn']);
		  }
	  	for ($i=0; $i <count($array) ; $i++) {
			  if($username == $array[$i]){
			  	return $array[$i];
			  }
		  }
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @param string
	 * @return array
	 */
	public function getUserInfo($username)
	{
		$sql = "SELECT Fornamn, Efternamn, Personnummer, Klass, Telefonnummer, Epostadress, Adress, Betalat_till 
				FROM ".self::$tableName." 
				WHERE Anvnamn = ?";
				
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("s", $username);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($firstName, $lastName, $personalNr, $class, $phoneNr, $email, $address, $paydate);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		
		while($stmt->fetch()) {
			$array[] = new member($firstName, $lastName, $personalNr, $class, $phoneNr, $email, $address, $paydate);
		}
		 
		$stmt->close();
	  	
	  	return $array;
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @param string
	 * @return array
	 */
	public function getMember($pnr)
	{
		$sql = "SELECT Fornamn, Efternamn, Personnummer, Klass, Telefonnummer, 
				Epostadress, Adress, Betalat_till 
				FROM ".self::$tableName." 
				WHERE Personnummer = ?";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("s", $pnr);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($firstName, $lastName, $personalNr, $class, $phoneNr, $email, $address, $paydate);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		
		while($stmt->fetch()) {
			$array[] = new member($firstName, $lastName, $personalNr, $class, $phoneNr, $email, $address, $paydate);
		}
		 
		$stmt->close();
	  	
	  	return $array;
	  	
		mysqli_close($this->con);		
	}
	
	/**
	 * @return array
	 */
	public function getUserName()
	{
		$sql = "SELECT Anvnamn FROM ".self::$tableName.";";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($userName);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		
		while($stmt->fetch()) {
			$array[] = $userName;
		}
		 
		$stmt->close();
	  	
	  	return $array;
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @param string
	 * @return array
	 */
	public function getPassword($username)
	{
		$sql = "SELECT Losenord 
				FROM ".self::$tableName." 
				WHERE Anvnamn = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("s", $username);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($password);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		
		while($stmt->fetch()) {
			$array[] = $password;
		}
		 
		$stmt->close();
	  	
	  	return $array;
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getPayingMembers()
	{
		$today = date('Y-m-d');
		
		$sql = "SELECT Fornamn, Efternamn, Personnummer, Klass, Telefonnummer, 
				Epostadress, Adress, Betalat_till 
				FROM ".self::$tableName." 
				WHERE Betalat_till >= ? 
				ORDER BY Personnummer DESC ;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("s", $today);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($firstName, $lastName, $personalnr, $class, $phonenr, $email, $address, $paydate);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		 
		while($stmt->fetch()) {
			$array[] = new member($firstName, $lastName, $personalnr, $class, $phonenr, $email, $address, $paydate);
		}
		
		$stmt->close();
		
	  	return $array;
		
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getNotPayingMembers()
	{
		$today = date('Y-m-d');
		
		$sql = "SELECT Fornamn, Efternamn, Personnummer, Klass, Telefonnummer, 
				Epostadress, Adress, Betalat_till 
				FROM ".self::$tableName." 
				WHERE Betalat_till < ? 
				ORDER BY Personnummer DESC ;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("s", $today);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($firstName, $lastName, $personalnr, $class, $phonenr, $email, $address, $paydate);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		 
		while($stmt->fetch()) {
			$array[] = new member($firstName, $lastName, $personalnr, $class, $phonenr, $email, $address, $paydate);
		}
		
		$stmt->close();
		
	  	return $array;
		
		mysqli_close($this->con);
	}
	
	/**
	 * @param string
	 * @param string
	 */
	public function updatePassword($username, $newpassword)
	{
		$this->openCon();
		$sql = "UPDATE ".self::$tableName." 
				SET Losenord = ? 
				WHERE Anvnamn = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $newpassword,$username);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$stmt->close();
		
		mysqli_close($this->con);
	}
	
	/**
	 * @param string
	 * @param string
	 */
	public function updateFirstNameMember($pnr, $firstName)
	{
		$this->openCon();			
		$sql = "UPDATE ".self::$tableName." 
				SET Fornamn = ? 
				WHERE Personnummer = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $firstName, $pnr);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$stmt->close();
		
		mysqli_close($this->con);				
	}

	/**
	 * @param string
	 * @param string
	 */
	public function updateLastNameMember($pnr, $lastName)
	{
		$this->openCon();
		$sql = "UPDATE ".self::$tableName." 
				SET Efternamn = ? 
				WHERE Personnummer = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $lastName, $pnr);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$stmt->close();
		
		mysqli_close($this->con);			
	}
	
	/**
	 * @param string
	 * @param string
	 */
	public function updateAddressMember($pnr, $address)
	{
		$this->openCon();	
		$sql = "UPDATE ".self::$tableName." 
				SET Adress = ? 
				WHERE Personnummer = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $address, $pnr);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$stmt->close();
		
		mysqli_close($this->con);				
	}
	
	/**
	 * @param string
	 * @param string
	 */
	public function updateEmailMember($pnr, $email)
	{
		$this->openCon();		
		$sql = "UPDATE ".self::$tableName." 
				SET Epostadress = ? 
				WHERE Personnummer = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $email, $pnr);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$stmt->close();
		
		mysqli_close($this->con);				
	}
	
	/**
	 * @param string
	 * @param string
	 */
	public function updatePhonenrMember($pnr, $phonenr)
	{
		$this->openCon();	
		$sql = "UPDATE ".self::$tableName." 
				SET Telefonnummer = ? 
				WHERE Personnummer = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $phonenr, $pnr);
        if ($result == FALSE) {
            throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$stmt->close();
		
		mysqli_close($this->con);						
	}
	
	/**
	 * @param string
	 * @param string
	 */
	public function updateClassMember($pnr, $class)
	{
		$this->openCon();	
		$sql = "UPDATE ".self::$tableName." 
				SET Klass = ? 
				WHERE Personnummer = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $class, $pnr);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$stmt->close();
		
		mysqli_close($this->con);						
	}
	
	/**
	 * @param string
	 * @param string
	 */
	public function updatePaydateMember($pnr, $paydate)
	{
		$this->openCon();	
		$sql = "UPDATE ".self::$tableName." 
				SET Betalat_till = ? 
				WHERE Personnummer = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $paydate, $pnr);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$stmt->close();
		
		mysqli_close($this->con);						
	}	
	
	/**
	 * @param string
	 */
	public function deleteMember($pnr)
	{		
		$sql = "DELETE FROM ".self::$tableName."
				WHERE Personnummer = ?;";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("s", $pnr);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$stmt->close();
		
		mysqli_close($this->con);
	}
	
}