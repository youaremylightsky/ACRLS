<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acrls_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
<?php
include("header.php")
?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-1">
    <!-- Sidebar -->
    <div class="sidebar">
      <a>
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="Administrator">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $adminFirstName; ?></a>
        </div>
      </div>
    </a>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu">
            <a href="dashboard.php" class="nav-link">
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
            <a href="logs.php" class="nav-link active">
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
            <h1 class="m-0">User Activity History</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="row">
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong class="ml-2">Copyright &copy; 2023-2024 <a href="#">Vivid Ventures</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<?php
  include("scripts.php")
?>
</body>
</html>
