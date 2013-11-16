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
	
	public function __construct($mysqli) {

		//$this->con = $mysqli;
		$this->openCon();
		$this->createEventsTable();
		//$this->closeCon();
	}
	
	public function openCon()
	{
		$this->con = mysqli_connect("register-185594.mysql.binero.se", "185594_zh40528", "lolipoP19", "185594-register");
	}
	
	public function closeCon()
	{
		mysqli_close($this->con);
	}
	
	private function createEventsTable()
	{
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
	public function getEvent($title)
	{
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName." WHERE Titel = "."'$title'");
		
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
	 * @param string
	 * @return array
	 */
	public function getEventToShow($title)
	{
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName);
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
	 * @param date
	 * @return array
	 */
	public function getEventDateToShow($date)
	{
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName);
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
	 * @param string
	 * @param string
	 */
	public function deleteEvent($title)
	{
		$this->openCon();
		$sql = " DELETE FROM ".self::$tableName." WHERE Titel = "."'$title'";
		
		$stmt = $this->con->prepare($sql);
		$stmt->execute();	
		$stmt->close();	
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
			VALUES ('$title','$eventDate','$eventTime','$info');";
			
			$stmt = $this->con->prepare($sql);
			$stmt->execute();	
			$this->closeCon();			
	}
	
	/**
	 * @param string
	 * @return array
	 */
	public function getEvents($newRow)
	{
		$result = mysqli_query($this->con,"SELECT * FROM ".self::$tableName." ORDER BY Datum ASC");
            
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
	
	public function updateDateEvent($title, $date)
	{
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Datum = ? WHERE Titel = "."'$title'";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $date);
		$stmt->execute();	
		$stmt->close();	
	}
	
	/**
	 * @param string
	 * @param time
	 */
	public function updateTimeEvent($title, $time)
	{
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Tid = ? WHERE Titel = "."'$title'";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $time);
		$stmt->execute();	
		$stmt->close();	
	}
	
	/**
	 * @param string
	 * @param string
	 */
	public function updateInfoEvent($title, $info)
	{
		$this->openCon();
		$sql = " UPDATE ".self::$tableName." SET Info  = ? WHERE Titel = "."'$title'";
		
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('s', $info);
		$stmt->execute();	
		$stmt->close();	
	}
}
