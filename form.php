<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'models/PHPMailer.php';
    require 'models/SMTP.php';
    require 'models/Exception.php';

    include 'models/db.php';

    $formOfAdress = $_POST['formOfAddress'];
    $vorname = $_POST['firstname'];
    $nachname = $_POST['surname'];
    $email = $_POST['email'];
    $product_id = $_POST['paintId'];
    $error = '';

    if(strlen($vorname) === 0 || strlen($nachname) === 0)
    {
        global $error;
        $error = "Error:_Vorname_und/oder_Nachname_dürfen_nicht_leer_sein.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        global $error;
        $error = "Error:_Bitte_gültige_Email-Adresse_angeben";
    }

    $mailContainer = getMailInfo($product_id, $con);

    if(empty($mailContainer)){
        $mailContainer['picture'] = 'https://www.arnulfhoffmann.de/static/pictures/fullview/1.JPG';
        $mailContainer['summary'] = 'Bild Nr. 1 / 1997 / 120 x 100 (Default)';
        $mailContainer['size'] = 'width: 329px;height: 260px;';
    }
    
    if(strlen($error) === 0) 
    {
        global $error;
        $timestamp = date('d/m/Y H:i:s', time());
        $interestSql = "insert into $db.prospect values (0,\"$email\",\"$vorname\",\"$nachname\",$product_id, \"$timestamp\")";
        #$numInterest = "select count(*) from prospect where email=$email";
        $insert = $con->query($interestSql);
        $insert = true;
        
        //mail
        include 'models/emailTemplate.php';
        $subject = 'Anfrage für Malerei';
        if(!sendMail($email, $vorname, $nachname, getHtmlMail(true, $template), $altClient, $subject))
        {
            $error = "Error:_Fehler_beim_senden_der_Email";
        }
        sendMail("verwaltung@arnulfhoffmann.de", "Familie", "Hoffmann", getHtmlMail(false, $template), $altVerwaltung, $subject);
    }

    
    if(strlen($error) === 0) 
    {
        //$insert is true if mysql Query successful or false otherwise
        header("Location: https://www.arnulfhoffmann.de/painting.php?p=$product_id&r=$insert", true,  301);
    } else  {
        // for localhost "https://www.arnulfhoffmann.de/" = ""
        header("Location: https://www.arnulfhoffmann.de/error/error.php?e=$error", true,  301);
    }
    
    function sendMail($recipient, $vorname, $nachname, $body, $altBody, $subject) {

        $mail = new PHPMailer();
    
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;                      // Enable verbose debug output
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
            $mail->addAddress("$recipient", "$vorname $nachname");     // Add a recipient "$email", "$vorname $nachname"
    
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body= $body;
            $mail->AltBody = $altBody;
            
            $mail->send();
            return true;

        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }

    }

    function getMailInfo($id, $con){

        if(!is_numeric($id)){
            return array();
        }

        $sql = "select * from paintings where paintings_id = $id";
        $resultobj =  $con->query($sql);
        $result = $resultobj->fetch_assoc();

        $picture = 'https://www.arnulfhoffmann.de/static/pictures/fullview/' . $result['picture_full'];
        $summary = 'Bild Nr.' . $result['paintingNumber'] . ' / ' . $result['year'] . ' / ' . $result['dimensions'];
        $size = $result['vertical'] ? 'width: 260px;height: 329px;' : 'width: 329px;height: 260px;';

        if(empty($picture)){
            return array();
        }
        return ['picture' => $picture, 'summary' => $summary, 'size' => $size];
    }
    
?>