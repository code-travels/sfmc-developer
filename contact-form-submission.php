<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $message = $_POST["message"];

  $mailTo = "nasirwatts@outlook.com";
  $headers = "From: ".$email;
  $txt = "You have received an email from ".$name.".\n\n".$message;

  mail($mailTo, $txt, $headers);
  header("Location: contact-form-submission.php?mailsend");
  exit();
}
?>
