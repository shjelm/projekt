<?php

namespace controller;

class memberController{
	
	public function __construct($mysqli)
	{
		$this->loginView = new \view\loginView();
		$this->loginModel = new \model\loginModel($mysqli);
		$this->HTMLPage = new \view\HTMLPage();
		$this->loginDAL = new \model\loginDAL($mysqli);
		$this->memberModel = new \model\memberModel();
		$this->eventModel = new \model\eventModel();
		$this->checkModel = new \model\checkModel();
		$this->eventDAL = new \model\eventDAL($mysqli);
	}
	
	public $numberOfMembers;
	
	public $members;
	
	public function changePassword()
	{
		
		$username = $this->loginModel->getUsername();
		$newpassword = $this->loginView->getNewPassword();
		$repeatedpassword = $this->loginView->getRepeatedNewPassword();
		
		if($this->matchingPasswords($newpassword, $repeatedpassword)){
			$this->messageNr = $this->loginModel->correctChangeOfPasswords();
			
			$this->loginDAL->updatePassword($username, $newpassword);
		}
		else{
			$this->messageNr = $this->loginModel->incorrectChangeOfPasswords();
		}
		$this->message = $this->loginView->setMessage($this->messageNr);
	}
	
	/**
	 * @return bool
	 */
	public function matchingPasswords($newpass, $repeatedpass)
	{
		return $this->loginModel->comparePasswords($newpass, $repeatedpass);	
	}
	
	public function adminWantsToDeleteMember()
	{
		$pnr = $this->loginModel->getPnr();
		$this->messageNr = $this->loginModel->memberDeleted();
		$this->message = $this->loginView->setMessage($this->messageNr);
		$this->loginDAL->deleteMember($pnr);
	}
	
	public function memberWantsToShowMembers()
	{
		$newRow = $this->loginView->getNewRow();		
		$this->members = $this->loginDAL->getMembersSimple($newRow);
	}
	
	public function adminWantsToShowMember()
	{							
		$pnr = $this->loginView->getMemberAdminWantsToShow();
		$correctPnr = $this->loginDAL->getMemberToShow($pnr);
		
		if(isset($correctPnr)){
			$this->memberToShow = $this->loginDAL->getMember($correctPnr);
			
			$this->loginModel->savePnr($correctPnr);
		}
		else{
			$this->messageNr = $this->loginModel->unexistingPnr();
			$this->message = $this->loginView->setMessage($this->messageNr);
		}
		
		if($this->messageNr == 17){			
				$this->HTMLPage->getShowMemberPage($this->message,$this->memberToShow, $this->notClickable);
			}
			else{
				$this->HTMLPage->getShowMemberPage($this->message, $this->memberToShow, $this->clickable);
			}
	}
	
	public function adminWantsToUpdateMember()
	{							
		$pnr = $this->loginModel->getPnr();
		
		if ($this->loginView->isUpdatingFirstName()){
			$value = $this->loginView->getFirstName();
			$this->loginDAL->updateFirstNameMember($pnr, $value);
		}		
		if ($this->loginView->isUpdatingLastName()){
			$value = $this->loginView->getLastName();
			$this->loginDAL->updateLarstNameMember($pnr, $value);
		}
		if ($this->loginView->isUpdatingAddress()){
			$value = $this->loginView->getAddress();
			$this->loginDAL->updateAddressMember($pnr, $value);
		}
		if ($this->loginView->isUpdatingEmail()){
			$value = $this->loginView->getEmail();
			$this->loginDAL->updateEmailMember($pnr, $value);	
		}
		if ($this->loginView->isUpdatingPhonenr()){
			$value = $this->loginView->getPhonenr();
			$this->loginDAL->updatePhonenrMember($pnr, $value);
		}
		if ($this->loginView->isUpdatingClass()){
			$value = $this->loginView->getClass();
			$this->loginDAL->updateClassMember($pnr, $value);
		}
		
		$this->messageNr = $this->loginModel->memberUpdated();
		
		if ($this->loginView->isUpdatingPaydate()){
			$value = $this->loginView->getPaydate();
			
			if($this->loginModel->checkValidDateForUpdate($value)){
				$this->loginDAL->updatePaydateMember($pnr, $value);
				$this->messageNr = $this->loginModel->memberUpdated();
			}
			else{
				$this->messageNr = $this->loginModel->eventUpdatedDateFail();
			}			
		}		
		
		if($this->loginView->isSavingUpdatedMember())
		{
			$this->message = $this->loginView->setMessage($this->messageNr);	
		}
	}

	public function adminWantsToShowMembers()
	{
		
		$this->numberOfMembers = $this->loginDAL->getNumberOfMembers($this->members);
		$newRow = $this->loginView->getNewRow();		
		$this->members = $this->loginDAL->getMembers($newRow);
		
		
		
	}
	
	public function adminWantsToShowPayingMembers()
	{
		
		$this->numberOfMembers = $this->loginDAL->getNumberOfMembers($this->members);
		$newRow = $this->loginView->getNewRow();		
		$this->members = $this->loginDAL->getPayingMembers($newRow);
		
	}
	
	public function adminWantsToShowNotPayingMembers()
	{
		
		$this->numberOfMembers = $this->loginDAL->getNumberOfMembers($this->members);
		$newRow = $this->loginView->getNewRow();		
		$this->members = $this->loginDAL->getNotPayingMembers($newRow);
		
	}
}
