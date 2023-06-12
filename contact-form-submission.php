<?php
if (isset($_POST['submit'])) {
  // Retrieve the form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

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
    $allowedDomains = [
    'gmail.com',
    'yahoo.com',
    'hotmail.com',
    'aol.com',
    'protonmail.com',
    'outlook.com',
    'icloud.com',
    'zoho.com',
    'mail.com',
    'gmx.com',
    'fastmail.com',
    'hushmail.com',
    'inbox.com',
    'blueyonder.co.uk',
    'lycos.com',
    'rediffmail.com',
    'sina.com',
    '123.com',
    'runbox.com',
    'yandex.com',
    'libero.it',
    'wanadoo.fr',
    'gmx.de',
    'web.de'
  ];

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
  $to = "nasirwatts@outlook.com";
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