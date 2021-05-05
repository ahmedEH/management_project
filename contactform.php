
<?php 
 
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
require 'PHPMailer/PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer/PHPMailer.php'; 
require 'PHPMailer/PHPMailer/SMTP.php'; 
 
$mail = new PHPMailer; 
$mail->CharSet = 'UTF-8';
 
$mail->isSMTP();                      // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;               // Enable SMTP authentication 
$mail->Username = 'consulting.ci.contact@gmail.com';   // SMTP username 
$mail->Password = '27804921';   // SMTP password 
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                    // TCP port to connect to 
 
// Sender info 
$mail->setFrom('consulting.ci.contact@gmail.com', 'cheikh brahim'); 
 
// Add a recipient 

$mail->addAddress('mrabottc@gmail.com'); 


 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = html_entity_decode($_POST['subject']); 
 
// Mail body content 
$mail->Body    ='
<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </head>
  <body data-spy="scroll" data-offset="80" dir="rtl"data-target="#thenavbar">
    <div class="card" style="width: 18rem;">
      <img src="https://cdn.pixabay.com/photo/2021/02/02/18/46/city-5974876_960_720.jpg" class="card-img-top" alt=""/>
      <div class="card-body">
        <p >'.'<strong>'.html_entity_decode("اسم المرسل  : ").'</strong>'.$_POST['name'].'</p>
        <p >'.'<strong>'.html_entity_decode("بريد المرسل : ").'</strong>'.$_POST['email'].'</p>
        <p class="card-title">'.'<strong>'.html_entity_decode("موضوع الرسالة : ").'</strong>'.$_POST['subject'].'</p>
        <p class="card-text">'.'<strong>'.html_entity_decode("نص الرسالة : ").'</strong>'.$_POST['message'].'</p>
      </div>
    </div>
  </body>
</html>';

 
// Send email 
$response=$mail->send();
echo json_encode($response);
 
?>
