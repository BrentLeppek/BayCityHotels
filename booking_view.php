<?php
session_start();
if(!isset($_SESSION["users_id"])){ // if "user" not set,
	session_destroy();
	header('Location: index.php');   // go to login page
	exit;
}

require '../database/database.php';

$id = $_GET['id']; // for user
$sessionid = $_SESSION['users_id'];

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Select Bookings
$sql = "SELECT * FROM bookings WHERE bookingid = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);

//Select Users
$sql = "SELECT * FROM users WHERE id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($data['bookinguserid']));
$userdata = $q->fetch(PDO::FETCH_ASSOC);

//Select rooms
$sql = "SELECT * FROM rooms WHERE id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($data['bookingroomid']));
$roomdata = $q->fetch(PDO::FETCH_ASSOC);


Database::disconnect();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</head>
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>View a Booking</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <h5>User</h5>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $userdata['fname'] . " " . $userdata['lname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <h5>Room</h5>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $roomdata['roomname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <h5>Check In Date</h5>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['checkindate'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <h5>Check Out Date</h5>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['checkoutdate'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <h5>Price</h5>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['price'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <h5>Travelers</h5>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['travelers'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn btn-danger" href="bookings.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>