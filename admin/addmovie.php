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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    
    // Handle file upload
    $file = $_FILES['movieImage'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];

    // Directory where you want to store the uploaded files
    $uploadDirectory = "../uploads/";
    // Move the uploaded file to the desired location
    $targetPath = $uploadDirectory . $fileName;
    move_uploaded_file($fileTmpName, $targetPath);

    // Insert data into the "movies" table (replace with your table name)
    $sql = "INSERT INTO movies (title, genre, image_path) VALUES ('$title', '$genre', '$targetPath')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
