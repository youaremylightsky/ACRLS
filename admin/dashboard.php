<?php
include("header.php");
?>
<?php
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

// Query to fetch admin information
$sql = "SELECT * FROM admin LIMIT 1"; // Assuming you want to fetch only one admin

$result = $conn->query($sql);

// Check if the query was successful
if ($result->num_rows > 0) {
    // Fetch admin details
    while ($row = $result->fetch_assoc()) {
        $adminFirstName = $row['first_name'];
        // You can also fetch other admin details if needed
    }
} else {
    // Handle the case where no admin is found
    echo "No admin found";
}

// Close the database connection
$conn->close();
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-1">
    <!-- Sidebar -->
    <div class="sidebar">
      <a>
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../assets/dist/img/Admin.jpg" class="img-circle elevation-2" alt="Administrator">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $adminFirstName; ?></a>
        </div>
      </div>
    </a>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="managemovies.php" class="nav-link">
              <i class="nav-icon fa-solid fa-film"></i>
              <p>
                Manage Movie Details
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="manageusers.php" class="nav-link">
              <i class="nav-icon fa-solid fa-users-gear"></i>
              <p>
                Users Management 
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="metrics.php" class="nav-link">
              <i class="nav-icon fa-solid fa-chart-pie"></i>
              <p class="text-sm">
                User Interaction Analytics 
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="logs.php" class="nav-link">
              <i class="nav-icon fas fa-clock-rotate-left"></i>
              <p>
                Detailed User Logs
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>               
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>150</h3>
                <p>Content Management</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-film fa-beat"></i>
              </div>
              <a href="managemovies.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- /.col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>150</h3>
                <p>Managed Users</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users-gear fa-beat"></i>
              </div>
              <a href="manageusers.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-indigo">
              <div class="inner">
                <h3>150</h3>
                <p>Users Engagement</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-chart-line fa-bounce"></i>
              </div>
              <a href="metrics.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-lightblue">
              <div class="inner">
                <h3>150</h3>
                <p>History Logs</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-clock fa-pulse"></i>
              </div>
              <a href="logs.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
<?php
include("footer.php")
?>
