<?php

namespace controller;

require_once realpath(dirname(__DIR__)).'/View/loginView.php';
require_once realpath(dirname(__DIR__)).'/View/HTMLPage.php';
require_once realpath(dirname(__DIR__)).'/Model/loginModel.php';
require_once realpath(dirname(__DIR__)).'/Model/loginDAL.php';
require_once realpath(dirname(__DIR__)).'/Model/member.php';

class loginController{
	/**
	 * @var \view\loginView
	 */
	private $loginView;
	
	/**
	 * @var \view\HTMLPage
	 */
	private $HTMLPage;
	
	/**
	 * @var \model\loginModel
	 */
	private $loginModel;
	
	/**
	 * @var \model\loginDAL
	 */
	private $loginDAL;
	
	/**
	 * @var string
	 */
	private $username;
	
	/**
	 * @var string
	 */
	private $password;
	
	/**
	 * @var int
	 */
	private $messageNr;
	
	/**
	 * @var string
	 */
	private $message;
	
	/**
	 * @var bool
	 */
	private $loggedIn;
	
	/**
	 * @var string
	 */
	private $browser; 
	
	/**
	 * @var bool
	 */
	private $saveCredentials;
	
	/**
	 * @var bool
	 */
	private $post;
	
	/**
	 * @var bool
	 */
	private $autoLogin;
	
	/**
	 * @var string
	 */
	private $cryptedPassword; 
	
	/**
	 * @var bool
	 */
	private $browserUsed;
	
	/**
	 * @var array
	 */
	private $members;
	
	/**
	 * @var array
	 */
	private $memberToShow;
	
	private $memberToUpdate;
	
	public function __construct()
	{
		$this->loginView = new \view\loginView();
		$this->loginModel = new \model\loginModel();
		$this->HTMLPage = new \view\HTMLPage();
		$this->loginDAL = new \model\loginDAL();
	}
	
	public function userWantsToLogin()
	{
		$this->username = $this->loginView->getUsername();
		$this->password =  $this->loginView->getPassword();
		
		$this->loggedIn = $this->stayLoggedin();
		$this->browserUsed = $this->loginModel->checkBrowserUsed();
		
		$this->saveCredentials = $this->loginView->canSaveCredentials();
		
		$this->post = $this->loginView->checkFormSent();
		
		$this->loginModel->getBrowser();
		
		$this->browser = $this->loginModel->checkBrowser();
		
		$this->logOut();
		
		$this->checkStayLoggedIn();	
		if($this->logOut() == false){			
			
		
			if($this->saveCredentials &&$this->correctSavedCredentials() == false 
			   && $this->loggedIn == false && $this->browserUsed == false)
			{			
				if(!$this->browserUsed || !$this->loggedIn)
				{
					$this->messageNr = $this->loginModel->validSavedCredentialsMsg();
				}
				else{
					
					$this->messageNr = $this->loginModel->noMsg();
				}
			}	
			if ($this->saveCredentials && $this->correctSavedCredentials() && $this->loggedIn == false){
				$this->messageNr = $this->loginModel->setMsgSaveCredentials($this->saveCredentials);							
			}			
			if ($this->saveCredentials == false && $this->loggedIn == false && $this->post){
				
				$this->messageNr = $this->loginModel->checkMessageNr($this->username, $this->password);
			}
		}
		
		$this->message = $this->loginView->setMessage($this->messageNr);
		
		if($this->logOut())
		{
			$this->loginView->destroyCredentials();
		}
		$this->showPage();
	}

	public function adminWantsToAddMember()
	{
		$newMember = $this->loginView->setMember();
		$member = new \model\member($newMember[0], $newMember[1],
								$newMember[2], $newMember[3],
								$newMember[4], $newMember[5],
								$newMember[6]);
		
		$pnr = $member->getPersonalNr();
		$existingPnr = $this->loginDAL->getMemberToShow($pnr);
		
		if($this->loginView->checkFormSent() && !isset($existingPnr)){
			$this->messageNr = $this->loginModel->checkUnvalidNewMember($member);
			$this->message = $this->loginView->setMessage($this->messageNr);
		}
		else if($this->loginView->checkFormSent() && isset($existingPnr)){
			$this->messageNr = $this->loginModel->alreadyExistingPnr();
			$this->message = $this->loginView->setMessage($this->messageNr);
		}
		
		if($this->loginModel->checkNewMemberValid($member) && !isset($existingPnr)){
			$this->loginDAL->addMember($member);			
		}		
	}
	
	public function adminWantsToShowMembers()
	{
		$newRow = $this->loginView->getNewRow();		
		$this->members = $this->loginDAL->getMembers($newRow);
		
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
	}
	
