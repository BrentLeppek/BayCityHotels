<?php
	
require '../database/database.php';

$id = $_GET['id'];

if (!empty($_POST)) { // if $_POST filled then process the form


    //initalize input validation
    $roomError = null;
    $userError = null;
    $checkindateError = null;
    $checkoutdateError = null;
    $priceError = null;
    $travelersError = null;
	
    //$_POST variables
    $user = $_POST['user'];
    $room = $_POST['room'];
    $checkindate = $_POST['checkindate'];
    $checkoutdate = $_POST['checkoutdate'];
    $price = $_POST['price'];
    $travelers = $_POST['travelers'];
	
    //validate user input
    $valid = true;
    if(empty($user)) {
        $userError = 'Please choose a user';
        $valid = false;
    }
    if(empty($room)) {
        $roomError = 'Please choose a room';
        $valid = false;
    }
    if(empty($checkindate)) {
        $checkindateError = 'Please choose a check in date';
        $valid = false;
    }
    if(empty($checkoutdate)) {
        $checkoutdateError = 'Please choose a check out date';
        $valid = false;
    }
    if(empty($price)) {
        $priceError = 'Please choose a price';
        $valid = false;
    }
    if(empty($travelers)) {
        $travelersError = 'Please select how many travelers are staying';
        $valid = false;
    }
	
	if ($valid) { // if valid user input update the database
	
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE bookings set bookinguserid = ?, bookingroomid = ?, checkindate = ?, checkoutdate = ?, price = ?, travelers = ? WHERE bookingid = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($user, $room, $checkindate, $checkoutdate, $price, $travelers, $id));
		Database::disconnect();
		header("Location: bookings.php");
    }
}
?>