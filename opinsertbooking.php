<?php 

session_start();
if(!isset($_SESSION["users_id"])){ 
	session_destroy();
	header('Location: index.php');     
	exit;
}

require '../database/database.php';

if (!empty($_POST)) {

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

    //insert data
    if($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO bookings (bookinguserid, bookingroomid, checkindate, checkoutdate, price, travelers) values(?,?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($user,$room,$checkindate,$checkoutdate,$price,$travelers));
        Database::disconnect();
        header("Location: bookings.php");
    }
}