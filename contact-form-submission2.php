<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  $errors = [];

  if (empty($name)) {
    $errors[] = "Name is required";
  }

  if (empty($email)) {
    $errors[] = "Email is required";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  } else {

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

  if (!empty($errors)) {
    $response = [
      "success" => false,
      "message" => "Form submission failed",
      "errors" => $errors
    ];
    echo json_encode($response);
    exit;
  }

  $to = "nasirwatts@outlook.com";
  $subject = "New contact form submission";
  $emailBody = "Name: $name\n";
  $emailBody .= "Email: $email\n";
  $emailBody .= "Message: $message\n";

  
  $success = mail($to, $subject, $emailBody);

  
  if ($success) {
    $response = [
      "success" => true,
      "message" => "Form submission successful"
    ];
    echo json_encode($response);
  } else {
    $response = [
      "success" => false,
      "message" => "Form submission failed"
    ];
    echo json_encode($response);
  }
} else {
  
  $response = [
    "success" => false,
    "message" => "Invalid request method"
  ];
  echo json_encode($response);
}
?>