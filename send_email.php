<?php

require_once realpath(__DIR__. '/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST["send"])) {
  $mail = new PHPMailer(true);

  // Change these lines according to your SMTP server settings
  $mail->isSMTP();
  $mail->Host = 'localhost'; // The hostname of the SMTP server
  $mail->SMTPAuth = true; // Enable SMTP authentication
  // $mail->Username = 'user@example.com'; // The username to use for SMTP authentication
  // $mail->Password = 'secret'; // The password to use for SMTP authentication
  $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port = 25; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  $mail->setFrom('office@pgroup.az');

  $mail->addAddress($_POST["email"]);
  $mail->isHTML(true);
  
  $mail->Body = $_POST['message'];
  
  $mail->send();

  echo
  "
  <script>
    document.location.href = '/'
  </script>
  ";

}

?>
