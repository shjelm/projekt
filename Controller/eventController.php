<?php

namespace controller;

require_once realpath(dirname(__DIR__)).'/View/loginView.php';
require_once realpath(dirname(__DIR__)).'/View/HTMLPage.php';
require_once realpath(dirname(__DIR__)).'/Controller/applicationController.php';
require_once realpath(dirname(__DIR__)).'/Controller/memberController.php';
require_once realpath(dirname(__DIR__)).'/Controller/registerController.php';
require_once realpath(dirname(__DIR__)).'/Model/loginModel.php';
require_once realpath(dirname(__DIR__)).'/Model/loginDAL.php';
require_once realpath(dirname(__DIR__)).'/Model/member.php';
require_once realpath(dirname(__DIR__)).'/Model/event.php';
require_once realpath(dirname(__DIR__)).'/Model/memberModel.php';
require_once realpath(dirname(__DIR__)).'/Model/eventModel.php';
require_once realpath(dirname(__DIR__)).'/Model/checkModel.php';
require_once realpath(dirname(__DIR__)).'/Model/eventDAL.php';

class eventController{
	
	private $event;
	
	private $eventToShow;
	
	public function __construct($mysqli){
		$this->loginController = new \controller\loginController($mysqli);
		$this->loginView = new \view\loginView();
		$this->loginModel = new \model\loginModel($mysqli);
		$this->HTMLPage = new \view\HTMLPage();
		$this->loginDAL = new \model\loginDAL($mysqli);
		$this->memberModel = new \model\memberModel();
		$this->eventModel = new \model\eventModel();
		$this->checkModel = new \model\checkModel();
		$this->eventDAL = new \model\eventDAL($mysqli);
		$this->memberController = new \controller\memberController($mysqli);
		$this->registerController = new \controller\registerController($mysqli);
	}
	
	public function adminWantsToDeleteEvent()
	{
		$title = $this->loginModel->getTitle();
		$this->messageNr = $this->loginModel->eventDeleted();
		$this->message = $this->loginView->setMessage($this->messageNr);
		$this->eventDAL->deleteEvent($title);
		
		$this->HTMLPage->getLoggedInPage($this->message);
	}
	
	public function adminWantsToShowEvent()
	{
		$title = $this->loginView->getEventAdminWantsToShow();
		$correctTitle = $this->eventDAL->getEventToShow($title);
		
		if(isset($correctTitle)){
			$this->eventToShow = $this->eventDAL->getEvent($correctTitle);
			
			$this->loginModel->saveTitle($correctTitle);
		}
		else{
			$this->messageNr = $this->loginModel->unexistingEvent();
			$this->message = $this->loginView->setMessage($this->messageNr);
		}		
		
		if(isset($this->eventToShow)){
				$this->HTMLPage->getShowEventPage($this->message,$this->eventToShow,$this->clickable);
			}
		else{
			$this->HTMLPage->getShowEventPage($this->message,$this->eventToShow,$this->notClickable);
		}
	}
	
	public function adminWantsToUpdateEvent()
		{							
			$title = $this->loginModel->getTitle();
			
			if ($this->loginView->isUpdatingDate()){
				$value = $this->loginView->getDate();
				
				if($this->loginModel->checkValidDateForUpdate($value)){
					$this->loginDAL->updateDateEvent($title, $value);
					$this->messageNr = $this->loginModel->eventUpdated();	
				}
				else{
					$this->messageNr = $this->loginModel->eventUpdatedDateFail();
				}
			}
			if ($this->loginView->isUpdatingTime()){
				$value = $this->loginView->getTime();
				
				if($this->loginModel->checkValidTimeForUpdate($value)){
					$this->loginDAL->updateTimeEvent($title, $value);
					$this->messageNr = $this->loginModel->eventUpdated();
				}
				else{
					$this->messageNr = $this->loginModel->eventUpdatedTimeFail();
				}
			}
			if ($this->loginView->isUpdatingInfo()){
				$value = $this->loginView->getInfo();
				$this->loginDAL->updateInfoEvent($title, $value);	
				$this->messageNr = $this->loginModel->eventUpdated();
			}	
			
			$this->message = $this->loginView->setMessage($this->messageNr);
			
			$title = $this->loginModel->getTitle();
			$this->HTMLPage->getUpdateEventPage($this->message, $title);
		}

	public function adminWantsToAddEvent()
	{
		$newEvent = $this->loginView->setEvent();
		$this->event = new \model\event($newEvent[0], $newEvent[1],
								$newEvent[2], $newEvent[3]);
							
		$title = $this->event->getTitle();
		$existingTitle = $this->eventDAL->getEventToShow($title);
			
		if($this->loginView->checkFormSent() && !isset($existingTitle)){
			$this->messageNr = $this->eventModel->checkUnvalidEvent($this->event);
			$this->message = $this->loginView->setMessage($this->messageNr);
		}
		else if($this->loginView->checkFormSent() && isset($existingTitle)){
			$this->messageNr = $this->loginModel->alreadyExistingEvent();
			$this->message = $this->loginView->setMessage($this->messageNr);
		}
		
		if($this->eventModel->checkValidEvent($this->event) && !isset($existingTitle)){			
			$this->eventDAL->addEvent($this->event);
		}		
						
		if($this->eventModel->checkValidEvent($this->event) == false){
			$this->HTMLPage->getAddEventPage($this->message);
		}
		else{
			$this->HTMLPage->getLoggedInPage($this->message);
		}
	}
	
	public function showEvents()
	{
		$newRow = $this->loginView->getNewRow();	
		$this->events = $this->eventDAL->getEvents($newRow);
		
		$this->HTMLPage->getShowEventsPage($this->events);
	}
	
}
