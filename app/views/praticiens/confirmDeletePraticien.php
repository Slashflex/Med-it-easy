<?php $title = 'Med It Easy | Gestion de compte praticien'; ?>

<?php ob_start(); ?>

<div class="container text-center">
    <a href="index.php?action=confirmSuppressionPraticien&id=<?= $_SESSION['id']; ?>" class="btn-update">Confirmer</a>
    <a href="index.php?action=cancelSuppressionPraticien" class="btn-update">Annuler</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('app\views\template.php');
