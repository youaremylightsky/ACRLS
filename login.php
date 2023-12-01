<?php
include('./connection/connection.php');
$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST["usernameOrEmail"];
    $password = $_POST["password"];
    $loginType = $_POST["loginType"]; // Added line to get the login type

    if ($loginType === "admin") {
        // Admin login logic
        // ... (existing admin login code)

        // After successful admin login
        // Log admin activity
        $adminID = $_SESSION["admin_id"];
        $action = "You are logged in";
        $insertQuery = "INSERT INTO user_activity (user_id, activity) VALUES ('$adminID', '$action')";
        $conn->query($insertQuery);

        // Redirect to admin dashboard
        header("Location: ./admin/dashboard.php");
        exit();
    } elseif ($loginType === "user") {
        // User login logic
        $userQuery = "SELECT * FROM users WHERE username_or_email = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("s", $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                session_start();
                $_SESSION["id"] = $row["id"];
                
                // After successful user login
                // Log user activity
                $userID = $_SESSION["id"];
                $action = "You are logged in";
                $insertQuery = "INSERT INTO user_activity (user_id, activity) VALUES ('$userID', '$action')";
                $conn->query($insertQuery);

                // Redirect to user dashboard
                header("Location: ./users/dashboard.php");
                exit();
            } else {
                echo "Incorrect username/email or password for user.";
                exit();
            }
        } else {
            echo "User not found.";
            exit();
        }
    } else {
        echo "Invalid login type.";
        exit();
    }
}

$conn->close();
?>
