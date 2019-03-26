<?php $title = 'Med It Easy | Agenda'; ?>

<?php ob_start(); ?>

<!-- OffMenu Canva -->
<div id="offCanva">
    <input id="menu-trigger" type="checkbox">
    <label id="label" for="menu-trigger" onclick="document.getElementById('offCanva').classList.toggle('open');"><i
            class="fas fa-tools fa-2x"></i></label>

    <div id="content">
        <div class="header_connected">
            <h4>Bienvenue Docteur <?= ucfirst($_SESSION['praticienPrenom']) . ' ' . ucfirst($_SESSION['praticienNom']); ?>
            </h4>
        </div>
        <p class="text-center margin selectType">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez
            voir et
            gérer vos
            consultations.</p>
        <div id="calendar"></div>
    </div>

    <nav id="offCanvaNav">
        <!-- Displaying the time and date in the off-canva menu -->
        <div class="dateNav mx-auto"><?php setlocale(LC_ALL, 'fr_FR'); ?><?=  ucfirst(strftime("%A %e %B %Y", mktime())) . '<br>' . strftime("%H : %M", mktime());?>
        </div>
        <ul class="menu mx-auto offMenu">
            <li><a href="fr/accueil"><i class="fas fa-home fa-1x"></i> Accueil</a></li>
            <li><a href="fr/agenda"><i class="far fa-calendar-alt fa-1x"></i> Agenda</a></li>
            <li><a href="fr/tarifs"><i class="fas fa-hand-holding-usd fa-1x"></i> Tarifs</a></li>
            <li><a href="fr/horaires"><i class="far fa-clock fa-1x"></i> Horaires</a></li>
            <li><a href="fr/patientele"><i class="fas fa-users"></i> Patientèle</a></li>
            <li><a href="fr/suppression-du-compte"><i class="fas fa-sign-out-alt"></i> Supprimer mon compte</a></li>
        </ul>
    </nav>
</div><!-- end: OffMenu Canva -->

<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php');