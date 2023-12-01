<!-- edit_movie.php -->

<?php
// Check if ID is provided in the URL
if (isset($_GET['id'])) {
    // Fetch the movie details based on the provided ID
    $movieId = $_GET['id'];

    // Retrieve movie details from the database using $movieId
    // Perform a query to get the movie details
    // For example:
    $query = "SELECT * FROM movies WHERE id = $movieId";
    // Execute the query and fetch movie details

    // Display the form to edit movie details
    // Populate form fields with fetched movie details
}
?>
<!-- Your HTML form for editing movie details -->
<form method="POST" action="update_movie.php" enctype="multipart/form-data"> <!-- Update action accordingly -->
    <!-- Input fields for editing movie details -->
    <label for="movieTitle">Movie Title:</label>
    <input type="text" id="movieTitle" name="movieTitle" value="..."> <!-- Populate value attribute with fetched movie title -->

    <!-- Input field for editing movie image -->
    <label for="movieImage">Movie Image:</label>
    <input type="file" id="movieImage" name="movieImage">

    <!-- Input field for editing movie genre -->
    <label for="movieGenre">Movie Genre:</label>
    <input type="text" id="movieGenre" name="movieGenre" value="..."> <!-- Populate value attribute with fetched movie genre -->

    <button type="submit" name="updateMovie">Update</button>
</form>
