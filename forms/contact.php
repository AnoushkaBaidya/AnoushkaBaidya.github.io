<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Check if all fields are filled
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "error: All fields are required.";
        exit;
    }

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "error: Invalid email address.";
        exit;
    }

    // Email setup
    $to = "abaidya@wpi.edu"; // Replace with your email address
    $email_subject = "Contact Form: $subject";
    $email_body = "You have received a new message from your website contact form.\n\n" .
                  "Here are the details:\n" .
                  "Name: $name\n" .
                  "Email: $email\n\n" .
                  "Message:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "success";
    } else {
        echo "error: Failed to send your message. Please try again later.";
    }
} else {
    echo "error: Invalid request method.";
}
?>
