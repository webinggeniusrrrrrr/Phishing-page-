<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $name = htmlspecialchars(trim($_GET['name']));
    $email = htmlspecialchars(trim($_GET['email']));
    $message = htmlspecialchars(trim($_GET['message']));

    $errors = [];

    // Validate inputs
    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }
    if (empty($message)) {
        $errors[] = 'Message is required.';
    }

    // If no errors, send email
    if (empty($errors)) {
        $to = 'your_email@example.com'; // Replace with your email address
        $subject = 'New Message from Contact Form';
        $body = "Name: $name\nEmail: $email\nMessage:\n$message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send message. Please try again later.";
        }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
} else {
    echo "Invalid request method.";
}
?>
