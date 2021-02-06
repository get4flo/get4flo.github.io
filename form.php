<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'models/PHPMailer.php';
    require 'models/SMTP.php';
    require 'models/Exception.php';

    include 'models/db.php';

    $vorname = $_POST['firstname'];
    $nachname = $_POST['surname'];
    $email = $_POST['email'];
    $product_id = $_POST['paintId'];
    $error = '';

    if(strlen($vorname) === 0 || strlen($nachname) === 0)
    {
        global $error;
        $error = "Vorname und Nachname dürfen nicht leer sein.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        global $error;
        $error = "Bitte gültige Email-Adresse angeben";
    }

    if(strlen($error) === 0) 
    {
        $interestSql = "insert into db59690.prospect values (0,\"$email\",\"$vorname\",\"$nachname\",$product_id)";
        #$numInterest = "select count(*) from prospect where email=$email";
        $insert = $con->query($interestSql);
        

        $mail = new PHPMailer();
    
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'mail.manitu.de';                  // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'verwaltung@arnulfhoffmann.de';                     // SMTP username 
            $mail->Password   = 'pUGSbR#9pTd5eb2e';                               // SMTP password pUGSbR#9pTd5eb2e
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged ENCRYPTION_STARTTLS
            $mail->Port       = 465;                                 // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->CharSet = 'utf-8';
    
            //Recipients
            $mail->setFrom('verwaltung@arnulfhoffmann.de', 'AH-Gallery Verwaltung');  //verwaltung@arnulfhoffmann.de AH-Gallery Verwaltung
            $mail->addAddress("rhf77604@cuoly.com", "florian hoffmann");     // Add a recipient "$email", "$vorname $nachname"
    
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Anfrage für Malerei';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        //$insert is true if mysql Query successful or false otherwise
        header("Location: https://www.arnulfhoffmann.de/painting.php?p=$product_id&r=$insert", true,  301);
    }

    header("Location: https://www.arnulfhoffmann.de/painting.php?p=$product_id&r=$error", true,  301);
    
?>