<?php $title = 'Med It Easy | Réservation consultation - étape 1/4'; ?>

<?php ob_start(); ?>

<div class="container">
    <header id="headerRdv">
        <div class="head">
            <a class="navbar-brand" href="index.php">MED <span class="separator">IT</span> EASY</a>
            <div id="steps">
                <div class="book-step active-step">
                    <div class="tooltipPop">
                        <a href="" data-toggle="tooltip" data-placement="bottom" title="Etape 1/3 :  choix type de consultation et praticien"><strong
                                id="step1">1</strong></a>
                    </div>

                </div>
                <div class="book-step">
                    <div class="tooltipPop">
                        <a href="" data-toggle="tooltip" data-placement="bottom" title="Etape 2/3 :  date et heure souhaitée"><strong
                                id="step2">2</strong></a>
                    </div>

                </div>
                <div class="book-step">
                    <strong id="step3">3</strong>
                </div>
            </div>
        </div>
    </header>
    <div id="contentStep1">
        <h3 class="frame-title">Choisissez un type de consultation et un praticien</h3>
        <div id="typeConsult">
            <!-- Appointment's choice -->
            <div class="form-group">
                <label for="selectConsult"><strong class="selectType">Type de consultation</strong></label>
                <select id="selectConsult" class="col-md-4 form-control">
                    <option value="Urgence">Urgence</option>
                    <option value="Visite à domicile">Visite à domicile</option>
                </select>
                <!-- Doctor's choice -->
                <label for="selectPraticien"><strong class="selectType">Choix du praticien</strong></label>
                <select id="selectPraticien" class="col-md-4 form-control">
                    <option value="Docteur machin bidule - Médecin généraliste">Docteur machin bidule - Médecin
                        généraliste</option>
                    <option value="Docteur trucmuche - Ophtalmologue">Docteur trucmuche - Ophtalmologue</option>
                </select>
            </div>
        </div>
        <div class="container" id="prev_nextBtn">
            <div id="prev_nextButtons" class="text-center">
                <a href="index.php?action=backToConnectedPatient" class="btn-update">Annuler</a>
                <a href="index.php?action=rdvStep1ToStep2" class="btn-update">Suivant</a>
            </div>
        </div>
    </div>

</div>







<?php $content = ob_get_clean(); ?>

<?php require('app\view\template.php');
