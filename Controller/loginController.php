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


class loginController{
        
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
	public $messageNr;
	
	/**
	 * @var string
	 */
	public $message;
	
	/**
	 * @var bool
	 */
	private $loggedIn;
	
	/**
	 * @var string
	 */
	public $browser; 
	
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
	
	/**
	 * @var array
	 */
	private $numberOfMembers; 
	
	/**
	 * @var string
	 */
	private $notClickable = 'false';
	
	/**
	 * @var string
	 */
	private $clickable = 'true';
	
	/**
	 * @var \model\event
	 */
	private $event;
	
	/**
	 * @var array
	 */
	private $events;
	
	/**
	 * @var array
	 */
	private $eventToShow;
	
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
	
	public function userWantsToLogin()
	{
		$this->masterController = new \controller\masterController($mysqli);
		$this->username = $this->loginView->getUsername();
		$this->password =  $this->loginView->getPassword();
		
		$this->loggedIn = $this->stayLoggedin();
		//$this->browserUsed = $this->loginModel->checkBrowserUsed();
		
		//$this->saveCredentials = $this->loginView->canSaveCredentials();
		
		$this->post = $this->loginView->checkFormSent();
		
		$this->loginModel->getBrowser();
		
		$this->browser = $this->loginModel->checkBrowser();
		
		$this->logOut();
		
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
		else{
			$this->loginView->destroyCredentials();
		}
		$this->message = $this->loginView->setMessage($this->messageNr);
		
		$this->masterController->showPage();
	}
	
	

	/**
	 * @return array
	 */
	public function getUserInfoToShow()
	{
		$user = $this->loginView->getUserName();
		
		if($this->loginView->checkFormSent()){
			$this->loginModel->saveUsername($user);
		}
		
		$user = $this->loginModel->getUsername();
		$username =  $this->loginDAL->getUserToShow($user);
		
		return $this->loginDAL->getUserInfo($username);
	}
	
	public function checkIfUserCanLogIn($correctUsername, $username, $password)
	{
		if($this->loginModel->checkIfUserExists($correctUsername ,$username, $password)){
			$this->loginModel->userCanLogIn();
			return true;
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
	
	/**
	 * @return bool
	 */
	public function memberStayLoggedIn()
	{
		return $this->loginModel->checkMemberLoggedIn();
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
		return $this->loginModel->checkLogin($this->loginView->getUsername(),$this->loginView->getPassword());
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
