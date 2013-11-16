<?php

namespace controller;

require_once realpath(dirname(__DIR__)).'/View/loginView.php';
require_once realpath(dirname(__DIR__)).'/View/HTMLPage.php';
require_once realpath(dirname(__DIR__)).'/Controller/applicationController.php';
require_once realpath(dirname(__DIR__)).'/Controller/masterController.php';
require_once realpath(dirname(__DIR__)).'/Model/loginModel.php';
require_once realpath(dirname(__DIR__)).'/Model/loginDAL.php';
require_once realpath(dirname(__DIR__)).'/Model/member.php';
require_once realpath(dirname(__DIR__)).'/Model/event.php';
require_once realpath(dirname(__DIR__)).'/Model/memberModel.php';
require_once realpath(dirname(__DIR__)).'/Model/eventModel.php';
require_once realpath(dirname(__DIR__)).'/Model/checkModel.php';
require_once realpath(dirname(__DIR__)).'/Model/eventDAL.php';


class registerController{
	
	private $message;
	private $messageNr;
	
	public function __construct($mysqli)
	{
		$this->loginView = new \view\loginView();
		$this->loginModel = new \model\loginModel($mysqli);
		$this->HTMLPage = new \view\HTMLPage();
		$this->loginController = new \controller\loginController($mysqli);
		$this->loginDAL = new \model\loginDAL($mysqli);
		$this->memberModel = new \model\memberModel();
		$this->eventModel = new \model\eventModel();
		$this->checkModel = new \model\checkModel();
		$this->eventDAL = new \model\eventDAL($mysqli);
	}
	
	public function adminWantsToAddMember()
	{
		$newMember = $this->loginView->setMember();
		$member = new \model\member($newMember[0], $newMember[1],
								$newMember[2], $newMember[3],
								$newMember[4], $newMember[5],
								$newMember[6], $newMember[7]);
		
		$pnr = $member->getPersonalNr();
		$existingPnr = $this->loginDAL->getMemberToShow($pnr);
		if($this->loginView->checkFormSent() && !isset($existingPnr)){
			//@TODO: Fixa så att meddelanden syns
			$this->messageNr = $this->memberModel->checkUnvalidNewMember($member);
			$this->message = $this->loginView->setMessage($this->messageNr);			
			
		}
		else if($this->loginView->checkFormSent() && isset($existingPnr)){
			$this->messageNr = $this->loginModel->alreadyExistingPnr();
			$this->loginController->message = $this->loginView->setMessage($this->messageNr);
		}
		
		if($this->memberModel->checkNewMemberValid($member) && $existingPnr == null){
			$this->loginDAL->addMember($member);			
		}	
			
		$this->HTMLPage->getAddMemberPage($this->message);
	}
}
