<?php $title = 'Med It Easy | Profil patient'; ?>

<?php ob_start(); ?>

<?php
if ($_SESSION['id_praticien'] == 1): ?>
<div class="container">
    <div class="header_connected">
        <h4>Bienvenue <?= ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . ' '; ?>
        </h4>
    </div>
    <div class="header">
        <h2>Vous devez choisir un praticien</h2>
    </div>
    <form class="patientForm" name="patientForm" method="post" action="index.php?action=choosePraticien">
        <div class="text-center">
            <label for="selectPraticien"><strong class="selectType">Choix du
                    praticien</strong></label>
            <select id="selectPraticien" name="id_praticien" class="col-xs-12 form-control">
                <?php $previousCat = ""; ?>
                <?php $i = 0; ?>
                <?php while ($data = $coords->fetch()): ?>
                    <?php if ($data['description'] !== $previousCat): ?>
                            <?php $previousCat = $data['description']; ?>
                        <?php if ($i !== 0): ?>
                </optgroup>
                    <?php endif; ?>
                <?php $i += 1; ?>
                <optgroup label="<?= $data['description']; ?>">
                    <option value="<?= $data['id_praticien']; ?>">
                        Dr.<?= ' ' . ucfirst($data['praticienNom']) . ' ' . ucfirst($data['praticienPrenom']) ; ?>
                    </option>
                    <?php else: ?>
                    <option value="<?= $data['id_praticien']; ?>">
                        Dr.<?= ' ' . ucfirst($data['praticienNom']) . ' ' . ucfirst($data['praticienPrenom']) ; ?>
                    </option>
                    <?php endif; ?>
                    <?php endwhile; ?>
                </optgroup>
            </select>
        </div>
        <div class="input-group">
            <button type="submit" class="btn-form" id="send" name="updateInfos">Valider</button>
        </div>
    </form>

    <?php  else: ?>
    <div class="container">
        <div class="header_connected">
            <h4>Bienvenue <?= ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . ' '; ?>
            </h4>
        </div>
        <p class="text-center selectType">Vous êtes sur la page de gestion de votre profil, d'ici vous pourrez voir vos
            consultations et gérer votre profil.</p>
        <div class="row">
            <div class="text-center mx-auto" id="btn-margin">
                <ul>
                    <li>
                        <a href="index.php?action=listRdv" class="btnMultiStepForm col-lg-3">Vos rendez-vous</a>
                    </li>
                    <li>
                        <a href="index.php?action=rdvPatient" class="btnMultiStepForm col-lg-3">Prendre rendez-vous</a>
                    </li>
                    <li>
                        <a href="index.php?action=updatePatient" class="btnMultiStepForm col-lg-3" data-toggle="modal"
                            data-target="#modal_update">Mise
                            à jour du compte</a>
                    </li>
                    <li>
                        <a href="index.php?action=deletePatient" class="btnMultiStepForm col-lg-3">Supprimer mon
                            compte</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Modal to update Patient email and password -->
    <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="modal_update" aria-hidden="true">
        <div class="header">
            <h2>Mise à jour de vos données</h2>
        </div>
        <div class="body1">
            <form class="patientForm" name="patientForm" method="post" action="index.php?action=updatePatient">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="mail" value="" autocomplete="off" required>
                    <!-- <?= $_SESSION['patientEmail']; ?>-->
                    <span class="error-message mx-auto"></span>
                </div>
                <div class="input-group">
                    <label for="password_1">Mot de passe</label>
                    <input type="password" id="password_1" name="password_1" required>
                    <span class="error-message mx-auto"></span>
                </div>
                <div class="input-group">
                    <a href="index.php?action=backToConnectedPatient" class="btn-form" id="send">Retour</a>
                    <button type="submit" class="btn-form" id="send" name="updateInfos">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $content = ob_get_clean(); ?>

<?php require 'app/views/template.php';
