<?php
require_once "../models/function.php";
$DBobj=new Backup();


    if(isset($_POST['backup'])){

		$server = $_POST['server'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$dbname = $_POST['dbname'];

		$rspta=$DBobj->backDb($server, $username, $password, $dbname);
		exit();
				
	}

?>