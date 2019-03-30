<?php $title = 'Med It Easy | Confirmation de votre compte'; ?>

<?php ob_start(); ?>

<div class="mx-auto mt-5 pt-5">
    <a href="index.php?action=autoLogin&token=<?= $token?>">Espace personnel</a>
    </a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php');
