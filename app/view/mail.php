<?php
    $to      = 'personne@example.com';
    $subject = 'Med It Easy | Confirmation de compte';
    $message = 'Bonjour ! <br><br> Afin de confirmer votre inscription sur le site Med It Easy, 
    merci de cliquer sur le lien ci-dessous. <br>';
    $headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
?>
