<?php $title = 'Med It Easy | Email de confirmation envoyé'; ?>

<?php ob_start(); ?>

<div class="container mx-auto mt-5 pt-5">
    <p>Merci de vous être inscrit, un mail de confirmation vous à été envoyé.</p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php');