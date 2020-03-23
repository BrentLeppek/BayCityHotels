<?php
session_start();
if(!isset($_SESSION["users_id"])){ 
	session_destroy();
	header('Location: login.php');     
	exit;
}
	
require '../database/database.php';

$id = $_GET['id'];

if (!empty($_POST)) { // if $_POST filled then process the form


	// initialize user input validation variables
	$roomnameError = null;
	$roomphoneError = null;
	$roomaddressError = null;
	$roomcapacityError = null;
	
	// initialize $_POST variables
	$roomname = $_POST['roomname'];
	$roomphone = $_POST['roomphone'];
	$roomaddress = $_POST['roomaddress'];
	$roomcapacity = $_POST['roomcapacity'];
	

	// validate user input
	$valid = true;
	if (empty($roomname)) {
		$roomnameError = 'Please enter Room Name';
		$valid = false;
	}
	if (empty($roomphone)) {
		$roomphoneError = 'Please enter Phone Number';
		$valid = false;
	}

	if (empty($roomaddress)) {
		$roomaddressError = 'Please enter Room Address';
		$valid = false;
	}

	if (empty($roomcapacity)) {
		$roomcapacityError = 'Please enter Mobile Number (or "none")';
		$valid = false;
	}
	
	if ($valid) { // if valid user input update the database
	
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE rooms set roomname = ?, roomphone = ?, roomaddress = ?, roomcapacity = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($roomname, $roomphone, $roomaddress, $roomcapacity, $id));
		Database::disconnect();
		header("Location: room_view.php");

	}
} else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM rooms where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$roomname = $data['roomname'];
	$roomphone = $data['roomphone'];
    $roomaddress = $data['roomaddress'];
    $roomcapacity = $data['roomcapacity'];
	Database::disconnect();
}
?>

