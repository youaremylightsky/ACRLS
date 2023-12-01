<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acrls_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getUserGenreAnalytics($conn) {
    $sql = "SELECT search_genre AS genre, COUNT(*) as count FROM user_searches GROUP BY search_genre ORDER BY count DESC";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $totalSearches = 0;
        $genreData = array();
        
        while ($row = $result->fetch_assoc()) {
            $genre = $row['genre'];
            $count = $row['count'];
            
            $totalSearches += $count;
            $genreData[$genre] = $count;
        }
        
        foreach ($genreData as $genre => $count) {
            $percentage = ($count / $totalSearches) * 100;
            $genreData[$genre] = round($percentage, 2);
        }
        
        return $genreData;
    } else {
        return array(); // Return an empty array if no data available
    }
}

$userGenreAnalytics = getUserGenreAnalytics($conn);

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
            <a href="metrics.php" class="nav-link active">
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
                        <h1 class="m-0">User Experience (UX) Analytics</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Genre Percentages from Searches</h5>
                                <canvas id="genreChart" style="height: 400px; width: auto;"></canvas>
                            </div>
                        </div>
                    </div>
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
        <strong class="ml-2">Copyright &copy; 2023 <a href="#">Vivid Ventures</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        </div>
    </footer>
    <!-- /.Main Footer -->
</div>
<!-- ./wrapper -->
<!-- ChartJS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>
<?php
  include("scripts.php")
?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('genreChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_keys($userGenreAnalytics)); ?>,
                datasets: [{
                    label: 'Genre Percentage',
                    data: <?php echo json_encode(array_values($userGenreAnalytics)); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }]
                }
            }
        });
    });
</script>
</body>
</html>
