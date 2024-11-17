<?php
// Start the session
session_start();
include '../../db_connect.php'; // Include database connection

// Handle form submission
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check for empty fields
    if (!empty($username) && !empty($password)) {
        // Fetch user from the database
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Set session variable for logged-in user
                    $_SESSION['username'] = $username;

                    // Redirect to the dashboard
                    header("Location: ../../creativeCake-admin/index.php");
                    exit();
                } else {
                    $message = "Invalid password. Please try again.";
                    $msgType = "error";
                }
            } else {
                $message = "User not found. Please register first.";
                $msgType = "error";
            }

            $stmt->close();
        } else {
            $message = "Database error. Please try again later.";
            $msgType = "error";
        }

        // Redirect back to the form page with a message
        header("Location: ../admin.php?message=" . urlencode($message) . "&type=" . urlencode($msgType));
        exit();
    } else {
        $message = "All fields are required.";
        $msgType = "error";

        // Redirect back to the form page with a message
        header("Location: ../admin.php?message=" . urlencode($message) . "&type=" . urlencode($msgType));
        exit();
    }
} else {
    // Redirect to login if the request is invalid
    header("Location: ../index.php");
    exit();
}
?>
