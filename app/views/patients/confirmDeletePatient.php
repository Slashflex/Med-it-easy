<?php $title = 'Med It Easy | Gestion de compte patient'; ?>

<?php ob_start(); ?>

<div class="container text-center">
    <a href="index.php?action=confirmSuppression&id=<?= $_SESSION['id']; ?>" class="btn-update">Confirmer</a>
    <a href="index.php?action=cancelSuppression" class="btn-update">Annuler</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('app\views\template.php');

