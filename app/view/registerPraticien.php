<?php $title = 'Med It Easy | Inscription praticien'; ?>

<?php ob_start(); ?>

<div class="header">
    <h2>Inscription <br>praticien</h2>
</div>

<!-- Formulaire d'inscription du Praticien -->
<form class="patientForm" name="praticienForm" method="post" action="index.php?action=registerPraticien">
    <div class="input-group">
        <label for="prenom">Prenom</label>
        <input type="text" name="praticienPrenom" id="first" placeholder="ex: Chuck" autocomplete="off" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="nom">Nom</label>
        <input type="text" name="praticienNom" id="last" placeholder="ex: Norris" autocomplete="off" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="birthDate">Date de naissance</label>
        <input type="date" name="praticienDate" id="birthDate" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="praticienEmail" id="mail" placeholder="ex: chuck@norris.com" autocomplete="off" required>
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
        <label for="specialite">Choisissez votre spécialité</label>
        <select name="specialite" class="mx-auto">Choisissez votre spécialité
            <option value="Médecin généraliste">Médecin généraliste</option>
            <option value="Dentiste">Dentiste</option>
            <option value="Dermatologue">Dermatologue</option>
            <option value="Gynécologue">Gynécologue</option>
            <option value="Médecin du travail">Médecin du travail</option>
            <option value="Médecin du sport">Médecin du sport</option>
            <option value="Ophtalmologue">Ophtalmologue</option>
            <option value="Pédiatre">Pédiatre</option>
        </select>
    </div>
    <div class="input-group">
        <button type="submit" class="btn-form" id="send" name="registerPraticien">Inscription</button>
    </div>
    <p>
        Déjà praticien ? <a href="index.php?action=connexionPraticien">Connectez-vous<i class="fas fa-sign-in-alt"></i></a>
    </p>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('app\view\template.php'); ?>
