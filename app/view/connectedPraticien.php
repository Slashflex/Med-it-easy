<?php $title = 'Med It Easy | Profil praticien'; ?>

<?php ob_start(); ?>

<input id="menu-trigger" type="checkbox">
<label id="label" for="menu-trigger"><i class="fas fa-tools fa-2x"></i></label>

<div id="content">
    <div class="header_connected">
        <h4>Bienvenue Docteur <?= ucfirst($_SESSION['praticienPrenom']) . ' ' . ucfirst($_SESSION['praticienNom']) . ' '; ?>
        </h4>
    </div>
    <p class="text-center">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez voir et gérer vos
        consultations.</p>
</div>

<nav id="test">
    <ul class="menu">
        <li><a href="#"><i class="far fa-calendar-alt fa-2x"></i> Link</a></li>
        <li><a href="#"><i class="fas fa-hand-holding-usd fa-2x"></i> Tarifs</a></li>
        <li><a href="#"><i class="fas fa-search fa-2x"></i> Recherche</a></li>
        <li><a href="#"> Link</a></li>
        <li><a href="#"> Link</a></li>
    </ul>
</nav>

<!-- <div class="container">
    <div class="row">
        <ul>
            <li class="text-center mt-3 mx-auto" id="btn-margin"><a href="index.php?action=rdvPraticien" class="btn-update col-lg-4">Voir
                    les rendez-vous</a><br></li>
            <li class="text-center mt-3 mx-auto" id="btn-margin"><a href="index.php?action=updatePraticien" class="btn-update col-lg-4">Mise
                    à jour du compte</a><br></li>
            <li class="text-center mt-3 mx-auto" id="btn-margin"><a href="index.php?action=deletePraticien" class="btn-update col-lg-4">Supprimer
                    mon compte</a></li>
        </ul>
    </div>
</div> -->

<?php $content = ob_get_clean(); ?>

<?php require 'app\view\template.php';
