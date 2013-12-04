<?php

namespace controller;

class memberController{
	
	public function __construct()
	{
		$this->loginView = new \view\loginView();
		$this->memberView = new \view\memberView();
		$this->messageView = new \view\messageView();
		$this->loginModel = new \model\loginModel();
		$this->memberModel = new \model\memberModel();
		$this->HTMLPage = new \view\HTMLPage();
		$this->loginDAL = new \model\loginDAL();
		$this->checkModel = new \model\checkModel();
	}
	/**
	 * @var string
	 */
	public $numberOfMembers;
	
	/**
	 * @var array
	 */
	public $members;
	
	/**
	 * @var string
	 */
	public $pnr;
	
	/**
	 * @var model\member
	 */
	public $memberToShow;
	
	public function changePassword()
	{		
		$username = $this->loginModel->getUsername();
		$newpassword = $this->loginView->getNewPasswordUncrypted();
		$repeatedpassword = $this->loginView->getRepeatedNewPassword();

		if($this->checkModel->unvalidLengthPassword($newpassword) == FALSE)
		{
			$cryptedpassword = $this->loginView->encryptPassword($newpassword);

			if($this->matchingPasswords($cryptedpassword, $repeatedpassword)){
				$this->messageNr = $this->loginModel->correctChangeOfPasswords();
			
				$this->loginDAL->updatePassword($username, $cryptedpassword);
			}
			else
			{
				$this->messageNr = $this->loginModel->incorrectChangeOfPasswords();
			}
		}
		else
		{
			$this->messageNr = $this->loginModel->unvalidLengthPassword();
		}			
		
		$this->message = $this->messageView->setMessage($this->messageNr);
		
		$this->HTMLPage->getChangePasswordPage($this->message);
	}
	
	/**
	 * @param string
	 * @param string
	 * @return bool
	 */
	public function matchingPasswords($newpass, $repeatedpass)
	{
		return $this->loginModel->comparePasswords($newpass, $repeatedpass);	
	}
	
	public function adminWantsToDeleteMember()
	{
		$this->pnr = $this->memberView->getMemberAdminWantsToDelete();
		$this->messageNr = $this->memberModel->memberDeleted();
		$this->message = $this->messageView->setMessage($this->messageNr);
		$this->loginDAL->deleteMember($this->pnr);
		
		$this->HTMLPage->getLoggedInPage($this->message);
	}
	
	public function memberWantsToShowMembers()
	{		
		$this->members = $this->loginDAL->getMembersSimple();
	}
	
	public function adminWantsToShowMember()
	{							
		$this->pnr = $this->memberView->getMemberAdminWantsToShow();
		$memberToShow = $this->loginDAL->getMember($this->pnr);
		
		if($memberToShow != NULL){
			$this->memberToShow = $memberToShow;
		}
		else{
			$this->messageNr = $this->memberModel->unexistingPnr();
			$this->message = $this->messageView->setMessage($this->messageNr);
		}
		
		$this->HTMLPage->getShowMemberPage($this->message, $this->memberToShow);
	}
	
	public function adminWantsToUpdateMember()
	{							
		$this->pnr = $this->memberView->getMemberAdminWantsToUpdate();	
		$this->memberToShow = $this->loginDAL->getMember($this->pnr);
		
		if ($this->memberView->isUpdatingFirstName()){
			$fnValue = $this->memberView->getFirstName();
			$this->loginDAL->updateFirstNameMember($this->pnr, $fnValue);
		}		
		if ($this->memberView->isUpdatingLastName()){
			$lnValue = $this->memberView->getLastName();
			$this->loginDAL->updateLastNameMember($this->pnr, $lnValue);
		}
		if ($this->memberView->isUpdatingAddress()){
			$addressValue = $this->memberView->getAddress();
			$this->loginDAL->updateAddressMember($this->pnr, $addressValue);
		}
		if ($this->memberView->isUpdatingEmail()){
			$emailValue = $this->memberView->getEmail();
			
			if($this->checkModel->unvalidEmail($emailValue)){
				$this->messageNr = $this->memberModel->unvalidEmail();
			}
			else{
				$this->loginDAL->updateEmailMember($this->pnr, $emailValue);
				$this->messageNr = $this->memberModel->memberUpdated();
			}	
		}
		if ($this->memberView->isUpdatingPhonenr()){
			$phNrValue = $this->memberView->getPhonenr();
			$this->loginDAL->updatePhonenrMember($this->pnr, $phNrValue);
		}
		if($this->checkModel->unvalidEmail($emailValue) == FALSE){
			if ($this->memberView->isUpdatingClass()){
				$classValue = $this->memberView->getClass();
				
				if($this->checkModel->unvalidClass($classValue))
				{
					$this->messageNr = $this->memberModel->unvalidClass();
				}
				else{
					$this->loginDAL->updateClassMember($this->pnr, $classValue);
					$this->messageNr = $this->memberModel->memberUpdated();
				}
			}
		}
		
		if($this->checkModel->unvalidEmail($emailValue) == FALSE && $this->checkModel->unvalidClass($classValue) == FALSE){
			if ($this->memberView->isUpdatingPaydate()){
				$paydateValue = $this->memberView->getPaydate();
				
				if($this->checkModel->checkValidDateForUpdate($paydateValue)){
					$this->loginDAL->updatePaydateMember($this->pnr, $paydateValue);
					$this->messageNr = $this->memberModel->memberUpdated();
				}
				else{
					$this->messageNr = $this->checkModel->updatedDateFail();
				}			
			}
		}				
		
		$this->message = $this->messageView->setMessage($this->messageNr);	

		if($this->memberView->isSavingUpdatedMember() && $this->checkModel->checkValidDateForUpdate($paydateValue)
			&& $this->checkModel->unvalidClass($classValue) == FALSE && $this->checkModel->unvalidEmail($emailValue) == FALSE)
		{
			$this->messageNr = $this->memberModel->memberUpdated();
			$this->HTMLPage->getLoggedInPage($this->message);
		}
		else{
			$this->HTMLPage->getUpdateMemberPage($this->message, $this->memberToShow);
		}
	}

	public function adminWantsToShowMembers()
	{
		$this->numberOfMembers = $this->loginDAL->getNumberOfMembers($this->members);	
		$this->members = $this->loginDAL->getMembers();		
	}
	
	public function adminWantsToShowPayingMembers()
	{
		$this->numberOfMembers = $this->loginDAL->getNumberOfMembers($this->members);
		$this->members = $this->loginDAL->getPayingMembers();
	}
	
	public function adminWantsToShowNotPayingMembers()
	{
		$this->numberOfMembers = $this->loginDAL->getNumberOfMembers($this->members);
		$this->members = $this->loginDAL->getNotPayingMembers();
	}
}
