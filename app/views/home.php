<?php $title = 'Med It Easy | Accueil'; ?>

<?php ob_start(); ?>

<!-- MESSAGE -->
<div id="message">
    <div class="cookie_text">En poursuivant votre navigation sur le site, vous acceptez l’utilisation des cookies pour
        vous proposer des contenus et services adaptés à vos centres d’intérêt.
        <a class="cookie_link" href="fr/mentionsLegales">Plus d'infos</a>
    </div>
    <button class="buttons" onClick="hideMessage();">J'accepte</button><br />
</div>
<!-- end: MESSAGE -->



<!-- Block "Notre concept" -->
<section id="concept" class="container-fluid concept_height page_section">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <?php if (isset($_GET['infos']) && $_GET['infos'] == 'sended'): ?>
                <p style='color: green; background-color: orange' class="text-center">Email envoyé</p>
                <?php endif;?>
                <h1 class="h1-mb">Le secrétariat médical <br><span id="spin"></span></h1>
                <h5 class="text-center mx-auto col-sm-10 col-lg-12 paragraph">Nous œuvrons pour que chaque praticien
                    puisse
                    exercer<br>
                    dans des conditions propices à son épanouissement.</h5>
            </div>
        </div>
        <!-- Blocks Promo -->
        <div class="row">
            <div class="mx-auto col-xs-3 col-lg-3 cardBox">
                <p class="text-center h5-mb">Lutter contre le travail empêché</p>
                <p class="text-center paragraph">En étant bien pensée et respectueuse de vos intérêts, la technologie
                    peut vous
                    affranchir des distractions qui polluent votre quotidien.
                    Exercer une médecine de qualité n’est possible que dans un cabinet où règne la quiétude.</p>
            </div>
            <div class="mx-auto col-xs-3 col-lg-3 cardBox">
                <p class="text-center h5-mb">Renforcer le lien médecin‑patient</p>
                <p class="text-center paragraph">Moderniser la gestion des interactions avec vos patients, c’est notre
                    mission.
                    La relation de confiance que vous avez construite avec eux doit être préservée, et conservé au
                    niveau de votre cabinet.</p>
            </div>
            <div class="mx-auto col-xs-3 col-lg-3 cardBox">
                <p class="text-center h5-mb">Garantir les intérêts des praticiens</p>
                <p class="text-center paragraph">Med It Easy est plus qu’une initiative créée pour les praticiens. Nous
                    voulons
                    grandir ensemble, dans le respect des valeurs de la profession.</p>
            </div>
        </div><!-- end: Blocks Promo -->

        <div class="container">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae deleniti ipsam maxime ullam sit
            architecto laudantium modi, nulla magnam amet tempore placeat incidunt iste enim alias natus praesentium
            veritatis sequi molestiae nostrum explicabo sed itaque nam. Repellat autem corrupti sequi nam libero neque
            error nisi consequuntur, esse est praesentium consectetur, magnam optio debitis ipsam et accusamus? Ipsam
            labore maxime quisquam itaque nobis dolores ipsa sunt. Quaerat non consequuntur perferendis similique
            adipisci harum expedita beatae corporis autem, eius deserunt libero laboriosam veniam neque error iure
            placeat quam nobis minus rem atque est alias sequi odit. 
        </div>
    </div>
</section><!-- end: Block "Notre concept" -->

<div class="parallax1 img-fluid">

</div>

<!-- Block "Notre solution" -->
<section id="solution" class="container-fluid solution_height page_section">

</section><!-- end: Block "Notre solution" -->

<div class="parallax3 img-fluid">

</div>

<!-- Block "Tarifs" -->
<section id="tarification" class="container-fluid pricing_height page_section">

</section><!-- end: Block "Tarifs" -->

<?php $content = ob_get_clean(); ?>

<?php require('app/views/template.php');
