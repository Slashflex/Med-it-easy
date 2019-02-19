<?php $title = 'Med It Easy | Profil patient'; ?>

<?php ob_start(); ?>

<div class="container">
    <div class="header_connected">
        <h4>Bienvenue <?= ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . ' '; ?>
        </h4>
    </div>
    <p class="text-center">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez voir et gérer vos
        consultations.</p>
    <div class="row">
        <div class="text-center mt-3 mx-auto" id="btn-margin">
            <a href="index.php?action=rdvPatient" class="btn-update col-lg-4">Prendre rendez-vous</a><br>
            <a href="index.php?action=updatePatient" class="btn-update col-lg-4">Mise à jour du compte</a><br>
            <a href="index.php?action=deletePatient" class="btn-update col-lg-4">Supprimer mon compte</a>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require 'app\view\template.php';
