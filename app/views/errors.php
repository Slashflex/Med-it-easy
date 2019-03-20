<?php $title = 'Med It Easy | Inscription'; ?>

<?php ob_start(); ?>

<p class="displayErrors text-center mx-auto"> <?= $errors; ?> </p>

<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php'); ?>
