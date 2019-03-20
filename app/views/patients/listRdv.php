<?php $title = 'Med It Easy | Listing rendez-vous'; ?>

<?php ob_start(); ?>

<div class="container">

    <div class="header_connected">
        <!-- <div class="float-left">
            <a href="index.php?action=backToConnectedPatient" class="btnBack ">Retour</a>
        </div> -->
        <h4>Bienvenue <?= ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) ?>
        </h4>
    </div>

    <p class="text-center selectType">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez voir vos
        consultations et gérer votre profil.</p>
    <div class="row">

        <h5 class="mx-auto  mb-4 frame-title col-lg-12">Vos consultations à venir :</h5>

        <?php while ($data = $listRdv->fetch()): ?>
        <p class="text-center col-lg-12 selectType" style="width: 100%">
            <div class="typeRdv text-center">
                <span id="colorRdv" class="text-center"
                    style="background-color:<?= $data['couleur'] ?>"><?= $data['description'] ?></span>
            </div>
            <div class="concatRdv mx-auto" style="margin-top: 10px;">
                <p class="text-center paragraph">Le <?= $data['start'] ?>
                    à <?=$data['hour'] ?>
                    avec le Docteur <?= ucfirst($data['praticienPrenom']) ?>
                    <?= ucfirst($data['praticienNom']) ?>
                    <hr style="width: 65%; margin: 0 auto;">
                </p>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<div class="float-left" id="backBtn">
    <a href="index.php?action=backToConnectedPatient" class="btnBack p-2"><i class="fas fa-chevron-left"></i> Retour</a>
</div>
<?php $content = ob_get_clean(); ?>

<?php require 'app/views/template.php';
