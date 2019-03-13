<?php $title = 'Med It Easy | Mise à jour de vos informations'; ?>

<?php ob_start(); ?>

<div class="container">
    <form class="patientUpdateForm" name="patientForm" method="post" action="index.php?action=updatePatient">
    
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
            <button type="submit" class="btn-form" id="send" name="updateInfos">Inscription</button>
        </div>
    </form>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('app\views\template.php');
