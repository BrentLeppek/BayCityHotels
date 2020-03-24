<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</head>
    <body>
        <div class="container">
            <div class="row">
                <h3>Current Bookings</h3>
            </div>
            <div class="row">
                <a class="btn btn-success" href="booking_create.php">New Booking</a> <br />
            </div>    
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Room Description</th>
                            <th>Check In Date</th>
                            <th>Check Out Date</th>
                            <th>Price</th>
                            <th>Travelers</th>
                            <th>User</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include '../database/database.php'; 
                            $pdo = Database::connect();
                            $sql = 'SELECT * FROM bookings
                            LEFT JOIN users ON users.id = bookings.bookinguserid
                            LEFT JOIN rooms ON rooms.id = bookings.bookingroomid
                            ORDER BY roomname ASC';
                            foreach($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['roomname'] . '</td>';
                                echo '<td>'. $row['checkindate'] . '</td>';
                                echo '<td>'. $row['checkoutdate'] . '</td>';
                                echo '<td>'. $row['price'] . '</td>';
                                echo '<td>'. $row['travelers'] . '</td>';
                                echo '<td>'. $row['user'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn btn-secondary" href=booking_update.php?id='.$row['id'].'">Update</a>';
                                echo '<a class="btn btn-light" href=booking_delete.php?id='.$row['id'].'">Delete</a>';  
                                echo '</td>';
                                echo '</tr>';
                            }
                            Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a class="btn btn-primary" href="home.php">Home</a> <br />
    </body>
</html>