<?php
// Replace with your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "acrls_db";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // SQL query to retrieve user details based on the user ID
    $query = "SELECT * FROM users WHERE id = $userId";

    // Execute the query
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result->num_rows == 1) {
        // Fetch user details
        $user = $result->fetch_assoc();
    } else {
        // Handle the case where no user is found
        echo "User not found";
        exit;
    }
} else {
    // Handle the case where no user ID is provided in the URL
    echo "User ID not provided";
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated user details from the form
    $updatedFirstName = $_POST['first_name'];
    $updatedMiddleName = $_POST['middle_name'];
    $updatedLastName = $_POST['last_name'];
    $updatedUsernameOrEmail = $_POST['username_or_email'];

    // Update the user details in the database
    $updateQuery = "UPDATE users SET first_name = '$updatedFirstName', middle_name = '$updatedMiddleName', 
                    last_name = '$updatedLastName', username_or_email = '$updatedUsernameOrEmail' 
                    WHERE id = $userId";

    if ($conn->query($updateQuery) === TRUE) {
        echo "User details updated successfully";
    } else {
        echo "Error updating user details: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="post" action="">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>" required><br>

        <label for="middle_name">Middle Name:</label>
        <input type="text" name="middle_name" value="<?php echo $user['middle_name']; ?>"><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" required><br>

        <label for="username_or_email">Username or Email:</label>
        <input type="text" name="username_or_email" value="<?php echo $user['username_or_email']; ?>" required><br>

        <input type="submit" value="Update User">
    </form>
    <script>

    <!-- ./wrapper -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- SweetAlert 2 -->
<script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toaster -->
<script src="../assets/plugins/toastr/toastr.min.js"></script>
<!-- jQuery Mapael -->
<script src="../assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../assets/plugins/raphael/raphael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>
<!-- Font Aawesome -->
<script src="../assets/fontawesome/js/all.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/plugins/jszip/jszip.min.js"></script>
<script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    </script>
</body>
</html>
