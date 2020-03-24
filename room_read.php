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
$sql = "SELECT * FROM rooms WHERE id = ?";
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
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
                        <h3>View a Room</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['roomname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Phone Number</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['roomphone'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Room Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['roomaddress'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Room Capacity</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['roomcapacity'];?>
                            </label>
                        </div>
                      </div>
                    <div class='control-group col-md-6'>
					    <div class="controls ">
					    <?php 
					    if ($data['filesize'] > 0) 
						    echo '<img  height=5%; width=15%; src="data: filetype;base64,' . 
							base64_encode( $data['filecontent'] ) . '" />'; 
					    else 
						    echo 'No photo on file.';
					    ?><!-- converts to base 64 due to the need to read the binary files code and display img -->
					    </div>
				    </div>
                        <div class="form-actions">
                          <a class="btn btn-danger" href="room_view.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>