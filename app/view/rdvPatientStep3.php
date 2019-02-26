<?php $title = 'Med It Easy | Réservation consultation - étape 2/4'; ?>

<?php ob_start(); ?>

<div class="container">
    <header id="headerRdv">
        <div class="head">
            <a class="navbar-brand" href="index.php">MED <span class="separator">IT</span> EASY</a>
            <div id="steps">
                <div class="book-step">
                    <div class="tooltipPop">
                        <a href="index.php?action=rdvPatient" data-toggle="tooltip" data-placement="bottom" title="Etape 1/3 :  choix type de consultation et praticien"><strong
                                id="step1">1</strong></a>
                    </div>
                </div>
                <div class="book-step">
                    <div class="tooltipPop">
                        <a href="index.php?action=rdvStep1ToStep2" data-toggle="tooltip" data-placement="bottom" title="Etape 2/3 :  date et heure souhaitée"><strong
                                id="step2">2</strong></a>
                    </div>
                </div>
                <div class="book-step active-step">
                    <a href="index.php?action=rdvStep2ToStep3" data-toggle="tooltip" data-placement="bottom" title="Etape 3/3 : confirmation des informations"><strong
                            id="step3">3</strong></a>
                </div>
            </div>
        </div>
    </header>
    <div id="contentStep1">
        <h3 class="frame-title">Veuillez confirmer vos informations</h3>
        <p class="text-center bold">Un email contenant un récapitulatif ainsi que la confirmation de votre
            rendez-vous vous sera envoyé</p>
        <div id="typeConsult">
            <!-- Appointment's choice -->
            <div class="form-group">
                <!-- Doctor's choice -->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- TO DO ... confirmation des infos -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" id="prev_nextBtn">
            <div id="prev_nextButtons" class="text-center">
                <a href="index.php?action=rdvStep1ToStep2" class="btn-update">Retour</a>
                <a href="index.php?action=confirmRdvPatient" class="btn-update">Confirmer</a>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('app\view\template.php');
