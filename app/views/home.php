<?php $title = 'Med It Easy | Accueil'; ?>

<?php ob_start(); ?>
<!-- Block "Notre concept" -->
<section id="JQueryAnchor1" class="container-fluid concept_height page_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="h1-mb">Le secrétariat médical <br><span id="spin"></span></h1>
                <p class="h5 text-center mx-auto col-sm-4 col-lg-12">Nous œuvrons pour que chaque praticien puisse
                    exercer<br>
                    dans des conditions propices à son épanouissement.</p>
            </div>
        </div>
        <hr>
        <!-- TESTS -->
        <div class="row" id="blockCards">
            <div class="mx-auto col-xs-3 col-lg-3 cardBox">
                <p class="text-center h5-mb">Lutter contre le travail empêché</p>
                <p class="text-center">En étant bien pensée et respectueuse de vos intérêts, la technologie peut vous
                    affranchir des distractions qui polluent votre quotidien.
                    Exercer une médecine de qualité n’est possible que dans un cabinet où règne la quiétude.</p>
            </div>
            <div class="mx-auto col-xs-3 col-lg-3 cardBox">
                <p class="text-center h5-mb">Renforcer le lien médecin‑patient</p>
                <p class="text-center">Moderniser la gestion des interactions avec vos patients, c’est notre mission.
                    La relation de confiance que vous avez construite avec eux doit être préservée, et conservé au
                    niveau de votre cabinet.</p>
            </div>
            <div class="mx-auto col-xs-3 col-lg-3 cardBox">
                <p class="text-center h5-mb">Garantir les intérêts des praticiens</p>
                <p class="text-center">MedItEasy est plus qu’une initiative créée pour les praticiens. Nous voulons
                    grandir ensemble, dans le respect des valeurs de la profession.</p>
            </div>
        </div>
    </div>
</section>

<div class="parallax1 img-fluid">
    <div class="row" id="placeholder">
        <img src="app\public\images\placeholder.png" id="placeholder" alt="">
    </div>
</div>

<!-- Block "Notre solution" -->
<section id="JQueryAnchor2" class="container-fluid solution_height page_section">
    section 2
</section>

<div class="parallax3 img-fluid">
    
</div>

<!-- Block "Tarifs" -->
<section id="JQueryAnchor3" class="container-fluid pricing_height page_section">
    section 3
</section>

<?php $content = ob_get_clean(); ?>

<?php require('app\views\template.php');
