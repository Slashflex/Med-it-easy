<?php $title = 'Med It Easy | Confirmation de votre compte'; ?>

<?php ob_start(); ?>

<div class="mx-auto mt-5 pt-5">
    <p>Votre compte a bien été confirmé</p>
    <a href="index.php?action=autoLogin&token=<?= $token?>">Espace personnel</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php');
