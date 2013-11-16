<?php

require_once dirname(__FILE__) . '/Controller/applicationController.php';
require_once dirname(__FILE__) . '/View/HTMLPage.php';

session_start();

$mysqli = new \mysqli("register-185594.mysql.binero.se", "185594_zh40528", "lolipoP19", "185594-register");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
//$loginModel = new \model\loginModel($mysqli);
//$loginController = new \controller\loginController($mysqli);
$appController = new \controller\applicationController($mysqli);
//$loginDAL = new \model\loginDAL($mysqli);
//$eventDAL = new \model\eventDAL($mysqli);

$mysqli->close();

$appController->runApplication();