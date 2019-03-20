<?php $title = 'Med It Easy | Connexion en tant que patient'; ?>

<?php ob_start(); ?>

<div class="header">
    <h2>Connexion <br>patient</h2>
</div>

<!-- Patient connexion form -->
<form class="patientForm" name="patientForm" method="post" action="index.php?action=connectedPatient">
    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="mail" value="" autocomplete="off" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="password_1">Mot de passe</label>
        <input type="password" name="password_1" required><!-- id="password_1" -->
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <button type="submit" class="btn-form" id="send" name="registerPatient">Connexion</button>
    </div>
    <div class="input-group">
        <label class="wrapper">Se souvenir de moi
            <input type="checkbox">
            <span class="checkmark"></span>
        </label>
    </div>
    <p>
        Pas encore patient ? <a href="index.php?action=addPatient">Inscrivez-vous<i class="fas fa-sign-in-alt"></i></a>
    </p>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php');
