<?php

    $altClient = "Sehr geehrter Herr $nachname \n\n vielen dank für ihr Interesse an einer Arnulf Hoffmann Malerei. Wir melden uns in kürze bei ihnen. \n\n Ihre Familie Hoffmann";
    
    $clientEmail = "
    <b>Sehr geehrter Herr $nachname</b>

    <br>
    <br>

    vielen dank für ihr Interesse. Wir melden uns so bald wie möglich bei Ihnen damit Sie schon 
    bald ihre Malerei von Arnulf Hoffmann genießen können.

    <br>
    
    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique necessitatibus 
    tempora asperiores eaque sequi delectus vel animi sit. Illum, reiciendis ratione. 
    Corporis voluptas a minus, autem cupiditate tempore ullam quae!

    <br>
    <br>

    Ihre Familie Hoffmann
    ";

    $verwaltungEmail = "
    <b>Neue Anfrage von $vorname $nachname</b>

    <br>
    <br>

    Bitte so bald wie möglich zurück schreiben.

    <br>

    Euer Flo
    
    ";

    $altVerwaltung = "Neue Anfrage von $vorname $nachname";


    $template = "
    <div style=\"margin:0 auto;padding:0;background-color:#f3f3f3\">
        <table align=\"center\">
            <tbody>
                <tr>
                    <td>
                        <table align=\"center\" style=\"width:100%;max-width:600px;margin:0 auto\">
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
                        <table align=\"center\" style=\"width:100%;max-width:600px;margin:0 auto\">
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