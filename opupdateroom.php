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
	$roomimageError = null;
	
	// initialize $_POST variables
	$roomname = $_POST['roomname'];
	$roomphone = $_POST['roomphone'];
	$roomaddress = $_POST['roomaddress'];
	$roomcapacity = $_POST['roomcapacity'];
	$roomimage = $_POST['roomimage'];

	//initalize $_FILES variables
	$roomimage = $_FILES['roomimage']['name'];
	$tmpName  = $_FILES['roomimage']['tmp_name'];
	$filecontent = file_get_contents($tmpName);
	$fileSize = $_FILES['roomimage']['size'];
	$filetype = $_FILES['roomimage']['type'];
	

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

	//restrict types of files for upload
	$types = array('image/jpeg','image/gif','image/png');
	if($filesize > 0) {
		if(in_array($_FILES['userfile']['type'], $types)) {
		}
		else {
			$filename = null;
			$filetype = null;
			$filesize = null;
			$filecontent = null;
			$pictureError = 'improper file type';
			$valid=false;
		}	
	}	
	
	if ($valid) { // if valid user input update the database
	
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE rooms set roomname = ?, roomphone = ?, roomaddress = ?, roomcapacity = ?, filecontent = ?, filetype = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($roomname, $roomphone, $roomaddress, $roomcapacity, $id, $filecontent, $filetype));
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

