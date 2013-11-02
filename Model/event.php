<?php

namespace model;

class Event{
	
	/**
	 * @var string
	 */
	private $title;
	
	/**
	 * @var string
	 */
	private $dateTime;
	
	/**
	 * @var string
	 */
	private $info;
	
	
	public function __construct($title, $dateTime, $info)
	{
		$this->loginDAL = new \model\LoginDAL;
		
		$this->title = $title;
		$this->dateTime = $dateTime;
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
	 * @return string
	 */
	public function getDateTime()
	{
		return $this->dateTime;
	}
	
	/**
	 * @return string
	 */
	public function getInfo()
	{
		return $this->info;
	}
}