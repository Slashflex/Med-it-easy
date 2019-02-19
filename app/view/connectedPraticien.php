<?php $title = 'Med It Easy | Profil praticien'; ?>

<?php ob_start(); ?>

<div class="container">
    <div class="header_connected">
        <h4>Bienvenue <?= ucfirst($_SESSION['praticienPrenom']) . ' ' . ucfirst($_SESSION['praticienNom']) . ' '; ?></h4>
    </div>
    <p class="text-center">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez voir et gérer vos
        consultations.</p>
        <!-- <a href="index.php?action=suppresspraticien" class="btn-update">Prendre rendez-vous</a>
        <a href="index.php?action=updatepraticien" class="btn-update">Mettre à jour mes informations</a> -->
        <a href="index.php?action=deletePraticien" class="btn-update">Supprimer mon compte</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require 'app\view\template.php'; ?>