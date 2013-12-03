<?php

namespace model;

class eventDAL{
	
	/**
	 * @var string
	 */
	private static $tableName = "event";
	
	/**
	 * @var mysqli
	 */
	private $con;
	
	public function __construct(){
		$this->createEventsTable();
	}
	
	public function openCon()
	{
		$this->con = mysqli_connect("register-185594.mysql.binero.se", "185594_zh40528", "lolipoP19", "185594-register");
	}
	
	private function createEventsTable()
	{
		$this->openCon();
		$sql ="CREATE TABLE IF NOT EXISTS ".self::$tableName."
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
	
	/**
	 * @param string
	 * @return array
	 */
	public function getEvent($id)
	{
		$sql = "SELECT Titel, Datum, Tid, Info 
				FROM ".self::$tableName." 
				WHERE ID = ?";
				
		$stmt = $this->con->prepare($sql);
		
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("i", $id);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($title, $date, $time, $info);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		 
		while($stmt->fetch()) {
			$result = new event($title, $date, $time, $info);
		}
		
		$stmt->close();

	  	return $result;
	  	
		mysqli_close($this->con);	
	}
	
	/**
	 * @param string
	 * @return array
	 */
	public function getId($title)
	{
		$sql = "SELECT ID 
				FROM ".self::$tableName." 
				WHERE Titel = ?";
				
		$stmt = $this->con->prepare($sql);
		
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("s", $title);
        if ($result == FALSE) {
                throw new \Exception("Couldn't execute [$sql] " . $stmt->error);
        }
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($id);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		 
		while($stmt->fetch()) {
			$result = $id;
		}
		
		$stmt->close();
		  
	  	return $result;
	  	
		mysqli_close($this->con);
		
	}
	
	/**
	 * @param string
	 * @return array
	 */
	public function getEventToShow($id)
	{
		$sql = "SELECT Titel 
				FROM ".self::$tableName;
		
		$stmt = $this->con->prepare($sql);
		
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($idFromDb);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		 
		while($stmt->fetch()) {
			$array[] = $idFromDb;
		}		
		  
	  	for ($i=0; $i <count($array) ; $i++) {
			  if($id == $array[$i]){
			  	return $array[$i];
			  }
		  }
	  	
		$stmt->close();
		
		mysqli_close($this->con);
	}
	
	/**
	 * @param date
	 * @return array
	 */
	public function getEventDateToShow($date)
	{
		$sql = "SELECT Datum FROM ".self::$tableName;
		
		$stmt = $this->con->prepare($sql);
		
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->execute();
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$result = $stmt->bind_result($dateFromDb);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		 
		while($stmt->fetch()) {
			$array[] = $dateFromDb;
		}
		
		for ($i=0; $i <count($array) ; $i++) {
			  if($date == $array[$i]){
			  	return $array[$i];
			  }
		  }
		
		$stmt->close();
	  	
		mysqli_close($this->con);
	}

	/**
	 * @param string
	 */
	public function deleteEvent($id)
	{
		$sql = "DELETE 
				FROM ".self::$tableName." 
				WHERE ID = ?";
				
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("i", $id);
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
	 * @param /model/event
	 */
	public function addEvent(event $event)
	{
		$this->openCon();
		
		$title = $event->getTitle();
		$eventDate = $event ->getEventDate();	
		$eventTime = $event->getEventTime();	
		$info = $event->getInfo();

			$sql = "INSERT INTO ".self::$tableName."
			(
				Titel,
				Datum,
				Tid,
				Info
				
			)
			VALUES (?,?,?,?)";
				
		$stmt = $this->con->prepare($sql);
		
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ssss", $title,$eventDate,$eventTime,$info);
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
	 * @return array
	 */
	public function getEvents()
	{
		$today = date('Y-m-d');

		$sql = "SELECT Titel, Datum, Tid, Info 
				FROM ".self::$tableName."
				WHERE Datum >= ?
				ORDER BY Datum ASC";
		
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
		
		$result = $stmt->bind_result($title, $date, $time, $info);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		 
		while($stmt->fetch()) {
			$array[] = new event($title, $date, $time, $info);
		}
		
		$stmt->close();
		  
	  	return $array;
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @return array
	 */
	public function getCompletedEvents()
	{
		$today = date('Y-m-d');

		$sql = "SELECT Titel, Datum, Tid, Info 
				FROM ".self::$tableName."
				WHERE Datum < ? 
				ORDER BY Datum ASC";
		
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
		
		$result = $stmt->bind_result($title, $date, $time, $info);
		if($result == FALSE){
			throw new \Exception("Couldn't execute [$sql]".$stmt->error);
		}
		
		$array = array();
		 
		while($stmt->fetch()) {
			$array[] = new event($title, $date, $time, $info);
		}
		
		$stmt->close();
		  
	  	return $array;
	  	
		mysqli_close($this->con);
	}
	
	/**
	 * @param string
	 * @param string
	 */
	public function updateTitleEvent($id, $title)
	{
		$this->openCon();
		$sql = "UPDATE ".self::$tableName." 
				SET Titel = ? 
				WHERE ID = ?";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $title, $id);
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
	public function updateDateEvent($id, $date)
	{
		$this->openCon();
		$sql = "UPDATE ".self::$tableName." 
				SET Datum = ? 
				WHERE ID = ?";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param("ss", $date, $id);
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
	public function updateTimeEvent($id, $time)
	{
		$this->openCon();
		$sql = "UPDATE ".self::$tableName." 
				SET Tid = ? 
				WHERE ID = ?";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param('ss', $time, $id);
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
	public function updateInfoEvent($id, $info)
	{
		$this->openCon();		
		$sql = "UPDATE ".self::$tableName." 
				SET Info = ? 
				WHERE ID = ?";
		
		$stmt = $this->con->prepare($sql);
		if($stmt == FALSE){
			throw new \Exception("Prepare of [$sql] failed".$this->con->error);
		}
		
		$result = $stmt->bind_param('ss', $info, $id);
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
