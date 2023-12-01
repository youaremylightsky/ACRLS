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
    $first_name = $_POST["first_name"];
    $first_name = $_POST["middle_name"];
    $first_name = $_POST["last_name"];
    $username_or_email = $_POST["username_or_email"];
    
    // Handle file upload
    $file = $_FILES['userImage'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];

    // Directory where you want to store the uploaded files
    $uploadDirectory = "../uploads/";
    // Move the uploaded file to the desired location
    $targetPath = $uploadDirectory . $fileName;
    move_uploaded_file($fileTmpName, $targetPath);

    // Insert data into the "users" table (replace with your table name)
    $sql = "INSERT INTO users (first_name, middle_name, last_name, username_or_email ) VALUES ('$first_name','middle_name','last_name','$username_or_email', '$targetPath')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>