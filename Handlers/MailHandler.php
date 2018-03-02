<?php
class MailHandler{
    public function sendMail($email,$eventName,$eventLocation,$startDateTime,$endDateTime){
        $mail = new PHPMailer;                             
        try {
            //SMTP
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                      
            $mail->Host = 'smtp.gmail.com';  
            $mail->SMTPAuth = true;                               
            $mail->Username = 'erativecoop@gmail.com';    
            $mail->Password = '1q2w3e4r5t6y7u8i';                           
            $mail->SMTPSecure = 'tls';                          
            $mail->Port = 587;                                    
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));

            //Recipients
            $mail->setFrom('erativecoop@gmail.com', 'COOP');
            $mail->addAddress($email, '');     

            //Content
            $mail->isHTML(true);                                 
            $mail->Subject = $eventName;
            $mail->Body    = "You are invited to " .$eventName. " " .$eventLocation. " " .$startDateTime. " " .$endDateTime;
            $mail->AltBody = '';

            $mail->send();
            echo "<script>window.location='COOP_AddEvent.php';alert('Success!');</script>";
        }

        catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}

?>


