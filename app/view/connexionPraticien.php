<?php $title = 'Med It Easy | Connexion en tant que praticien'; ?>

<?php ob_start(); ?>
<div class="header">
    <h2>Connexion <br>praticien</h2>
</div>

<!-- Formulaire d'inscription du Praticien -->
<form class="patientForm" name="praticienForm" method="post" action="index.php?action=connectedPraticien">

    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="praticienEmail" id="mailLogin" value="" autocomplete="off" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="password_1">Mot de passe</label>
        <input type="password" id="password_1" name="password_1" required>
        <span class="error-message mx-auto"></span>
    </div>

    <div class="input-group">
        <button type="submit" class="btn-form" id="send" name="registerPraticien">Connexion</button>
    </div>
    <div class="input-group">
        <label class="wrapper">Se souvenir de moi
            <input type="checkbox">
            <span class="checkmark"></span>
        </label>
    </div>
    <p>
        Pas encore membre ? <a href="index.php?action=addPraticien">Inscrivez-vous<i class="fas fa-sign-in-alt"></i></a>
    </p>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('app\view\template.php'); ?>