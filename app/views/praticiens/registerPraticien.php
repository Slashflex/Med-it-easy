<?php $title = 'Med It Easy | Inscription praticien'; ?>

<?php ob_start(); ?>

<div class="header">
    <h2>Inscription <br>praticien</h2>
</div>

<!-- Information icon -->
<div class="btnInfos mx-auto" id="hideInfos">
    <div class="bgInfos text-center"><i class="fas fa-info"></i></div>
</div>
<!-- Left side information panel, appears only on mouseenter...
...on "information icon" inside form -->
<div class="toggleInfos">
    <h4 class="text-center">Caractères autorisés</h4>
    <p class="text-center regExpcolor"><span class="regExpList">Prénom et Nom : </span><br><span class="txtShadow">A-Za-zéèêîïôüäë -</span></p>
    <p class="text-center regExpcolor"><span class="regExpList">Email: </span><br><span class="txtShadow">Tous exceptés celui-ci : <</span></p>
    <p class="text-center regExpcolor"><span class="regExpList">Date de naissance: </span><br><span class="txtShadow">Doit être comprise entre le 01/01/1930 et le 30/03/2019</span></p>
    <p class="text-center regExpcolor"><span class="regExpList">Mot de passe : </span><br><span class="txtShadow">Majuscule obligatoire en premier, suivie de a-zA-Z0-9_-</span></p>
</div>
<!-- Doctor registration form -->
<form class="patientForm" name="praticienForm" method="post" action="fr/inscription_praticen">
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
        <input type="date" name="praticienDate" id="birthDate" min="1930-01-01" max="2019-05-30" required>
        <span class="error-message mx-auto"></span>
    </div>
    <div class="input-group">
        <label for="email">Email</label>
        <input type="email" name="praticienEmail" id="mail" placeholder="ex: chuck@norris.com" autocomplete="off"
            required>
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
        <?php while ($specialite = $specialites->fetch()): ?>
                <option value="<?= $specialite['id_spe']; ?>"><?= $specialite['description']; ?>
                </option>
        <?php endwhile; ?>
        </select>
    </div>
    <div class="input-group">
        <button type="submit" class="btn-form" id="send" name="registerPraticien">Inscription</button>
    </div>
    <p>
        Déjà inscrit ? <a href="fr/connexion-praticien">Connectez-vous<i class="fas fa-sign-in-alt"></i></a>
    </p>
</form>
<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php');
