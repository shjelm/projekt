<?php

namespace controller;

require_once realpath(dirname(__DIR__)).'/View/loginView.php';
require_once realpath(dirname(__DIR__)).'/View/HTMLPage.php';
require_once realpath(dirname(__DIR__)).'/Model/loginModel.php';
require_once realpath(dirname(__DIR__)).'/Model/loginDAL.php';
require_once realpath(dirname(__DIR__)).'/Model/user.php';

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
		$newUser = $this->loginView->setUser();
		$user = new \model\user($newUser[0], $newUser[1],
								$newUser[2], $newUser[3],
								$newUser[4], $newUser[5],
								$newUser[6]);
		$this->loginDAL->addUser($user);
	}
	
	public function showPage()
	{
		if($this->logOut())
		{
			$this->HTMLPage->getLogOutPage($this->message);				
			
		}
		if($this->loginView->canSaveCredentials() && $this->loggedIn != true && $this->correctSavedCredentials())
		{
			$this->HTMLPage->getLoggedInPage($this->message);
			
		}	
		else if($this->loginView->isShowingMembers())
		{
			$this->HTMLPage->getShowMemberPage();
		}	
		else if($this->loginView->isAddingMember())
		{
			$this->HTMLPage->getAddMemberPage();
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
