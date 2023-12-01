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
  include('header.php')
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
            <a href="managemovies.php" class="nav-link active">
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
            <h1 class="m-0">Movie Metadata Editor</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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

// SQL query to retrieve data from the 'movies' table
$query = "SELECT id, title, genre, image_path FROM movies";

// Execute the query
$result = $conn->query($query);
?>
<style>
  .image-cell {
    width: 20px; /* Set your desired width */
    height: 20px; /* Set your desired height */
    text-align: center; /* Center the image within the cell */
  }
  .image-cell img {
    max-width: 100%;
    max-height: 100%;
  }
</style>
    <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              <h1 class="card-title">Movie List</h1>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <button type="button" id="addMovieButton" class="btn btn-app bg-info">
                  <i class="fa fa-circle-plus mb-1"></i>Add Movie
                </button>
               <thead>
  <tr>
    <th class="text-center">Image</th>
    <th class="text-center">Title</th>
    <th class="text-center">Genre</th>
    <th class="text-center">Action</th>
  </tr>
</thead>
<tbody>
  <?php
  // Loop through the results and display data
  while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td class="image-cell"><img src="' . $row['image_path'] . '" alt="' . $row['title'] . '"></td>';
    echo '<td>' . $row['title'] . '</td>';
    echo '<td>' . $row['genre'] . '</td>';
    echo '<td>'; // Cell for actions
    echo '<a href="edit_movie.php?id=' . $row['id'] . '">Edit</a> | '; // Edit button
    echo '<a href="delete_movie.php?id=' . $row['id'] . '">Delete</a>'; // Delete button
    echo '</td>';
    echo '</tr>';
  }
  ?>
</tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </section>
      <?php
      $conn->close();
      ?>    
    <!-- /.content -->
    <!-- Modal for adding a new movie -->
      <div class="modal fade" id="addMovieModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Movie</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="addMovieForm">
                <div class="form-group">
                    <label for="movieImage">Image:</label>
                    <input type="file" class="form-control-file" id="movieImage" accept="image/*">
                </div>
                <div class="form-group">
                  <label for="movieTitle">Title:</label>
                  <input type="text" class="form-control" id="movieTitle" placeholder="Enter title">
                </div>
                <div class="form-group">
                  <label for="movieGenre">Genre:</label>
                  <input type="text" class="form-control" id="movieGenre" placeholder="Enter genre">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" id="saveMovieButton" class="btn btn-primary">Save</button>
            </div>
          </div>
        </div>
      </div>
    </div>
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
  $(document).ready(function() {
    // Show the modal when the "Add Movie" button is clicked
    $('#addMovieButton').click(function() {
        $('#addMovieModal').modal('show');
    });

    // Handle the "Save" button click
    $('#saveMovieButton').click(function() {
        // Get data from the form
        const title = $('#movieTitle').val();
        const genre = $('#movieGenre').val();

        // Create a FormData object to send the file and form data
        const formData = new FormData();
        formData.append('title', title);
        formData.append('genre', genre);
        formData.append('movieImage', $('#movieImage')[0].files[0]); // Use the first file selected

        // Send data to the addmovie.php script using AJAX
        $.ajax({
            type: "POST",
            url: "addmovie.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response); // Display the response from the server
                $('#addMovieModal').modal('hide'); // Close the modal
            }
        });
    });
});
</script>
<script>
  // Function to toggle between dark and light themes
  function toggleTheme() {
    const body = document.body;
    const themeIcon = document.getElementById('themeIcon');

    if (body.classList.contains('dark-mode')) {
      body.classList.remove('dark-mode');
      themeIcon.classList.remove('fa-sun');
      themeIcon.classList.add('fa-moon');
      localStorage.setItem('theme', 'light');
    } else {
      body.classList.add('dark-mode');
      themeIcon.classList.remove('fa-moon');
      themeIcon.classList.add('fa-sun');
      localStorage.setItem('theme', 'dark');
    }
  }

  // Check the saved theme preference on page load
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'dark') {
    document.body.classList.add('dark-mode');
    document.getElementById('themeIcon').classList.add('fa-sun');
  }

  // Attach the theme toggle function to the themeToggle element
  const themeToggle = document.getElementById('themeToggle');
  if (themeToggle) {
    themeToggle.addEventListener('click', toggleTheme);
  }
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>

