<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "database1";

// Create a connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$vehicle_type = "";
$registration = "";
$slot_occupied = "";
$date = "";

$errorMessage = ""; // Corrected typo
$successMessage = "";

// Get the id from the URL if it exists
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch client information from the database
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /addVehicles/clients.php");
        exit;
    }

    $name = $row["name"];
    $vehicle_type = $row["vehicle_type"];
    $registration = $row["registration"];
    $slot_occupied = $row["slot_occupied"];
    $date = $row["date"];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"]; // Get the id from the form
    $name = $_POST["name"];
    $vehicle_type = $_POST["vehicle_type"];
    $registration = $_POST["registration"];
    $slot_occupied = $_POST["slot_occupied"];
    $date = $_POST["date"];

    do {
        if (empty($id) || empty($name) || empty($vehicle_type) || empty($registration) || empty($slot_occupied) || empty($date)) {
            $errorMessage = "ALL the fields are required"; // Corrected typo
            break;
        }

        $sql = "UPDATE clients 
                SET name = '$name', vehicle_type = '$vehicle_type', registration = '$registration', slot_occupied = '$slot_occupied', date = '$date'
                WHERE id = $id";

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error; // Corrected typo
            break;
        }

        $successMessage = "Client info updated correctly";

        // Redirect to clients.php after the success message is set
        // header("location: /addVehicles/clients.php"); 
        // exit; // Remove exit; 

    } while (false);
}

?>

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
        <h2>Edit Client</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class = 'alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button'class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
                ";
        }
        ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Vehicle_type</label>
                <div class="col-sm-6">
                    <select type="options" class="form-control" name="vehicle_type" value="<?php echo $vehicle_type; ?>">
                      <option value="4wheeler">4wheeler</option>
                      <option value="2wheeler">2wheeler</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Registration</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="registration" value="<?php echo $registration; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Slot occupied</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="slot_occupied" value="<?php echo $slot_occupied; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="date" value="<?php echo $date; ?>">
                </div>
            </div>

            <?php
             if ( !empty($successMessage) ){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-3'>
                        <div class = 'alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button'class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div> 
                    </div>
                </div>
                ";
             }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-outline-primary">submit</button>    
                </div>
                <div class="col-sm-3 d-grid">
                   <a class="btn btn-outline-primary" href="/addVehicles/clients.php" role="button">Cancel</a>    
                </div>
            </div>


        </form>

    </div>

</body>
</html>