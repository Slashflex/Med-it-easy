<?php
    $to      = 'personne@example.com';
    $subject = 'Med It Easy | Confirmation de compte';
    $message = 'Bonjour ! <br> 
    Afin de confirmer votre inscription sur le site Med It Easy, 
    merci de cliquer sur le lien ci-dessous. <br>
    <a href="confirmationMail">Confirmez votre inscription</a>';
    $headers = 'From: admin@med-it-easy.com' . "\r\n" .
    'Reply-To: admin@med-it-easy.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
?>
