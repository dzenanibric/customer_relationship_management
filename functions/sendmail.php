<?php

function sendPassword($password){ 
    
    require 'C:/xampp/htdocs/customer_relationship_management/PHPMailerAutoload.php';  
    
    $mail = new PHPMailer; 
    
    $mail->isSMTP();                      
    $mail->Host = 'smtp.gmail.com';       
    $mail->SMTPAuth = true;               // Ukljuci smtp autentifikaciju
    $mail->Username = 'crm.system.by.dzenan.ibric@gmail.com';   // mail s kojeg saljes
    $mail->Password = 'crmsystem387';   // sifra tog maila 
    $mail->SMTPSecure = 'tls';            // Ukljuci tls enkripciju, ssl takodjer moze
    $mail->Port = 587;                    
    
    // Posiljatelj
    $mail->setFrom('crm.system.by.dzenan.ibric@gmail.com', 'Dzenan Ibric'); 
    $mail->addReplyTo('crm.system.by.dzenan.ibric@gmail.com', 'Dzenan Ibric'); 
    //Primatelj
    $mail->addAddress('crm.system.by.dzenan.ibric@gmail.com'); 
    
    $mail->isHTML(true); 
    
    $mail->Subject = 'Admin CRM password has been generated'; 
    
    $bodyContent = 'Password: ' .$password; 
    $mail->Body  = $bodyContent; 
     
    if(!$mail->send()) { 
        echo 'Password not generated successfully. Mailer Error: '.$mail->ErrorInfo; 
    } else { 
        echo 'Your password has been generated.'; 
    } 
    }
?>