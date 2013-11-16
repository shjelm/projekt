<?php

namespace controller;

require_once realpath(dirname(__DIR__))."/View/loginView.php";
require_once realpath(dirname(__DIR__))."/Controller/loginController.php";


class ApplicationController{
	
	/**
	 * @var \view\loginView
	 */
	private $LoginView;
	
	/**
	 * @var \view\loginController
	 */
	private $LoginController;
	
	public function __construct($mysqli){
		$this->LoginView = new \view\loginView();
		$this->LoginController = new \controller\loginController($mysqli);
	}
	
	public function runApplication()
	{
			$this->LoginController->userWantsToLogin();
	}
	
	
}