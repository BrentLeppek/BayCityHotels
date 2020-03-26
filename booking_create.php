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
$sql = "SELECT * FROM users WHERE id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
Database::disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</head>

<body>
  <div class="container">
    <div class="span10 offest1">
      <div class="row">
        <h3>Create a Booking</h3>
      </div>

      <form  class="form-horizontal" action="opinsertbooking.php" method="post">
      <div class="control-group">
          <label class="control-label">User</label>
          <div class="controls">
            <?php
              $pdo = Database::connect();
              $sql = 'SELECT * FROM users ORDER BY lname ASC';
              echo "<select class='form-control' name='user' id='user_id'>";
              foreach($pdo->query($sql) as $row) {
                echo "<option value='" . $row['id'] . " '> " . $row['fname'] . " " .  $row['lname'] . "</option>";
              }
              echo "</select>";
              Database::disconnect();
            ?> 
        </div>  
        <div class="control-group">
          <label class="control-label">Room</label>
          <div class="controls">
            <?php
              $pdo = Database::connect();
              $sql = 'SELECT * FROM rooms ORDER BY roomname ASC';
              echo "<select class='form-control' name='room' id='room_id'>";
              foreach($pdo->query($sql) as $row) {
                echo "<option value='" . $row['id'] . " '> " . $row['roomname'] .  " capacity: " .  $row['roomcapacity'] . "</option>";
              }
              echo "</select>";
              Database::disconnect();
            ?>
          </div>       
          <div class="control-group <?php echo !empty($checkindateError)?'error':'';?>">
            <label class="control-label">Check In Date</label>
            <div class="controls">
              <input name="checkindate" type="date" value="<?php echo !empty($checkindate)?$checkindate:'';?>">
              <?php if (!empty($checkindateError)): ?>
                <span class="help-inline"><?php echo $checkindateError;?></span>
              <?php endif;?>
            </div>
          </div>
          <div class="control-group <?php echo !empty($checkoutdateError)?'error':'';?>">
            <label class="control-label">Check Out Date</label>
            <div class="controls">
              <input name="checkoutdate" type="date" value="<?php echo !empty($checkoutdate)?$checkoutdate:'';?>">
              <?php if (!empty($checkoutdateError)): ?>
                <span class="help-inline"><?php echo $checkoutdateError;?></span>
              <?php endif;?>
            </div>
          </div> 
          <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
            <label class="control-label">Price</label>
            <div class="controls">
              <input name="price" type="number" value="<?php echo !empty($price)?$price:'';?>">
              <?php if (!empty($priceError)): ?>
                <span class="help-inline"><?php echo $priceError;?></span>
              <?php endif;?>
            </div>
          </div>
          <div class="control-group <?php echo !empty($travelersError)?'error':'';?>">
            <label class="control-label">Number of Travelers</label>
            <div class="controls">
              <input name="travelers" type="number" value="<?php echo !empty($travelers)?$travelers:'';?>">
              <?php if (!empty($travelersError)): ?>
                <span class="help-inline"><?php echo $travelersError;?></span>
              <?php endif;?>
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-success">Create</button>
            <a class="btn" href="home.php">Back</a>
          </div>     
      </form>


    </div>
  </div>  
</body>