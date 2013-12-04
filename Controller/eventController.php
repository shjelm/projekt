<?php

namespace controller;

require_once realpath(dirname(__DIR__)).'/Model/eventModel.php';
require_once realpath(dirname(__DIR__)).'/Model/eventDAL.php';

class eventController{
	
	/**
	 * @var model\event
	 */
	private $event;
	
	/**
	 * @var model\event
	 */
	public $eventToShow;
	
	public function __construct(){
		$this->loginView = new \view\loginView();
		$this->eventView = new \view\eventView();
		$this->messageView = new \view\messageView();
		$this->HTMLPage = new \view\HTMLPage();
		$this->eventModel = new \model\eventModel();
		$this->checkModel = new \model\checkModel();
		$this->eventDAL = new \model\eventDAL();
	}
	
	public function adminWantsToDeleteEvent()
	{
		$title = $this->eventView->getEventAdminWantsToDelete();
		$correctId = $this->eventDAL->getId($title);
		$this->eventToShow = $this->eventDAL->getEvent($correctId);	
		
		$this->messageNr = $this->eventModel->eventDeleted();
		$this->message = $this->messageView->setMessage($this->messageNr);
		$this->eventDAL->deleteEvent($correctId);
		
		$this->HTMLPage->getLoggedInPage($this->message);
	}
	
	public function adminWantsToUpdateEvent()
		{							
			$title = $this->eventView->getEventAdminWantsToUpdate();
			$correctId = $this->eventDAL->getId($title);
			$this->eventToShow = $this->eventDAL->getEvent($correctId);		
			
			if ($this->eventView->isUpdatingInfo()){
				$value = $this->eventView->getEventInfo();
				$this->eventDAL->updateInfoEvent($correctId, $value);	
				$this->messageNr = $this->eventModel->eventUpdated();
			}	
			
			if($this->eventView->isUpdatingTitle()){
				$titleValue = $this->eventView->getTitle();
				$this->eventDAL->updateTitleEvent($correctId, $titleValue);
				$this->messageNr = $this->eventModel->eventUpdated();	
			}
			
			if ($this->loginView->isUpdatingDate()){
				$dateValue = $this->loginView->getDate();
				
				if($this->checkModel->checkValidDateForUpdate($dateValue)){
					$this->eventDAL->updateDateEvent($correctId, $dateValue);
					$this->messageNr = $this->eventModel->eventUpdated();	
				}
				else{
					$this->messageNr = $this->checkModel->updatedDateFail();
				}
			}
			
			if($this->messageNr != $this->checkModel->updatedDateFail()){
				if ($this->loginView->isUpdatingTime()){
					$timeValue = $this->loginView->getTime();
					if($this->checkModel->checkValidTimeForUpdate($timeValue)){
						$this->eventDAL->updateTimeEvent($correctId, $timeValue);
						$this->messageNr = $this->eventModel->eventUpdated();
					}
					else{
						$this->messageNr = $this->checkModel->updatedTimeFail();
					}
				}
			}
			
			$this->message = $this->messageView->setMessage($this->messageNr);
			
			if($this->eventView->isSavingUpdatedEvent() && $this->checkModel->checkValidDateForUpdate($dateValue)
			   && $this->checkModel->checkValidTimeForUpdate($timeValue))
			{
				$this->HTMLPage->getLoggedInPage($this->message);
			}
			else{
				$this->HTMLPage->getUpdateEventPage($this->message, $this->eventToShow, $correctId);
			}
		}

	public function adminWantsToAddEvent()
	{
		$newEvent = $this->eventView->getEventData();
		$this->event = new \model\event($newEvent[0], $newEvent[1],
								 		$newEvent[2], $newEvent[3]);
							
		$title = $this->event->getTitle();
		
		$this->messageNr = $this->eventModel->checkUnvalidEvent($this->event);
		$this->message = $this->messageView->setMessage($this->messageNr);
		
		if($this->eventModel->checkValidEvent($this->event)){			
			$this->eventDAL->addEvent($this->event);
			
			$this->HTMLPage->getLoggedInPage($this->message);
		}		
		else
		{
			$this->HTMLPage->getAddEventPage($this->message);
		}
	}
	
	public function showEvents()
	{	
		$this->events = $this->eventDAL->getEvents();
		$this->completedEvents = $this->eventDAL->getCompletedEvents();
		
		$this->HTMLPage->getShowEventsPage($this->events,$this->completedEvents);
	}
	
	public function showSimpleEvents()
	{	
		$this->events = $this->eventDAL->getEvents();
		$this->completedEvents = $this->eventDAL->getCompletedEvents();
		
		$this->HTMLPage->getShowSimpleEventsPage($this->events,$this->completedEvents);
	}
	
}
