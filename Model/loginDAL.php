<?php

namespace model;

class LoginDAL
{
	/**
	 * @var string
	 */
 	private static $tableName = "member";
	
	/**
	 * @var string
	 */
	private static $eventTableName = "event";
	
	/**
	 * @var mysqli
	 */
	private $con;
	
	public function __construct() {

		$this->openCon();
		
		$this->createMemberTable();
		$this->createEventsTable();
	}
	
	public function openCon()
	{
		$this->con = mysqli_connect("register-185594.mysql.binero.se", "185594_zh40528", "lolipoP19", "185594-register");
	}
	private function createMemberTable()
	{
		$sql ="CREATE TABLE IF NOT EXISTS ".self::$tableName."
		(
			Namn VARCHAR(60) NOT NULL ,
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
	private function createEventsTable()
	{
		$sql ="CREATE TABLE IF NOT EXISTS event
		(
			Titel VARCHAR(100) NOT NULL ,
	 		Datum DATE NOT NULL ,
	 		Tid TIME NOT NULL ,
			Info VARCHAR(500) NOT NULL 			
		);";
		
		if ($this->con->query($sql) === FALSE) {
          throw new \Exception("'$sql' failed " . $this->con->error);
      	}
	}
	
	public function addMember(member $member)
	{
		$this->openCon();
		
		$name = $member->getName();
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
				Namn,
				Personnummer,
				Klass,
				Telefonnummer,
				Epostadress,
				Adress,
				Betalat_till,
				Anvnamn,
				Losenord
				
			)
			VALUES ('$name','$pnr','$class','$phnr','$email','$address','$paydate','$username','$password');";
			
			$stmt = $this->con->prepare($sql);
			//$stmt->bind_param("sssssss",$name,$pnr,$class,$phnr,$email,$address,$paydate);
			$stmt->execute();				
			
    }
	
	/**
	 * @return array
	 */
	public function getMembers($newRow)
	{
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName." ORDER BY Personnummer DESC");
            
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			  array_push($array,$row['Personnummer']);
			  array_push($array,$row['Namn']);
			  array_push($array,$row['Klass']);
			  array_push($array,$row['Adress']);
			  array_push($array,$row['Epostadress']);
			  array_push($array,$row['Telefonnummer']);
			  array_push($array,$row['Betalat_till'].$newRow);
		  }
		  
		  
	  	return $array;
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getNumberOfMembers()
	{
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName);
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			  array_push($array,$row['Personnummer']);
		  }
	  	return count($array);
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getMembersSimple($newRow)
	{
		$result = mysqli_query($this->con,"SELECT Namn, Klass, Epostadress FROM ".self::$tableName." ORDER BY Namn DESC");
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			  array_push($array,$row['Namn']);
			  array_push($array,$row['Klass']);
			  array_push($array,$row['Epostadress'].$newRow);
		  }
	  	return $array;
	  	
		mysqli_close($this->con);
	}
	
	
	/**
	 * @return array
	 */
	public function getMemberToShow($pnr)
	{
		$result = mysqli_query($this->con,"SELECT Personnummer FROM ".self::$tableName);
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			  array_push($array,$row['Personnummer']);
		  }
	  	for ($i=0; $i <count($array) ; $i++) {
			  if($pnr == $array[$i]){
			  	return $array[$i];
			  }
		  }
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getEventToShow($title)
	{
		$result = mysqli_query($this->con,"SELECT * FROM event");
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			  array_push($array,$row['Titel']);
		  }
		  
	  	for ($i=0; $i <count($array) ; $i++) {
			  if($title == $array[$i]){
			  	return $array[$i];
			  }
		  }
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getEventDateToShow($date)
	{
		$result = mysqli_query($this->con,"SELECT * FROM event");
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			  array_push($array,$row['Datum']);
		  }
		  
	  	for ($i=0; $i <count($array) ; $i++) {
			  if($date == $array[$i]){
			  	return $array[$i];
			  }
		  }
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getEvent($title)
	{
		$result = mysqli_query($this->con,"SELECT * FROM event WHERE Titel = "."'$title'");
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
		  	  array_push($array,$row['Titel']); 
			  array_push($array,$row['Datum']);
			  array_push($array,$row['Tid']);
			  array_push($array,$row['Info']);
		  }
	  	
		return $array;
		
		mysqli_close($this->con);
	}
	
	
	/**
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
	 * @return array
	 */
	public function getUserInfo($username)
	{		
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName." WHERE Anvnamn = "."'$username'");
		
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
	  	return $array;
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getMember($pnr)
	{
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName." WHERE Personnummer = ".$pnr);
		
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
		  
	  	return $array;
		mysqli_close($this->con);		
	}
	
	/**
	 * @return array
	 */
	public function getUserName()
	{
		$result = mysqli_query($this->con,"SELECT Anvnamn FROM ".self::$tableName.";");
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			array_push($array,$row['Anvnamn']);
		  }
		  
	  	return $array;
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getPassword($username)
	{
		$result = mysqli_query($this->con,"SELECT Losenord FROM ".self::$tableName." WHERE Anvnamn = "."'$username'".";");
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			array_push($array,$row['Losenord']);
		  }
		  
	  	return $array;
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getPayingMembers($newRow)
	{
		$today = date('Y-m-d');
		
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName." WHERE Betalat_till >= "."'$today'"." ORDER BY Personnummer DESC ;");
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			array_push($array,$row['Personnummer']);
			array_push($array,$row['Namn']);
			array_push($array,$row['Klass']);
			array_push($array,$row['Adress']);
			array_push($array,$row['Epostadress']);
			array_push($array,$row['Telefonnummer']);
			array_push($array,$row['Betalat_till'].$newRow);
		  }
	  	return $array;
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getNotPayingMembers($newRow)
	{
		$today = date('Y-m-d');
		
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName." WHERE Betalat_till < "."'$today'"." ORDER BY Personnummer DESC ;");
		
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			array_push($array,$row['Personnummer']);
			array_push($array,$row['Namn']);
			array_push($array,$row['Klass']);
			array_push($array,$row['Adress']);
			array_push($array,$row['Epostadress']);
			array_push($array,$row['Telefonnummer']);
			array_push($array,$row['Betalat_till'].$newRow);
		  }
	  	return $array;
		mysqli_close($this->con);
	}
	
	public function updatePassword($username, $newpassword)
	{
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Losenord = ? WHERE Anvnamn = "."'$username'".";";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $newpassword);
		$stmt->execute();	
		$stmt->close();	
	}
	
	public function updateNameMember($pnr, $name)
	{	
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Namn = ? WHERE Personnummer = ".$pnr.";";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $name);
		$stmt->execute();	
		$stmt->close();					
	}
	public function updateAddressMember($pnr, $address)
	{	
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Adress = ? WHERE Personnummer = ".$pnr.";";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $address);
		$stmt->execute();	
		$stmt->close();					
	}
	public function updateEmailMember($pnr, $email)
	{	
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Epostadress = ? WHERE Personnummer = ".$pnr.";";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $email);
		$stmt->execute();	
		$stmt->close();					
	}
	public function updatePhonenrMember($pnr, $phonenr)
	{	
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Telefonnummer = ? WHERE Personnummer = ".$pnr.";";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $phonenr);
		$stmt->execute();	
		$stmt->close();					
	}
	public function updateClassMember($pnr, $class)
	{	
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Klass = ? WHERE Personnummer = ".$pnr.";";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $class);
		$stmt->execute();	
		$stmt->close();					
	}
	public function updatePaydateMember($pnr, $paydate)
	{	
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Betalat_till = ? WHERE Personnummer = ".$pnr.";";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $paydate);
		$stmt->execute();	
		$stmt->close();					
	}
	
	public function updateDateEvent($title, $date)
	{
		$this->openCon();
		$sql = " UPDATE ".self::$eventTableName." SET Datum = ? WHERE Titel = "."'$title'";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $date);
		$stmt->execute();	
		$stmt->close();	
	}
	
	public function updateTimeEvent($title, $time)
	{
		$this->openCon();
		$sql = " UPDATE ".self::$eventTableName." SET Tid = ? WHERE Titel = "."'$title'";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $time);
		$stmt->execute();	
		$stmt->close();	
	}
	
	public function updateInfoEvent($title, $info)
	{
		$this->openCon();
		$sql = " UPDATE ".self::$eventTableName." SET Info  = ? WHERE Titel = "."'$title'";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $info);
		$stmt->execute();	
		$stmt->close();	
	}
	
	public function deleteMember($pnr)
	{
		$this->openCon();
		$sql = " DELETE FROM ".self::$tableName." WHERE Personnummer = ".$pnr.";";
		
		$stmt = $this->con->prepare($sql);
		$stmt->execute();	
		$stmt->close();	
	}
	
	public function deleteEvent($title)
	{
		$this->openCon();
		$sql = " DELETE FROM ".self::$eventTableName." WHERE Titel = "."'$title'";
		
		$stmt = $this->con->prepare($sql);
		$stmt->execute();	
		$stmt->close();	
		
	}
	
	public function addEvent(event $event)
	{
		$this->openCon();
		
		$title = $event->getTitle();
		$eventDate = $event ->getEventDate();	
		$eventTime = $event->getEventTime();	
		$info = $event->getInfo();

			$sql = "INSERT INTO event
			(
				Titel,
				Datum,
				Tid,
				Info
				
			)
			VALUES ('$title','$eventDate','$eventTime','$info');";
			
			$stmt = $this->con->prepare($sql);
			$stmt->execute();				
	}
	
	/**
	 * @return array
	 */
	public function getEvents($newRow)
	{
		$result = mysqli_query($this->con,"SELECT * FROM event ORDER BY Datum ASC");
            
		$array = array();
		
		while($row = mysqli_fetch_array($result))
		  {
			  array_push($array,$row['Titel']);
			  array_push($array,$row['Datum']);
			  array_push($array, $row['Tid']);
			  array_push($array,$row['Info'].$newRow);
		  }
		  
		  
	  	return $array;
	  	
		mysqli_close($this->con);
	}
}