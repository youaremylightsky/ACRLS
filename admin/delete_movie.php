<?php
// Your existing code...
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

// Check if the 'id' parameter is set in the URL
if(isset($_GET['id'])) {
    // Get the ID of the movie to be deleted
    $movie_id = $_GET['id'];

    // Delete movie logic
    $delete_query = "DELETE FROM movies WHERE id = $movie_id";

    if ($conn->query($delete_query) === TRUE) {
        echo "Movie deleted successfully";
    } else {
        echo "Error deleting movie: " . $conn->error;
    }
}
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
        echo '<td><a href="delete_movie.php?id=' . $row['id'] . '&delete=true">Delete</a></td>'; // Delete button
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
<!-- ... -->
