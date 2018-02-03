<?php
require 'phpmailerautoload.php';
class MailHandler{
    public function sendMail(){
        $mail = new PHPMailer;                             
        try {
            //SMTP
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                      
            $mail->Host = 'smtp.gmail.com';  
            $mail->SMTPAuth = true;                               
            $mail->Username = 'reddaniellance@gmail.com';    
            $mail->Password = 'akoclancered15';                           
            $mail->SMTPSecure = 'tls';                          
            $mail->Port = 587;                                    
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));

            //Recipients
            $mail->setFrom('reddaniellance@gmail.com', 'Mailer');
            $mail->addAddress('reddjockey15@gmail.com', 'Joe User');     

            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo "<script>window.location='COOP_AddEvent.php';alert('Success!');</script>";
        }

        catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}

?>


