<?php

namespace controller;

require_once realpath(dirname(__DIR__)).'/View/messageView.php';
require_once realpath(dirname(__DIR__)).'/Model/loginModel.php';
require_once realpath(dirname(__DIR__)).'/Model/loginDAL.php';
require_once realpath(dirname(__DIR__)).'/Controller/masterController.php';



class loginController{
	
	/**
	 * @var int
	 */
	public $messageNr;
	
	/**
	 * @var string
	 */
	public $message;
	
	public function __construct()
	{
		$this->loginView = new \view\loginView();
		$this->messageView = new \view\messageView();
		$this->loginModel = new \model\loginModel();
		$this->loginDAL = new \model\loginDAL($mysqli);	
		
		
	}
	
	public function userWantsToLogin()
	{
		$this->masterController = new \controller\masterController();
		$username = $this->loginView->getUsername();
		$password =  $this->loginView->getPassword();
		
		$this->loggedIn = $this->stayLoggedin();
		
		$post = $this->loginView->checkFormSent();

		if ($this->loggedIn == false && $post || $this->memberLoggedIn == false && $post ){
			$this->messageNr = $this->loginModel->checkMessageNr($username, $password);
			
		}
		
		if($this->logOut()){
			$checkToLogout = $this->loginView->checkLogout();
			
			$this->messageNr = $this->loginModel->setLogout($checkToLogout);
		}
		$this->message = $this->messageView->setMessage($this->messageNr);
		$this->masterController->showPage($this->message);
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
	
	/**
	 * @param string
	 * @param string
	 * @param string
	 * @return bool
	 */
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
		
		$this->message = $this->messageView->setMessage($this->messageNr);
		
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
	
	/**
	 * @return bool
	 */	
	public function logIn()
	{		
		return $this->loginModel->checkLogin($this->loginView->getUsername(),$this->loginView->getPassword());
	}
}
