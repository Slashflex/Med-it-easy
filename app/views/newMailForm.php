<?php $title = 'Med It Easy | Confirmation de votre compte'; ?>

<?php ob_start(); ?>

<div class="mt-5 pt-5 mx-auto">
    <div class="header">
        <h2 class="">Veuillez indiquer un mail valide</h2>
    </div>
    <form class="patientForm" action="index.php?action=sendNewConfirmMail" method="post">
        <!-- regxp -->
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="mail" placeholder="ex: chuck@norris.com" autocomplete="off" required>
            <span class="error-message mx-auto"></span>
        </div>
        <div class="" id="backBtn">
            <a href="index.php" class="btnBack p-2"><i class="fas fa-chevron-left"></i> Retour</a>
        </div>
        <div class="" id="backBtn">
            <input type="submit" value="Valider">
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php');
