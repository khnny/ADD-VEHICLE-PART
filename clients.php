<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container my-5">
        <h2>List of clients</h2>
        <a class="btn btn-primary" href="/addVehicles/createNewClient.php" role="button">New client</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Vehicle type</th>
                    <th>Registration number</th>
                    <th>Slot occupied</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "database1";

                $connection= new mysqli($servername, $username, $password, $database);

                if($connection -> connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM clients";
                $result = $connection->query($sql);
                if (!$result) {
                    die("Invalid query: ". $connection->error);
                }

                while($row = $result->fetch_assoc()){
                    echo "
                        <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[vehicle_type]</td>
                    <td>$row[registration]</td>
                    <td>$row[slot_occupied]</td>
                    <td>$row[date]</td>
                    <td>
                            <a class='btn btn-primary btn-sm' href='/addVehicles/editClient.php?id=$row[id]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href='/addVehicles/delete.php?id=$row[id]'>Delete</a>
                        </td>                  
                </tr>   
                    ";
                }
                ?>
            </tbody>

        </table>
    </div>

    
</body>
</html>