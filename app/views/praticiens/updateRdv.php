<?php $title = 'Med It Easy | Modifier un rendez-vous'; ?>

<?php ob_start(); ?>

<?php while ($data = $req->fetch()): ?>
<div class="row pt-5 mt-5" style="background-color:<?= $data['couleur']; ?>">
    <p class="toDo"><?= $data['id_event']; ?></p>
    <p class="toDo"><?= $data['description']; ?></p>
    <p class="toDo"><?= ucfirst($data['patientPrenom']) . ' ' . ucfirst($data['patientNom']); ?></p>
    <p class="toDo"><?= $data['start']; ?></p>
    <p class="toDo"><?= $data['hour']; ?></p>
</div>
<?php endwhile; ?>


<?php $content = ob_get_clean(); ?>

<?php require 'app/views/template.php';
