<?php $title = 'Med It Easy | Listing rendez-vous'; ?>

<?php ob_start(); ?>

<?php
// if ($_SESSION['id_praticien'] == 1000) {
?>
<!-- <div class="container">
    <div class="header_connected">
        <h4>Bienvenue <?= ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . ' '; ?>
</h4>
</div> -->

<div class="container">
    <div class="header_connected">
        <h4>Bienvenue <?= ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . ' '; ?>
        </h4>
    </div>
    <p class="text-center">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez voir vos
        consultations et gérer votre profil.</p>

    <div class="row">
        <h5 class="">Vos consultations à venir :</h5>
        <p></p>
        <p>Rendez-vous le :</p>
        <?php foreach ($listRdv as $data): ?>
        <p>
            <?= ' ' . $data['start'] . ' à ' . $data['hour'] . ' avec le Docteur ' . $data['praticienPrenom'] . ' ' . $data['praticienNom']; ?><br>
        </p>
        <?php endforeach; ?>
        <?php
   // }
    ?>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require 'app\views\template.php';
