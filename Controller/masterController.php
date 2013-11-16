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
require_once realpath(dirname(__DIR__)).'/Model/memberModel.php';
require_once realpath(dirname(__DIR__)).'/Model/eventModel.php';
require_once realpath(dirname(__DIR__)).'/Model/checkModel.php';
require_once realpath(dirname(__DIR__)).'/Model/eventDAL.php';

class masterController{
	
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
		$this->eventController = new \controller\eventController($mysqli);
	}

	public function showPage()
	{
		if($this->loginController->logOut())
		{
			$this->HTMLPage->getLogOutPage($this->loginController->message);					
		}  
		 
		if($this->loginController->checkIfUserCanLogIn($this->loginDAL->getUserName(),$this->loginView->getUsername(),
		   $this->loginView->getPassword()) && $this->loginController->memberStayLoggedIn() ){

			$userInfo = $this->loginController->getUserInfoToShow();
			$username = $this->loginController->loginModel->getUsername();
			$this->HTMLPage->getLoggedInMemberPage($username, $userInfo, $this->loginController->message);		
		}
		//@TODO:Här ska det fixas. har delat upp i olika filer men inte mer sen
		else if($this->loginView->isAddingMember()&& $this->loginController->stayLoggedin())
		{
			$this->registerController->adminWantsToAddMember();
		}	
		else if($this->loginView->isShowingEvents()&& $this->loginController->stayLoggedin() 
				|| $this->loginView->isShowingEvents() && $this->loginController->memberStayLoggedIn())	
		{
			$this->eventController->showEvents();
		}
		else if($this->loginView->isSearchingEvent() && $this->loginController->stayLoggedin()){
			$this->eventController->adminWantsToShowEvent();
			
		}
		else if($this->loginView->isAddingEvent() && $this->loginController->stayLoggedin())
		{
			$this->eventController->adminWantsToAddEvent();
				
		}
		else if($this->loginView->isUpdatingEvent() && $this->loginController->stayLoggedin()){
				
				$this->eventController->adminWantsToUpdateEvent();
					
				
		} 
		else if($this->loginView->isWantingToAddEvent() && $this->loginController->stayLoggedin())
		{
			$this->HTMLPage->getAddEventPage($this->message);
		}
		else if($this->loginView->isWantingToUpdateEvent() && $this->loginController->stayLoggedin()){
			$this->HTMLPage->getShowEventPage('',$this->eventToShow,$this->notClickable);
		}
		else if($this->loginView->isDeletingEvent() && $this->loginController->stayLoggedin()){
					
				$this->eventController->adminWantsToDeleteEvent();
				
				
		} 
		else if($this->loginView->isShowingMember()&& $this->loginController->stayLoggedin())
		{
			$this->HTMLPage->getShowMemberPage('','', $this->notClickable);
		}	
		else if($this->loginView->isShowingPayingMembers() && $this->loginController->stayLoggedin())
		{
			$this->memberController->adminWantsToShowPayingMembers();
			$this->HTMLPage->getShowMembersPage($this->memberController->numberOfMembers, $this->memberController->members);
		}
		else if($this->loginView->isShowingNotPayingMembers() && $this->loginController->stayLoggedin())
		{
			$this->memberController->adminWantsToShowNotPayingMembers();
			$this->HTMLPage->getShowMembersPage($this->memberController->numberOfMembers, $this->memberController->members);
		}	
		else if($this->loginView->isShowingMembers() && $this->loginController->stayLoggedin())
		{
			$this->memberController->adminWantsToShowMembers();
			$this->HTMLPage->getShowMembersPage($this->memberController->numberOfMembers,$this->memberController->members);
		}
		
		else if($this->loginView->isShowingMembersSimple() && $this->loginController->memberStayLoggedIn())
		{
			$this->memberWantsToShowMembers();
			$this->HTMLPage->getShowSimpleMembersPage($this->members);
		}	
		else if($this->loginView->isChangingPassword() && $this->loginController->memberStayLoggedIn()){
			$this->changePassword();
			$this->HTMLPage->getChangePasswordPage($this->message);
		}
		else if($this->loginView->isShowingChangingPassword() && $this->loginController->memberStayLoggedIn())
		{
			$this->HTMLPage->getChangePasswordPage('');
		}
		else if($this->loginView->isSearchingMember() && $this->loginController->stayLoggedin())
		{
			$this->memberController->adminWantsToShowMember();
			
			
		}	
		else if($this->loginView->isUpdatingMember() && $this->loginController->stayLoggedin()){
					
				$this->adminWantsToUpdateMember();
				$pnr = $this->loginModel->getPnr();
				$this->HTMLPage->getUpdateMemberPage($this->message, $pnr);	
				
		} 
		else if($this->loginView->isDeletingMember() && $this->loginController->stayLoggedin()){
					
				$this->adminWantsToDeleteMember();
				$pnr = $this->loginModel->getPnr();
				$this->HTMLPage->getLoggedInPage($this->message);
				
		} 
		else if($this->loginView->isWantingDeletingMember() && $this->loginController->stayLoggedin()){
					
				$pnr = $this->loginModel->getPnr();				
				$this->HTMLPage->getDeleteMemberPage($this->message, $pnr);	
		} 
		else if ($this->loginController->memberStayLoggedIn()){			
			$userInfo = $this->getUserInfoToShow();
			$username = $this->loginModel->getUsername();
			$this->HTMLPage->getLoggedInMemberPage($username, $userInfo, $this->message);	
		}
		/**else if($this->loginController->browser != true)
		{
			$this->HTMLPage->getPage($this->message);
		}	*/
		else if($this->loginController->logIn())
		{
			$this->HTMLPage->getLoggedInPage($this->loginController->message);
		}						
		else if($this->loginController->stayLoggedin())
		{
			$this->HTMLPage->getLoggedInPage($this->message);
		}
		else 
		{	
			$this->loginView->destroyCredentials();
			$this->HTMLPage->getPage($this->message);
		}	
	}
}