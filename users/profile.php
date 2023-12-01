<?php
include("header.php");

// Assuming you have a database connection established earlier
// Make sure to replace the database credentials with your actual credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acrls_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$usersFirstName = $usersMiddleName = $usersLastName = $usersUsernameOrEmail = $profilePhoto = "";

// Function to handle file upload
function uploadProfilePhoto($userId, $conn) {
    $targetDir = "../uploads/"; // Change this to your desired upload directory
    $targetFile = $targetDir . basename($_FILES["profilePhoto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profilePhoto"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {    
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["profilePhoto"]["size"] > 5000  ) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["profilePhoto"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["profilePhoto"]["name"])) . " has been uploaded.";

            // Update the profile_photo column in the database
            $updateSql = "UPDATE users SET profile_photo = '$targetFile' WHERE id = $userId";
            if ($conn->query($updateSql) === TRUE) {
                echo "Profile photo updated in the database.";
            } else {
                echo "Error updating profile photo in the database: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the file input is set and not empty
    if (isset($_FILES["profilePhoto"]) && !empty($_FILES["profilePhoto"]["name"])) {
        // Process the file upload
        uploadProfilePhoto(1, $conn); // Assuming user_id 1 for the current user, update this based on your authentication logic
    }
}

// Query to fetch user information
$sql = "SELECT * FROM users LIMIT 1"; // Assuming you want to fetch only one user

$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    // Output the MySQL error
    echo "Error: " . $conn->error;
} elseif ($result->num_rows > 0) {
    // Fetch user details
    while ($row = $result->fetch_assoc()) {
        $usersFirstName = $row['first_name'];
        $usersMiddleName = $row['middle_name'];
        $usersLastName = $row['last_name'];
        $usersUsernameOrEmail = $row['username_or_email'];
        $profilePhoto = $row['profile_photo']; // Add this line to fetch the profile photo
        // You can also fetch other user details if needed
    }
} else {
    // Handle the case where no user is found
    echo "No user found";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Main content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Profile</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
         <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../assets/image/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ACRLS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../assets/dist/img/avatar3.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $usersFirstName; ?></a>
        </div>
      </div>

       <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="profile.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Profile
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="watchlist.php" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Watchlist
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="history.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                History Logs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Profile Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong>First Name:</strong> <?php echo $usersFirstName; ?><br>
                                <strong>Middle Name:</strong> <?php echo $usersMiddleName; ?><br>
                                <strong>Last Name:</strong> <?php echo $usersLastName; ?><br>
                                <strong>Username or Email:</strong> <?php echo $usersUsernameOrEmail; ?><br>
                                <br>
                                <strong>Profile Photo:</strong><br>
                                <?php
                                if (!empty($profilePhoto)) {
                                    echo "<img src='$profilePhoto' alt='Profile Photo' style='max-width: 200px;'>";
                                } else {
                                    echo "No profile photo available.";
                                }
                                ?>
                                <br>
                                <br>
                                <!-- Form for changing profile photo -->
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                    <label for="profilePhoto">Change Profile Photo:</label>
                                    <input type="file" name="profilePhoto" accept="image/*"><br>
                                    <input type="submit" value="Upload Profile Photo">
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>
</body>
</html>
