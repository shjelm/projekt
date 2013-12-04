<?php

namespace model;

class eventModel{
	
	CONST EMPTYFORMEVENT = 24;
	CONST ADDINGEVENTSUCCES = 26;
	CONST UPDATEDEVENT = 27;
    CONST EXISTINGEVENT = 28;
    CONST DELETEDEVENT = 29;
    CONST UNEXISTINGTITLE = 30;
	
	/**
	 * @var /model/checkModel
	 */
	private $checkModel;
	
	public function __construct()
	{
		$this->checkModel = new \model\checkModel();
	}
	
	/**
	 * @param /model/event
	 * @return bool
	 */	
	public function checkValidEvent(event $event)
	{
		$title = $event->getTitle();
		$eventDate = $event ->getEventDate();
		$eventTime = $event ->getEventTime();		
		$info = $event->getInfo();
		
		if(empty($title) || empty($eventDate) || empty($info) || empty($eventTime))
		{
			 return false;
		}		
		else if($this->checkModel->unvalidDateFormat($eventDate))
		{
			return false;
		}
		else if($this->checkModel->unvalidTimeFormat($eventTime))
		{
			return false;
		}
		else 
		{
			return true;
		}
	}	
	
	/**
	 * @param /model/event
	 * @return int
	 */
	public function checkUnvalidEvent(event $event)
	{
		$title = $event->getTitle();
		$eventDate = $event ->getEventDate();
		$eventTime = $event ->getEventTime();		
		$info = $event->getInfo();
		
		if(empty($title) || empty($eventDate) || empty($info) || empty($eventTime) )
		{
			 return self::EMPTYFORMEVENT;
		}	
		
		if($this->checkModel->unvalidDateFormat($eventDate))
		{
			 return self::UNVALIDDATEFORMAT;
		}
		
		if($this->checkModel->unvalidTimeFormat($eventTime))
		{
			 return self::UNVALIDTIMEFORMAT;
		}	
		else{
			return self::ADDINGEVENTSUCCES;
		}	
	}	
	
	/**
	 * @return int
	 */	
	public function eventDeleted()
	{
		return self::DELETEDEVENT;
	}
	
	/**
	 * @return bool
	 */
	public function eventExists($title, $date)
	{
		if(isset($title) && isset($date))
		{
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return int
	 */
	public function alreadyExistingEvent()
	{
		return self::EXISTINGEVENT;
	}
	
	/**
	 * @return int
	 */
	public function eventUpdated()
	{
		return self::UPDATEDEVENT;
	}
	
}
