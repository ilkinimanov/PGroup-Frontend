<?php

require_once realpath(__DIR__. '/vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST["send"])) {
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = $_ENV['SMTP_HOST'];
  $mail->SMTPAuth = true;
  $mail->Username = $_ENV['SMTP_USERNAME'];


  $mail->SMTPSecure = 'ssl';
  $mail->Port = $_ENV['SMTP_PORT'];

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