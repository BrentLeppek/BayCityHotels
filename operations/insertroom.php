<?php
     
    require '../database/database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $phoneError = null;
        $addressError = null;
        $capacityError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $capacity = $_POST['capacity'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }         
         
        if (empty($phone)) {
            $phoneError = 'Please enter Phone Number';
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
            $sql = "INSERT INTO rooms (name,phone,address,capacity) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$phone,$address,$capacity));
            Database::disconnect();
            header("Location: room_view.php");
        }
    }
?>