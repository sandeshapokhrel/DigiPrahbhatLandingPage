<?php

// Database configuration
$servername = "localhost"; // Replace with your database server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "dp"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Custom filter function to remove HTML tags
function custom_filter_input($form_field) {  
    return strip_tags($form_field);
}

// Receive and filter user input for the contact form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if it's the contact form
    if (isset($_POST['contact_form'])) {
        $name = custom_filter_input($_POST['name']);
        $phone = custom_filter_input($_POST['phone']);
        $email = custom_filter_input($_POST['email']);
        $message = custom_filter_input($_POST['message']);

        // Insert data into contact_form_data table
        $sql = "INSERT INTO contact_form_data (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$message')";
        if ($conn->query($sql) === TRUE) {
            // Redirect to index.html after successful submission
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Check if it's the CTA form
    if (isset($_POST['cta_form'])) {
        $email = custom_filter_input($_POST['email']);

        // Insert data into cta_form_data table
        $sql = "INSERT INTO cta_form_data (email) VALUES ('$email')";
        if ($conn->query($sql) === TRUE) {
            // Redirect to index.html after successful submission
            header("Location: index.html");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close connection
$conn->close();

?>
