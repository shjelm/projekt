<?php

namespace controller;

require_once realpath(dirname(__DIR__)).'/Model/member.php';
require_once realpath(dirname(__DIR__)).'/Model/memberModel.php';


class registerController{
	
	/**
	 * @var string
	 */
	private $message;
	
	/**
	 * @var string
	 */
	private $messageNr;
	
	public function __construct()
	{
		$this->loginView = new \view\loginView();
		$this->memberView = new \view\memberView();
		$this->messageView = new \view\messageView();
		$this->loginModel = new \model\loginModel();
		$this->HTMLPage = new \view\HTMLPage();
		$this->loginDAL = new \model\loginDAL();
		$this->memberModel = new \model\memberModel();
	}
	
	public function adminWantsToAddMember()
	{
		$newMember = $this->memberView->getMemberData();
		$member = new \model\member($newMember[0], $newMember[1],
								$newMember[2], $newMember[3],
								$newMember[4], $newMember[5],
								$newMember[6], $newMember[7]);
		
		$pnr = $member->getPersonalNr();
		$existingPnr = $this->loginDAL->getMemberToShow($pnr);
		
		if($this->loginView->checkFormSent() && !isset($existingPnr)){
			$this->messageNr = $this->memberModel->checkUnvalidNewMember($member);
			$this->message = $this->messageView->setMessage($this->messageNr);			
			
		}
		else if($this->loginView->checkFormSent() && isset($existingPnr)){
			$this->messageNr = $this->memberModel->alreadyExistingPnr();
			$this->message = $this->messageView->setMessage($this->messageNr);
		}
		
		if($this->memberModel->checkNewMemberValid($member) && $existingPnr == null){
			$this->loginDAL->addMember($member);			
		}	
			
		$this->HTMLPage->getAddMemberPage($this->message);
	}
}
