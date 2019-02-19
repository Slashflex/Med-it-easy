<?php $title = 'Med It Easy | Accueil'; ?>

<?php ob_start(); ?>
<!-- Block "Notre concept" -->
<section id="JQueryAnchor1" class="container-fluid concept_height">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="h1-mb">Le secrétariat médical </h1><br>
                <div id="bg_word_swap">
                    <p class="h1" id="word_swap">réinventé</p>
                </div>
                <p>Conciliez le besoin d’être toujours joignable avec la nécessité de préserver le confort
                    d’exercice de votre cabinet médical.</p>
            </div>
            <div class="col-lg-6">
                <img id="placeholder" src="app\public\images\video.PNG" alt="placeholder image">
            </div>
        </div>
    </div>
</section>
<!-- Block "Notre solution" -->
<section id="JQueryAnchor2" class="container-fluid solution_height">
    section 2
</section>
<!-- Block "Tarifs" -->
<section id="JQueryAnchor3" class="container-fluid pricing_height">
    section 3
</section>



<?php $content = ob_get_clean(); ?>

<?php require('app\view\template.php');
