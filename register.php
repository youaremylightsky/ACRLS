<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['form_submitted'])) {
        $_SESSION['form_submitted'] = true; // Set session variable to indicate form submission

        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $dbName = "acrls_db";

        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $firstName = $_POST["firstName"];
        $middleName = $_POST["middleName"];
        $lastName = $_POST["lastName"];
        $usernameOrEmail = $_POST["usernameOrEmail"];
        $contactNumber = $_POST["contactNumber"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password

        // Check if the username or email already exists in the database
        $checkExistingUser = $conn->prepare("SELECT * FROM admin WHERE username_or_email = ?");
        $checkExistingUser->bind_param("s", $usernameOrEmail);
        $checkExistingUser->execute();
        $result = $checkExistingUser->get_result();

        if ($result->num_rows > 0) {
            echo "Username or Email already exists!";
        } else {
            // Decide whether to insert into admin or users table
            $checkAdminTable = $conn->query("SELECT * FROM admin");

            if ($checkAdminTable->num_rows == 0) {
                $sql = "INSERT INTO admin (first_name, middle_name, last_name, username_or_email, contact_number, password) VALUES (?, ?, ?, ?, ?, ?)";
            } else {
                $sql = "INSERT INTO users (first_name, middle_name, last_name, username_or_email, contact_number, password) VALUES (?, ?, ?, ?, ?, ?)";
            }

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $firstName, $middleName, $lastName, $usernameOrEmail, $contactNumber, $password);

            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $conn->close();
        $_SESSION['form_submitted'] = false; // Reset the session variable after successful insertion or validation
    } else {
        echo "Form already submitted. you may proceed";
    }
}
?>
