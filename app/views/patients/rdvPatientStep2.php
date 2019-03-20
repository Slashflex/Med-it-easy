<?php $title = 'Med It Easy | Réservation consultation - étape 2/3'; ?>

<?php ob_start(); ?>

<div class="container formRdv">
    <div class="row">
        <form action="index.php?action=testJson2" class="mx-auto multiStep" method="post">
            <header class="headerRdv">
                <div class="head">
                    <a class="navbar-brand headerLogo" href="index.php">MED <span class="separator">IT</span> EASY</a>
                    <div id="steps">
                        <div class="book-step">
                            <div class="tooltipPop">
                                <a href="fr/prendre-un-rendez-vous" data-toggle="tooltip" data-placement="bottom" title="Etape 1/3 :  choix type de consultation et praticien"><strong
                                        id="step1">1</strong></a>
                            </div>
                        </div>
                        <div class="book-step active-step">
                            <div class="tooltipPop">
                                <a href="fr/etape-2" data-toggle="tooltip" data-placement="bottom"
                                    title="Etape 2/3 :  date et heure souhaitée"><strong id="step2">2</strong></a>
                            </div>
                        </div>
                        <div class="book-step">
                            <a href="fr/etape-3" data-toggle="tooltip" data-placement="bottom"
                                title="Etape 3/3 : confirmation des informations"><strong id="step3">3</strong></a>
                        </div>
                    </div>
                </div>
            </header>
            <div class="contentStep1">
                <h3 class="frame-titleStep2">Choisissez une date <br>et une heure</h3>
                <div id="typeConsult">
                    <!-- Date and Time picker -->
                    <div class="form-group drill">
                        <!-- Date -->
                        <div class="text-center selectType"><strong>Date</strong></div>
                        <div class="input-group dateDr" id="datetimepicker4" data-target-input="nearest">
                            <input type="text" name="date" class="form-control col-xs-12 datetimepicker-input"
                                data-target="#datetimepicker4" required />
                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <!-- Hour -->
                        <div class="text-center selectType"><strong>Heure</strong></div>
                        <div class="input-group dateDr" id="datetimepicker3" data-target-input="nearest">
                            <input type="text" name="hour" class="form-control col-xs-12 datetimepicker-input"
                                data-target="#datetimepicker3" />
                            <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container" id="prev_nextBtn">
                    <div id="prev_nextButtons" class="text-center">
                        <a href="fr/prendre-un-rendez-vous" class="btnMultiStepForm">Retour</a>
                        <input type="submit" class="btnMultiStepForm" value="Suivant">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Datetime picker used on views rdvPatientStep2 -->
<script type="text/javascript">
    $(function() {
        $('#datetimepicker4').datetimepicker({
            // Saturday and Sunday disabled
            daysOfWeekDisabled: [0, 6],
            minDate: new Date(),
            format: 'L',
            locale: 'fr'
        });
        $('#datetimepicker3').datetimepicker({
            format: 'LT',
            locale: 'fr',
            stepping: 15,
            enabledHours: [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19]
        });
    });
</script>

<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php');
