<?php
// Connect to the database (Replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acrls_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $title = $_GET["title"];
    $genre = $_GET["genre"];
    
    // Assuming you have a user ID for the logged-in user, replace 'user_id' accordingly
    session_start(); // Start the session
    $userId = $_SESSION['id']; // Fetch user ID from the session

    // Query to insert search data into the user_searches table
    $insertQuery = "INSERT INTO user_searches (user_id, search_title, search_genre) VALUES ('$userId', '$title', '$genre')";
    $insertResult = $conn->query($insertQuery);

    if (!$insertResult) {
        // Handle insert query failure if needed
        echo "Error: " . $conn->error;
    }

    // Proceed with the movie search query
    $sql = "SELECT title, genre, image_path FROM movies WHERE title LIKE '%$title%' AND genre LIKE '%$genre%'";
    $result = $conn->query($sql);

    if (!$result) {
        // If there's an error in the query, display an error message
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            // Start constructing HTML content for displaying search results
            $output = '<div class="row">';
            while ($row = $result->fetch_assoc()) {
                // Construct HTML for each movie result
                $output .= '<div class="col-md-4">';
                $output .= '<div class="card">';
                // Add image, title, genre, or any other movie details to the card
                $output .= '<img src="' . $row["image_path"] . '" class="card-img-top" alt="' . $row["title"] . '">';
                $output .= '<div class="card-body">';
                $output .= '<h5 class="card-title">' . $row["title"] . '</h5>';
                $output .= '<p class="card-text">Genre: ' . $row["genre"] . '</p>';
                // Add other movie details if needed
                $output .= '</div></div></div>';
            }
            $output .= '</div>'; // Close the row div

            // Return the constructed HTML as the response
            echo $output;
        } else {
            // If no movies are found, display a message
            echo "<p>No movies found matching the search criteria.</p>";
        }
    }

    $conn->close();
}
?>

