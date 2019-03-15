<?php $title = 'Med It Easy | Listing rendez-vous'; ?>

<?php ob_start(); ?>

<div class="container">
    <div class="header_connected">
        <h4>Bienvenue <?= ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . ' '; ?>
        </h4>
    </div>
    <p class="text-center selectType">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez voir vos
        consultations et gérer votre profil.</p>
    <div class="row">
        <div id="prev_nextButtons" class="text-center">
            <h5 class="mx-auto mt-3 mb-4 frame-title col-lg-12">Vos consultations à venir :</h5>
            <a href="index.php?action=backToConnectedPatient" class="btnMultiStepForm">Retour</a>
            <a href="index.php?action=updateRdv" class="mx-auto editBtn"><i class="far fa-edit"></i> Modifier</a>
        </div>
        <?php while ($data = $listRdv->fetch()): ?>
        <p class="text-center col-md-12 selectType" style="width: 100%; border-bottom: 1px solid #dbae58">
            <hr>
            <?= '<span id="colorRdv" style="background-color:' . $data['couleur'] . '">' . $data['description'] . '</span>Le ' . $data['start'] .
                ' à ' . $data['hour'] .
                ' avec le Docteur ' . ucfirst($data['praticienPrenom']) .
                ' ' . ucfirst($data['praticienNom']);  ?>
        </p>
        <?php endwhile; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require 'app\views\template.php';