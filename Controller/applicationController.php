<?php

namespace controller;

require_once realpath(dirname(__DIR__))."/Controller/loginController.php";


class ApplicationController{
	
	/**
	 * @var \view\loginController
	 */
	private $LoginController;
	
	public function __construct(){
		$this->LoginController = new \controller\loginController();
	}
	
	public function runApplication()
	{
			$this->LoginController->userWantsToLogin();
	}	
}