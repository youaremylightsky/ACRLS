<?php
// Include database connection
include("db_connection.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Retrieve form data
   $first_name = $_POST["first_name"];
   $middle_name = $_POST["middle_name"];
   $last_name = $_POST["last_name"];
   $username_or_email = $_POST["username_or_email"];

   // Validate and sanitize input (add more validation as needed)
   $first_name = mysqli_real_escape_string($conn, $first_name);
   $middle_name = mysqli_real_escape_string($conn, $middle_name);
   $last_name = mysqli_real_escape_string($conn, $last_name);
   $username_or_email = mysqli_real_escape_string($conn, $username_or_email);

   // SQL query to insert a new user into the 'users' table
   $insert_query = "INSERT INTO users (first_name, middle_name, last_name, username_or_email) VALUES ('$first_name', '$middle_name', '$last_name', '$username_or_email')";

   // Execute the query
   if ($conn->query($insert_query) === TRUE) {
      // Redirect to the user management page after successful addition
      header("Location: manageusers.php");
      exit();
   } else {
      // Handle the case where the insertion failed
      echo "Error: " . $insert_query . "<br>" . $conn->error;
   }
}

// Close the database connection
$conn->close();
?>
