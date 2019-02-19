<?php $title = 'Med It Easy | Profil praticien'; ?>

<?php ob_start(); ?>
<div id="bloc_admin">

</div>
<div class="container">
    <div class="header_connected">
        <h4>Bienvenue Docteur <?= ucfirst($_SESSION['praticienPrenom']) . ' ' . ucfirst($_SESSION['praticienNom']) . ' '; ?>
        </h4>
    </div>
    <p class="text-center">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez voir et gérer vos
        consultations.</p>
    <div class="row">
        <div class="text-center mt-3 mx-auto" id="btn-margin">
            <a href="index.php?action=rdvPraticien" class="btn-update col-lg-4">Voir les rendez-vous</a><br>
            <a href="index.php?action=updatePraticien" class="btn-update col-lg-4">Mise à jour du compte</a><br>
            <a href="index.php?action=deletePraticien" class="btn-update col-lg-4">Supprimer mon compte</a>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require 'app\view\template.php';
