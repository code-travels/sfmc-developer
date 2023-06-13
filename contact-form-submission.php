<?php
$error = '';
$to = 'nasirwatts@outlook.com';
$reCaptchaSecret = "6Lck1FAUAAAAAIjPn9EAhTE1Z7IiWa0GZpL7hrr4";

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? "New Email from My Website";
$message = $_POST['message'] ?? '';

if(empty($name) || empty($email) || empty($message)){
    $error = "Please, fill all required fields.";
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = "Invalid email format";
}

// If no errors so far, then proceed with reCaptcha validation and email sending
if(empty($error)) {
    if(array_key_exists("g-recaptcha-response", $_POST)) {
        $recaptcha = $_POST["g-recaptcha-response"];

        $postdata = http_build_query([
            "secret" => $reCaptchaSecret,
            "response" => $recaptcha
        ]);

        $opts = ['http' => [
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            ]
        ];

        $context  = stream_context_create($opts);
        $result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        $check = json_decode($result);

        if(!$check->success) {
            $error = "reCaptcha validation failed!";
        }
    }

    // If no errors so far, then proceed with email sending
    if(empty($error)) {
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: {$name} <{$email}>" . "\r\n";

        $body = "<html><head><title>{$subject}</title></head><body>";
        $body .= "<div><strong>Name:</strong><br/>".stripslashes($name)."</div>";
        $body .= "<div><strong>Email:</strong><br/>".stripslashes($email)."</div>";
        $body .= "<div><strong>Message:</strong><br/>".stripslashes($message)."</div>";
        $body .= "</body></html>";

        if(!mail($to, $subject, $body, $headers)){
            $error = "Error sending message. Please try again.";
        }
    }
}

if(!empty($error)) {
    header("HTTP/1.1 422 failed");
    echo $error;
} else {
    header("HTTP/1.1 200 OK");
    echo "Your message has been sent successfully.";
}
?>
