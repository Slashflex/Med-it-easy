<?php $title = 'Med It Easy | Inscription patient'; ?>

<?php ob_start(); ?>

<div class="header">
    <h2>Inscription <br>patient</h2>
</div>

<!-- Formulaire d'inscription du Patient -->
<form class="patientForm" name="patientForm" method="post" action="index.php?action=registerPatient">
    <span></span>
    <div class="input-group">
        <label for="prenom">Prenom</label>
        <input type="text" name="patientPrenom" id="first" placeholder="ex: Chuck" autocomplete="off" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="nom">Nom</label>
        <input type="text" name="patientNom" id="last" placeholder="ex: Norris" autocomplete="off" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="birthDate">Date de naissance</label>
        <input type="date" name="patientDate" id="birthDate"  required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="mail" placeholder="ex: chuck@norris.com" autocomplete="off" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="password_1">Mot de passe</label>
        <input type="password" id="password_1" name="password_1" autocomplete="off" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="password_2">Confirmation de mot de passe</label>
        <input type="password" id="password_2" name="password_2" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <button type="submit" class="btn-form" id="send" name="registerPatient">Inscription</button>
    </div>
    <p>
        Déjà patient ? <a href="index.php?action=connexionPatient">Connectez-vous<i class="fas fa-sign-in-alt"></i></a>
    </p>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('app\view\template.php'); ?>
