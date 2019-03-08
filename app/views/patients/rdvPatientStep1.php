<?php $title = 'Med It Easy | Réservation consultation - étape 1/3'; ?>

<?php ob_start(); ?>

<div class="container formRdv">
    <div class="row">
        <form action="index.php?action=testJson" class="mx-auto multiStep" method="post">
            <header class="headerRdv">
                <div class="head">
                    <a class="navbar-brand headerLogo" href="index.php">MED <span class="separator">IT</span> EASY</a>
                    <div id="steps">
                        <div class="book-step active-step">
                            <div class="tooltipPop">
                                <a href="index.php?action=rdvStep1" data-toggle="tooltip" data-placement="bottom"
                                    title="Etape 1/3 :  choix type de consultation et praticien"><strong
                                        id="step1">1</strong></a>
                            </div>
                        </div>
                        <div class="book-step">
                            <div class="tooltipPop">
                                <a href="index.php?action=rdvStep1ToStep2" data-toggle="tooltip" data-placement="bottom"
                                    title="Etape 2/3 :  date et heure souhaitée"><strong id="step2">2</strong></a>
                            </div>
                        </div>
                        <div class="book-step">
                            <a href="index.php?action=rdvStep2ToStep3" data-toggle="tooltip" data-placement="bottom"
                                title="Etape 3/3 : confirmation des informations"><strong id="step3">3</strong></a>
                        </div>
                    </div>
                </div>
            </header>
            <div class="contentStep1">
                <h3 class="frame-title">Choisissez un type de consultation <br>et un praticien</h3>
                <div id="typeConsult">
                    <!-- Appointment's choice -->
                    <div class="form-group">
                        <!-- Type of acte -->
                        <div class="text-center">
                            <label for="selectConsult"><strong class="selectType ">Type de consultation</strong></label>
                        </div>
                        <select id="selectConsult" name="test" class="col-xs-12 form-control select">
                            <?php while ($data = $typeActes->fetch()): ?>
                            <option style="color: <?= ucfirst($data['couleur']); ?>" value="<?= $data['id_type']; ?>">
                                <?= ucfirst($data['description']) . ' ' . ucfirst($data['dureeConsultation']); ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <!-- Doctor's choice -->
                        <div class="text-center">
                            <label for="selectPraticien"><strong class="selectType">Choix du
                                    praticien</strong></label>
                            <select id="selectPraticien" name="id_praticien" class="col-xs-12 form-control">
                                <?php $previousCat = ""; ?>
                                <?php $i = 0; ?>

                                <?php while ($data = $coords->fetch()) { ?>

                                <?php if ($data['description'] !== $previousCat) { ?>
                                <?php $previousCat = $data['description']; ?>
                                <?php if ($i !== 0) { ?>
                                    </optgroup>
                                <?php } ?>
                                <?php $i += 1; ?>
                                <optgroup label="<?= $data['description']; ?>">
                                    <option value="<?= $data['id_praticien']; ?>">
                                        Dr.<?= ' ' . ucfirst($data['praticienNom']) . ' ' . ucfirst($data['praticienPrenom']) ; ?>
                                    </option>
                                    <?php } else { ?>
                                    <option value="<?= $data['id_praticien']; ?>">
                                        Dr.<?= ' ' . ucfirst($data['praticienNom']) . ' ' . ucfirst($data['praticienPrenom']) ; ?>
                                    </option>
                                    <?php } ?>
                                    <?php }; ?>
                                    </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="container" id="prev_nextBtn">
                    <div id="prev_nextButtons" class="text-center">
                        <a href="index.php?action=backToConnectedPatient" class="btn-update">Retour</a>
                        <!-- <a href="index.php?action=testJson" name="next" class="btn-update">Suivant</a> -->
                        <input type="submit" class="btn-update" value="Suivant">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('app\views\template.php');