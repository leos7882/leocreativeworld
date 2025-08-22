<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize input data
  $name = htmlspecialchars(trim($_POST['name']));
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $subject = htmlspecialchars(trim($_POST['subject']));
  $msg = htmlspecialchars(trim($_POST['msg']));

  // Validate email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "Invalid email address."]);
    exit;
  }

  // Email configuration
  $to = "leos7882@gmail.com"; // Your email address
  $headers = "From: leos7882@gmail.com\r\n"; // Use your email as From address
  $headers .= "Reply-To: $email\r\n"; // Allow replies to go to the user's email
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
  $output = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage: $msg";

  // Send email
  if (mail($to, $subject, $output, $headers)) {
    echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
  } else {
    echo json_encode(["status" => "error", "message" => "Failed to send message."]);
  }
} else {
  echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>