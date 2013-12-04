<?php

namespace view;

class eventView{
	
	/**
	 * @var string
	 */
	private static $updateEvent = "updateEvent";
	
	/**
	 * @var string
	 */
	private static $deleteEvent = "deleteEvent";
	
	/**
	 * @var string
	 */
	private static $newInfo = "newInfo";
	
	/**
	 * @var string
	 */
	private static $showEvents = "showEvents";
	
	/**
	 * @var string
	 */
	private static $wantsToAddEvent = "wantsToAddEvent";
	
	/**
	 * @var string
	 */
	private static $addEvent = "addEvent";
	
	/**
	 * @var string
	 */
	private static $wantsToUpdateEvent = "wantsToUpdateEvent";
	
	/**
	 * @var string
	 */
	private static $newTitle = "newTitle";
	
	/**
	 * @var string
	 */
	private static $updateThisEvent = "updateThisEvent";

	/**
	 * @var string
	 */
	private static $eventTitle = "eventTitle";
	/**
	 * @var string
	 */
	private static $eventDate = "eventDate";
	
	/**
	 * @var string
	 */
	private static $eventTime = "eventTime";
	
	/**
	 * @var string
	 */
	private static $eventInfo = "eventInfo";
	 
	/**
	 * @return string
	 */
	public function getEventInfo()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$newInfo])){
				return strip_tags($_POST[self::$newInfo]);
			}
		}				
	}
	
	/**
	 * @return string
	 */
	public function getTitle()
	{	if($_POST || $_GET){
			if(isset($_POST[self::$newTitle])){
				return $_POST[self::$newTitle];
			}
		}				
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingInfo()
	{
		if (!empty($_POST[self::$newInfo])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	/**
	 * @return array
	 */
	public function getEventData()
	{
		if($_POST){
			$title = $_POST[self::$eventTitle];
			$eventDate = $_POST[self::$eventDate];
			$eventTime = $_POST[self::$eventTime];
			$info = $_POST[self::$eventInfo];
		
			$array = array();
			
			array_push($array, strip_tags($title));
			array_push($array, $eventDate);	
			array_push($array, $eventTime);		
			array_push($array, strip_tags($info));		
		}
		return $array;
	}
	
	/**
	 * @return string
	 */
	public function getEventAdminWantsToUpdate()
	{
		if(isset($_GET[self::$updateEvent])){
			$unique = $_GET[self::$updateEvent];
			return $unique;
		}	
	}
	
	/**
     * @return string
     */
    public function getEventAdminWantsToDelete()
    {
            if(isset($_GET[self::$deleteEvent])){
            	$unique = $_GET[self::$deleteEvent];
                    return $unique;
            }        
    }
	
	/**
	 * @return bool
	 */
	public function isUpdatingTitle()
	{
		if (!empty($_POST[self::$newTitle])) {
			return true;
		}
		else{
			return false;
		}	
	}
	
	
	/**
	 * @return bool
	 */
	public function isWantingDeletingEvent()
	{
		if (isset($_GET[self::$deleteEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isDeletingEvent()
	{
		if (isset($_GET[self::$deleteEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	
	/**
	 * @return bool
	 */
	public function isShowingEvents() {
		if (isset($_GET[self::$showEvents])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isWantingToAddEvent() {
		if (isset($_GET[self::$wantsToAddEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isAddingEvent() {
		if (isset($_POST[self::$addEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isWantingToUpdateEvent() {
		if (isset($_GET[self::$wantsToUpdateEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isUpdatingEvent() {
		if (isset($_GET[self::$updateEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**
	 * @return bool
	 */
	public function isSavingUpdatedEvent() {
		if (isset($_POST[self::$updateThisEvent])) {
			return true;
		}
		else{
			return false;
		}
	}
	
	/**  
	 * @param array
	 * @return string
	 */
	public function showEvents($events)
	{
		if($events != NULL){		
			for ($i=0; $i < count($events); $i++) {
				$this->eventsToShow .= $this->getEventHTML($events[$i]);
			} 
						
			return $this->eventsToShow;
		}
	}
	
	/**  
	 * @param array
	 * @return string
	 */
	public function showSimpleEvents($events)
	{
		if($events != NULL){		
			for ($i=0; $i < count($events); $i++) {
				$this->simpleEventsToShow .= $this->getSimpleEventHTML($events[$i]);
			} 		
			
			return $this->simpleEventsToShow;
		}
	}
	
	/**
	 * @param model/event 
	 * @return string HTML
	 */
	public function getEventHTML(\model\event $event)
	{
		 $title = $event->getTitle();
		 $eventDate = $event->getEventDate();
		 $info = $event->getInfo();
		 $eventTime = $event->getEventTime();
		 
		 $eventHTML = "<div id='event'>
			 				<p>Titel: ".$title."
			 				<p>Datum: ".$eventDate." Tid: ".$eventTime."</p>
			 				<p>Beskrivning: ".$info."</p>
			 				<p><a href='?".self::$updateEvent."=".$title."'>Ändra evenemang</a></p>
							<p><a href='?".self::$deleteEvent."=".$title."'>Radera evenemang</a></p>
			 				<br>
		 				</div>";
						
		return $eventHTML;					
	}
	
	/**
	 * @param model/event 
	 * @return string HTML
	 */
	public function getSimpleEventHTML(\model\event $event)
	{
		 $title = $event->getTitle();
		 $eventDate = $event->getEventDate();
		 $info = $event->getInfo();
		 $eventTime = $event->getEventTime();
		 
		 $eventHTML = "<div id='event'>
			 				<p>Titel: ".$title."
			 				<p>Datum: ".$eventDate." Tid: ".$eventTime."</p>
			 				<p>Beskrivning: ".$info."</p>
			 				<br>
		 				</div>";
						
		return $eventHTML;					
	}
	
}