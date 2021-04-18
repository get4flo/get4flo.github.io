<?php

    $altClient = "Sehr geehrter Herr $nachname \n\n vielen dank für ihr Interesse an einer Arnulf Hoffmann Malerei. Wir melden uns in kürze bei ihnen. \n\n Ihre Familie Hoffmann";
    
    $picture = $mailContainer['picture'];
    $size = $mailContainer['size'];
    $summary = $mailContainer['summary'];
    $printFormOfAdress = $gender === 'm' ? 'Herr' : 'Frau';
    $clientEmail = "
    <span><b>Sehr geehrte/r $printFormOfAdress $nachname</b></span>

    <br>
    <br>

    <span>vielen dank für Ihr Interesse. Wir melden uns so bald wie möglich bei Ihnen mit weiteren Informationen
    zu der Malerei/Skulptur, die Ihr Interesse geweckt hat.</span>

    <br>
    <br>

    <span>Ihre Familie Hoffmann</span>

    <br>
    <br>
    <hr>
    <br>
    
    <table align=\"center\">
        <tbody>
            <tr>
                <td style=\"text-align: center\">
                    <p><b>Malerei von Interesse:</b></p>
                </td>
            </tr>
            <tr>
                <td>
                    <img src=\"$picture\" style=\"$size\" alt=\"Malerei\">
                </td>
            </tr>
            <tr>
                <td style=\"text-align: center\">
                    <span style=\"color:grey; font-size: 15px;\">$summary</span>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    ";

    $verwaltungEmail = "
    <span><b>Neue Anfrage von $printFormOfAdress $vorname $nachname</b></span>

    <br>
    <br>

    <span>Bitte so bald wie möglich zurück schreiben.</span>

    <br>

    <span>Email: $email</span>

    <br>

    <span>Euer Flo</span>

    <br>
    <br>
    <hr>
    <br>
    
    <table align=\"center\">
        <tbody>
            <tr>
                <td style=\"text-align: center\">
                    <p><b>Malerei von Interesse:</b></p>
                </td>
            </tr>
            <tr>
                <td>
                    <img src=\"$picture\" style=\"$size\" alt=\"Malerei\">
                </td>
            </tr>
            <tr>
                <td style=\"text-align: center\">
                    <span style=\"color:grey; font-size: 15px;\">$summary</span>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    
    ";

    $altVerwaltung = "Neue Anfrage von $vorname $nachname";


    $template = "
    <div style=\"margin:0 auto;padding:0;background-color:#f3f3f3\">
        <table align=\"center\">
            <tbody>
                <tr>
                    <td>
                        <table align=\"center\" style=\"width:100%;max-width:600px;margin:0 auto;background-color:#ffffff\">
                            <tbody>
                                <tr>
                                    <td align=\"left\" style=\"padding-top: 30px; padding-bottom: 30px;\">
                                        <table align=\"center\" style=\"width:90%\">
                                            <tbody>
                                                <tr>
                                                    <td align=\"left\">
                                                        <a href=\"https://www.arnulfhoffmann.de/\">
                                                            <img src=\"https://www.arnulfhoffmann.de/static/pictures/logo/logo3-1.png\" alt=\"arnulfhoffmann Gallerie Logo\">
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table align=\"center\" style=\"width:100%;max-width:600px;margin:0 auto;background-color:#ffffff\">
                        <tbody>
                                <tr>
                                    <td align=\"center\">
                                        <table align=\"center\" style=\"width:90%\">
                                            <tbody>
                                                <tr>
                                                    <td align=\"center\" style=\"font-family:'PT Sans',sans-serif;font-weight:normal;font-size:16px;line-height:24px;color:#000001;text-align:left\">
                                                        <h6></h6>
                                                        <span>
                                                            %content%
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>        
        </table>
    </div>";

    function getHtmlMail(bool $client, String $template){
        global $clientEmail, $verwaltungEmail;
        if($client){
            return str_replace("%content%", $clientEmail, $template);
        }
        return str_replace("%content%", $verwaltungEmail, $template);
    }   
?>