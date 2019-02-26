<?php $title = 'Med It Easy | Réservation consultation - étape 2/4'; ?>

<?php ob_start(); ?>

<div class="container">
    <header id="headerRdv">
        <div class="head">
            <a class="navbar-brand" href="index.php">MED <span class="separator">IT</span> EASY</a>
            <div id="steps">
                <div class="book-step">
                    <div class="tooltipPop">
                        <a href="index.php?action=rdvPatient" data-toggle="tooltip" data-placement="bottom" title="Etape 1/3 : choix type de consultation et praticien"><strong
                                id="step1">1</strong></a>
                    </div>

                </div>
                <div class="book-step active-step">
                    <div class="tooltipPop">
                        <a href="" data-toggle="tooltip" data-placement="bottom" title="Etape 2/3 : date et heure souhaitée"><strong
                                id="step2">2</strong></a>
                    </div>

                </div>
                <div class="book-step">
                <a href="index.php?action=rdvStep2ToStep3" data-toggle="tooltip" data-placement="bottom" title="Etape 3/3 : confirmation des informations"><strong
                                id="step3">3</strong></a>
                </div>
            </div>
        </div>
    </header>
    <div id="contentStep1">
        <h3 class="frame-title">Choisissez une date et une heure</h3>
        <div id="typeConsult">
            <!-- Appointment's choice -->
            <div class="form-group">
                
                </select>
                <!-- Doctor's choice -->
                <div class="container">
                    <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker3" />
                                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Datetime picker used on view rdvPatientStep2 -->
                        <script type="text/javascript">
                            $(function() {
                                $('#datetimepicker4').datetimepicker({
                                    format: 'L',
                                    locale: 'fr'
                                });
                                $('#datetimepicker3').datetimepicker({
                                    format: 'LT',
                                    locale: 'fr'
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>

        </div><div class="container" id="prev_nextBtn">
        <div id="prev_nextButtons" class="text-center">
            <a href="index.php?action=rdvPatient" class="btn-update">Retour</a>
            <a href="index.php?action=rdvStep2ToStep3" class="btn-update">Suivant</a>
        </div>
    </div>
    </div>
    
</div>









<?php $content = ob_get_clean(); ?>

<?php require('app\view\template.php');