	public function adminWantsToUpdateMember()
	{							
		$pnr = $this->loginModel->getPnr();
		
		if ($this->loginView->isUpdatingName()){
			$value = $this->loginView->getName();
			$this->memberToUpdate = $this->loginDAL->updateNameMember($pnr, $value);
		}
		if ($this->loginView->isUpdatingAddress()){
			$value = $this->loginView->getAddress();
			$this->memberToUpdate = $this->loginDAL->updateAddressMember($pnr, $value);
		}
		if ($this->loginView->isUpdatingEmail()){
			$value = $this->loginView->getEmail();
			$this->memberToUpdate = $this->loginDAL->updateEmailMember($pnr, $value);	
		}
		if ($this->loginView->isUpdatingPhonenr()){
			$value = $this->loginView->getPhonenr();
			$this->memberToUpdate = $this->loginDAL->updatePhonenrMember($pnr, $value);
		}
		if ($this->loginView->isUpdatingClass()){
			$value = $this->loginView->getClass();
			$this->memberToUpdate = $this->loginDAL->updateClassMember($pnr, $value);
		}
		if ($this->loginView->isUpdatingPaydate()){
			$value = $this->loginView->getPaydate();
			$this->memberToUpdate = $this->loginDAL->updatePaydateMember($pnr, $value);
		}		
		
		if($this->loginView->isSavingUpdatedMember())
		{
			$this->messageNr = $this->loginModel->memberUpdated();
			$this->message = $this->loginView->setMessage($this->messageNr);	
		}
	}
	
	/**
	 * @return array
	 */
	public function getUserInfoToShow()
	{
		$user = $this->loginView->getUserName();
		$this->loginDAL->getUserToShow($user);
		return $this->loginDAL->getUserInfo($user);
	}
	
	public function showPage()
	{
		if($this->logOut())
		{
			$this->HTMLPage->getLogOutPage($this->message);				
			
		}
		if( $this->loginModel->checkIfUserCanLogIn($this->loginDAL->getUserName(),$this->loginView->getUsername(),
		$this->loginView->getPassword()) || $this->memberStayLoggedIn()){
			$userInfo = $this->getUserInfoToShow();
			$this->HTMLPage->getLoggedInMemberPage($this->loginView->getUserName(), $userInfo);			
		}
		else if($this->loginView->canSaveCredentials() && $this->loggedIn != true && $this->correctSavedCredentials())
		{
			$this->HTMLPage->getLoggedInPage($this->message);
			
		}	
		else if($this->loginView->isAddingMember()&& $this->stayLoggedin())
		{
			$this->adminWantsToAddMember();
			$this->HTMLPage->getAddMemberPage($this->message);
		}	
		else if($this->loginView->isShowingMember()&& $this->stayLoggedin())
		{
			$this->HTMLPage->getShowMemberPage($this->message,'');
		}	
		else if($this->loginView->isShowingMembers() && $this->stayLoggedin())
		{
			$this->adminWantsToShowMembers();
			$this->HTMLPage->getShowMembersPage($this->members);
		}	
		else if($this->loginView->isShowingMembersSimple())
		{
			$this->memberWantsToShowMembers();
			$this->HTMLPage->getShowMembersPage($this->members);
		}	
		else if($this->loginView->isSearchingMember() && $this->stayLoggedin())
		{
			$this->adminWantsToShowMember();			
			$this->HTMLPage->getShowMemberPage($this->message, $this->memberToShow);
			
		}	
		else if($this->loginView->isUpdatingMember() && $this->stayLoggedin()){
					
				$this->adminWantsToUpdateMember();
				$pnr = $this->loginModel->getPnr();
				$this->HTMLPage->getUpdateMemberPage($this->message, $pnr);	
				
		} 
		else if($this->browser != true)
		{
			$this->HTMLPage->getPage($this->message);
		}	
		else if($this->logIn())
		{
			$this->HTMLPage->getLoggedInPage($this->message);
		}						
		else if($this->stayLoggedin())
		{
			$this->HTMLPage->getLoggedInPage($this->message);
		}
		else if($this->memberStayLoggedIn())
		{
			$this->HTMLPage->getLoggedInMemberPage($this->message);
		}
		else 
		{	
			$this->loginView->destroyCredentials();
			$this->HTMLPage->getPage($this->message);
		}	
	}
	
	/**
	 * @return bool
	 */
	public function logOut()
	{
		$checkToLogout = $this->loginView->checkLogout();
		
		$this->messageNr = $this->loginModel->setLogout($checkToLogout);
		
		return ($this->loginModel->checkLogout($checkToLogout));
	}
	
	/**
	 * @return bool
	 */
	public function stayLoggedin()
	{
		return $this->loginModel->checkLoggedIn();
	}
	
	public function memberStayLoggedIn()
	{		
		return $this->loginModel->checkMemberLoggedIn($this->loginView->getUserName(), $this->loginView->getPassword());
	}
	public function checkStayLoggedIn()
	{
		$autoLogin = $this->loginView->checkAutoLogin();
		if($autoLogin && $this->logIn()){
			$this->loginModel->saveEndTime();
			$endTime = $this->loginModel->getEndTime();
		
			$this->loginView->autoLogin($this->username, $this->password, $endTime);
			
			$pass = $this->loginView->getCryptedPassword();		
		}
	}
	
	/**
	 * @return bool
	 */	
	public function logIn()
	{
		return $this->loginModel->checkLogin($this->username, $this->password);
	}
	
	/**
	 * @return bool
	 */	
	public function correctSavedCredentials()
	{
		$endTime = $this->loginModel->getEndTime();
		if($this->loginView->correctSavedCredentials($this->loginModel->getUser(), $endTime)){
			return true;
		}
		else {
			return false;
		}
	}
}
