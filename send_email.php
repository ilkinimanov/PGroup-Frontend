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
  $mail->Host = $_ENV['SMTP_HOST'];
  $mail->SMTPAuth = true;
  $mail->Username = $_ENV['SMTP_USERNAME'];
  $mail->Password = $_ENV['SMTP_PASSWORD'];
  $mail->SMTPSecure = 'tls';
  $mail->Port = $_ENV['SMTP_PORT'];

  $mail->setFrom('support@pgroup.az');

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
