<?php 

session_start();
if(!isset($_SESSION["users_id"])){ 
	session_destroy();
	header('Location: index.php');     
	exit;
}

require '../database/database.php';

if ( !empty($_POST)) { 

	// initialize user input validation variables
	$nameError = null;
	$phoneError = null;
	$addressError = null;
	$capacityError = null;
	
	// initialize $_POST variables
	$name = $_POST['roomname'];
	$phone = $_POST['roomphone'];
	$address = $_POST['roomaddress'];
	$capacity = $_POST['roomcapacity'];		
	
	// validate user input
	$valid = true;
	if (empty($name)) {
		$nameError = 'Please enter Name';
		$valid = false;
	}
	if (empty($phone)) {
		$phoneError = 'Please enter Phone';
		$valid = false;
	} 		
	if (empty($address)) {
		$addressError = 'Please enter Address';
		$valid = false;
	}		
	if (empty($capacity)) {
		$capacityError = 'Please enter Capacity';
		$valid = false;
	}

	// insert data
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO rooms (roomname, roomphone, roomaddress, roomcapacity) values(?, ?, ?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($name,$phone,$address,$capacity));
		Database::disconnect();
		header("Location: room_view.php");
	}
}
?>