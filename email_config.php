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
        $mail->setFrom('consulting.ci.contact@gmail.com', 'Cheikh ibrahim'); 
?>