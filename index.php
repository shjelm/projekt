<?php

require_once dirname(__FILE__) . '/Controller/applicationController.php';

session_start();

$appController = new \controller\applicationController();

$appController->runApplication();