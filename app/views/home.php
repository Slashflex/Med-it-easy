<?php $title = 'Med It Easy | Accueil'; ?>

<?php ob_start(); ?>
<!-- Block "Notre concept" -->
<section id="JQueryAnchor1" class="container-fluid concept_height">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h1-mb">Le secrétariat médical <br><span id="spin"></span></h1>
                <!-- <div id="bg_word_swap">
                    <p class="h1" id="word_swap">réinventé</p>
                </div> -->
                <p>Moderniser la gestion des interactions avec vos patients, c’est notre mission. La relation de
                    confiance que vous avez construite avec eux doit être préservée, et conservé au niveau de votre
                    cabinet.</p>
                <ul class="container thumbnails row">
                    <li class="col-6 col-sm-3 col-lg-3">
                        <a href="#">
                            <div class="blockDesc"><img src="app\public\images\consultation.png" alt=""></div>
                        </a>
                    </li>
                    <li class="col-6 col-sm-3 col-lg-3">
                        <a href="#">
                            <div class="blockDesc"><img class="mx-auto" src="app\public\images\suiviPsy.png" alt=""></div>
                        </a>
                    </li>
                    <li class="col-6 col-sm-3 col-lg-3">
                        <a href="#">
                            <div class="blockDesc"><img src="app\public\images\consultation.png" alt=""></div>
                        </a>
                    </li>
                    <li class="col-6 col-sm-3 col-lg-3">
                        <a href="#">
                            <div class="blockDesc"><img src="app\public\images\consultation.png" alt=""></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <img id="placeholder" class="imgSpin img-fluid" src="app\public\images\placeholder.png" alt="placeholder image">
            </div>
        </div>
    </div>
</section>

<div class="parallax1 img-fluid"></div>

<!-- Block "Notre solution" -->
<section id="JQueryAnchor2" class="container-fluid solution_height">
    section 2
</section>

<div class="parallax3 img-fluid"></div>

<!-- Block "Tarifs" -->
<section id="JQueryAnchor3" class="container-fluid pricing_height">
    section 3
</section>

<?php $content = ob_get_clean(); ?>

<?php require('app\views\template.php');
