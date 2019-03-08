<?php $title = 'Med It Easy | Profil patient'; ?>

<?php ob_start(); ?>

<div class="container">
    <div class="header_connected">
        <h4>Bienvenue <?= ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . ' '; ?>
        </h4>
    </div>
    <p class="text-center">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez voir vos consultations
        et gérer votre profil.</p>
    <div class="row">
        <div class="text-center mt-3 mx-auto" id="btn-margin">
            <a href="index.php?action=rdvPatient" class="btn-update col-lg-4">Prendre rendez-vous</a><br>
            <a href="index.php?action=updatePatient" class="btn-update col-lg-4" data-toggle="modal" data-target="#modal_update">Mise
                à jour du compte</a><br>
            <a href="index.php?action=deletePatient" class="btn-update col-lg-4">Supprimer mon compte</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="modal_update" aria-hidden="true">
        <!-- <div class="modal-dialog" role="document"> -->
            <div class="header">
                <h2>Mise à jour de vos données</h2>
            </div>
            <div class="body1">
                <form class="patientForm" name="patientForm" method="post" action="index.php?action=updatePatient">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="mail" value="<?= $_SESSION['patientEmail']; ?>"
                            autocomplete="off">
                        <span class="error-message mx-auto"></span>
                    </div>
                    <div class="input-group">
                        <label for="password_1">Mot de passe</label>
                        <input type="password" id="password_1" name="password_1">
                        <span class="error-message mx-auto"></span>
                    </div>
                    <div class="input-group">
                    <a href="index.php?action=backToConnectedPatient" class="btn-form" id="back">Retour</a>
                        <button type="submit" class="btn-form" id="send" name="updateInfos">Valider</button>
                    </div>
                </form>
            </div>
        <!-- </div> -->
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require 'app\view\template.php';
