<?php

namespace controller;

require_once realpath(dirname(__DIR__)).'/View/loginView.php';
require_once realpath(dirname(__DIR__)).'/View/HTMLPage.php';
require_once realpath(dirname(__DIR__)).'/Controller/applicationController.php';
require_once realpath(dirname(__DIR__)).'/Controller/memberController.php';
require_once realpath(dirname(__DIR__)).'/Controller/registerController.php';
require_once realpath(dirname(__DIR__)).'/Controller/eventController.php';
require_once realpath(dirname(__DIR__)).'/Model/loginModel.php';
require_once realpath(dirname(__DIR__)).'/Model/loginDAL.php';
require_once realpath(dirname(__DIR__)).'/Model/member.php';
require_once realpath(dirname(__DIR__)).'/Model/event.php';

class masterController{
	
	public function __construct(){
		$this->loginController = new \controller\loginController();
		$this->loginView = new \view\loginView();
		$this->memberView = new \view\memberView();
		$this->eventView = new \view\eventView();
		$this->loginModel = new \model\loginModel();
		$this->HTMLPage = new \view\HTMLPage();
		$this->loginDAL = new \model\loginDAL();
		$this->memberController = new \controller\memberController();
		$this->registerController = new \controller\registerController();
		$this->eventController = new \controller\eventController();
	}

	/**
	 * @param string
	 */
	public function showPage($message)
	{
		if($this->loginController->logOut())
		{
			$this->HTMLPage->getLogOutPage($message);					
		}  
		 
		if($this->loginController->checkIfUserCanLogIn($this->loginDAL->getUserName(),$this->loginView->getUsername(),
		   $this->loginView->getPassword()) && $this->loginController->memberStayLoggedIn() ){

			$userInfo = $this->loginController->getUserInfoToShow();
			$username = $this->loginController->loginModel->getUsername();
			$this->HTMLPage->getLoggedInMemberPage($username, $userInfo, $this->loginController->message);		
		}
		else if($this->memberView->isAddingMember()&& $this->loginController->stayLoggedin())
		{
			$this->registerController->adminWantsToAddMember();
		}	
		else if($this->eventView->isShowingEvents()&& $this->loginController->stayLoggedin())
		{
			$this->eventController->showEvents();
		}
		else if($this->eventView->isShowingEvents() && $this->loginController->memberStayLoggedIn())	
		{
			$this->eventController->showSimpleEvents();
		}
		else if($this->eventView->isAddingEvent() && $this->loginController->stayLoggedin())
		{
			$this->eventController->adminWantsToAddEvent();				
		}
		else if($this->eventView->isUpdatingEvent() && $this->loginController->stayLoggedin()){
				
			$this->eventController->adminWantsToUpdateEvent();
		} 
		else if($this->eventView->isWantingToAddEvent() && $this->loginController->stayLoggedin())
		{
			$this->HTMLPage->getAddEventPage($this->message);
		}
		else if($this->eventView->isDeletingEvent() && $this->loginController->stayLoggedin()){
					
			$this->eventController->adminWantsToDeleteEvent();		
		} 
		else if($this->memberView->isShowingPayingMembers() && $this->loginController->stayLoggedin())
		{
			$this->memberController->adminWantsToShowPayingMembers();
			$this->HTMLPage->getShowMembersPage($this->memberController->numberOfMembers, $this->memberController->members);
		}
		else if($this->memberView->isShowingNotPayingMembers() && $this->loginController->stayLoggedin())
		{
			$this->memberController->adminWantsToShowNotPayingMembers();
			$this->HTMLPage->getShowMembersPage($this->memberController->numberOfMembers, $this->memberController->members);
		}	
		else if($this->memberView->isShowingMembers() && $this->loginController->stayLoggedin())
		{
			$this->memberController->adminWantsToShowMembers();
			$this->HTMLPage->getShowMembersPage($this->memberController->numberOfMembers,$this->memberController->members);
		}
		else if($this->memberView->isShowingMembersSimple() && $this->loginController->memberStayLoggedIn())
		{
			$this->memberController->memberWantsToShowMembers();
			$this->HTMLPage->getShowSimpleMembersPage($this->memberController->members);
		}	
		else if($this->loginView->isChangingPassword() && $this->loginController->memberStayLoggedIn()){
			$this->memberController->changePassword();
		}
		else if($this->loginView->isShowingChangingPassword() && $this->loginController->memberStayLoggedIn())
		{
			$this->HTMLPage->getChangePasswordPage('');
		}
		else if($this->memberView->isSearchingMember() && $this->loginController->stayLoggedin())
		{
			$this->memberController->adminWantsToShowMember();
		}	
		else if($this->memberView->isUpdatingMember() && $this->loginController->stayLoggedin()){
					
			$this->memberController->adminWantsToUpdateMember();			
		} 
		else if($this->memberView->isDeletingMember() && $this->loginController->stayLoggedin()){
					
			$this->memberController->adminWantsToDeleteMember();				
		} 
		else if($this->memberView->isWantingDeletingMember() && $this->loginController->stayLoggedin()){
					
			$pnr = $this->memberView->getMemberAdminWantsToDelete();			
			$this->HTMLPage->getDeleteMemberPage($this->message, $pnr);	
		} 
		else if ($this->loginController->memberStayLoggedIn()){			
			$userInfo = $this->loginController->getUserInfoToShow();
			$username = $this->loginModel->getUsername();
			$this->HTMLPage->getLoggedInMemberPage($username, $userInfo, $this->message);	
		}
		else if($this->loginController->logIn())
		{
			$this->HTMLPage->getLoggedInPage($message);
		}						
		else if($this->loginController->stayLoggedin())
		{
			$this->HTMLPage->getLoggedInPage($this->message);
		}				
		else 
		{	
			$this->HTMLPage->getPage($message);
		}	
	}
}