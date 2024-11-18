<?php
// Include database connection
include '../db_connect.php';

if (($_SERVER["REQUEST_METHOD"] === "POST") && (isset($_POST['submit']))) {
    // Get form data
    $name = $conn->real_escape_string($_POST['name']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into the database
    $query = "INSERT INTO contact_messages (name, contact_number, subject, message) 
              VALUES ('$name', '$contact_number', '$subject', '$message')";

    if ($conn->query($query) === TRUE) {
        $message = "Message submitted successfully!";
        $msgType = "success";
    } else {
        $message = "Failed to prepare the SQL statement.";
        $msgType = "error";
    }

    // Redirect back to the form page with a message
    header("Location: ../contact.php?message=" . urlencode($message) . "&type=" . urlencode($msgType));
    exit();

} else {
     header('Location: ../logins.php');
    exit();
}
?>
