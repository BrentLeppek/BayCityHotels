<?php
session_start();
if(!isset($_SESSION["users_id"])){ // if "user" not set,
	session_destroy();
	header('Location: index.php');   // go to login page
	exit;
}
$id = $_GET['id']; // for user
$sessionid = $_SESSION['users_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</head>

<body>

    <h1>Welcome <?php echo $fname . " " .  $lname; ?>  </h1>

</body>