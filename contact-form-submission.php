<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  // Perform form validation
  $errors = [];

  // Validate name
  if (empty($name)) {
    $errors[] = "Name is required";
  }

  // Validate email
  if (empty($email)) {
    $errors[] = "Email is required";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  } else {
    // Validate against known email domains
    $allowedDomains = ["example.com", "domain.com", "yourdomain.com"]; // Add the known email domains here

    $domain = explode("@", $email)[1];
    if (!in_array($domain, $allowedDomains)) {
      $errors[] = "Invalid email domain";
    }
  }

  // Validate message
  if (empty($message)) {
    $errors[] = "Message is required";
  }

  // If there are any validation errors, return the error messages
  if (!empty($errors)) {
    echo json_encode(["success" => false, "errors" => $errors]);
    exit;
  }

  // Send an email with the form data
  $to = "your-email@example.com";
  $subject = "New contact form submission";
  $emailBody = "Name: $name\n";
  $emailBody .= "Email: $email\n";
  $emailBody .= "Message: $message\n";

  // Send the email
  $success = mail($to, $subject, $emailBody);

  // Return a response to the client
  if ($success) {
    echo json_encode(["success" => true, "message" => "Form submission successful"]);
  } else {
    echo json_encode(["success" => false, "message" => "Form submission failed"]);
  }
} else {
  // Invalid request method
  echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
?>
