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
                <h3>Rooms</h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name/Description</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Room Capacity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include '../database/database.php'; 
                            $pdo = Database::connect();
                            $sql = 'SELECT * FROM rooms ORDER BY name DESC';
                            foreach($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['name'] . '</td>';
                                echo '<td>'. $row['phone'] . '</td>';
                                echo '<td>'. $row['address'] . '</td>';
                                echo '<td>'. $row['capacity'] . '</td>';
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