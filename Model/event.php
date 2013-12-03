<?php

namespace model;

class Event{
	
	/**
	 * @var string
	 */
	private $title;
	
	/**
	 * @var date
	 */
	private $eventDate;
	
	/**
	 * @var string
	 */
	private $info;
	
	/**
	 * @var time
	 */
	private $eventTime;
	
	public function __construct($title, $eventDate, $eventTime , $info)
	{		
		$this->title = $title;
		$this->eventDate = $eventDate;		
		$this->eventTime = $eventTime;
		$this->info = $info;		
	}
	
	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * @return date
	 */
	public function getEventDate()
	{
		return $this->eventDate;
	}
	
	/**
	 * @return string
	 */
	public function getInfo()
	{
		return $this->info;
	}
	
	/**
	 * @return time
	 */
	public function getEventTime()
	{
		return $this->eventTime;
	}
}