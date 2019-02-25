<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?= $title ?>
    </title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <!-- Custom CSS compiled using Ruby Sass -->
    <link rel="stylesheet" href="app\public\css\style.css">
    <!-- Font-Awesome Core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <!-- FullCalendar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="app\public\js\agenda.js"></script>
    <!-- FullCalendar localization -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/locale/fr.js"></script>
    <!-- Custom Jquery -->
    <script src="app\public\js\script.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top " style="background-color: #353c3f;">
        <a class="navbar-brand" href="index.php">MED <span class="separator">IT</span> EASY</a>
        <button class="navbar-toggler" id="nav_toggler" type="button" data-toggle="collapse"
            data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class=""><i class="fa fa-navicon"></i></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarToggler">
            <ul class="navbar-nav nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php#JQueryAnchor1" id="scrollToConcept">notre concept</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#JQueryAnchor2" id="scrollToSolution">notre solution</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#JQueryAnchor3" id="scollToPricing">tarifs</a>
                </li>
                <?php if (isset($_SESSION['id'])) {
    ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=connected" id="scollToPricing">Mon compte</a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <?php if (isset($_SESSION['id'])) {
    ?>
        <div class="float-right hideLogBtn">
            <a class="nav-link btn-footer" id="connexionBtn" href="index.php?action=disconnect">Déconnexion</a>
        </div>
        <?php
} else {
        ?>
        <div class="float-right hideLogBtn">
            <a class="nav-link btn-footer" id="connexionBtn" data-toggle="modal" data-target="#exampleModalCenter"
                href="#">Espace
                utilisateurs</a>
        </div>
        <?php
    }?>

    </nav>

    <!-- Modal brings up two blocks => Patient user space and Doctor user space,
    who will redirect to their dedicated Creation / Account Login pages -->
    <div class="modal closeModal" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <header class="container justify-content-center">
                    <div class="row card-deck">
                        <!-- Left block offering the user the choice to register or log in -->
                        <div class="card text-center" id="leftCard">
                            <img src="app\public\images\patient.png" class="card-img-top"
                                alt="Lien vers l'espace de connexion du patient">
                            <div class="card-body">
                                <a href="index.php?action=addPatient" class="col-md-12 btn btn-primary">Inscription
                                    patient</a>
                                <a href="index.php?action=connexionPatient" class="col-md-12 btn btn-primary">Connexion
                                    patient</a>
                            </div>
                        </div>
                        <!-- Right block offering the user the choice to register or to log in -->
                        <div class="card text-center" id="RightCard">
                            <img src="app\public\images\docteur.png" class="card-img-top"
                                alt="Lien vers l'espace de connexion du medecin">
                            <div class="card-body">
                                <a href="index.php?action=addPraticien" class="col-md-12 btn btn-primary">Inscription
                                    praticien</a>
                                <a href="index.php?action=connexionPraticien"
                                    class="col-md-12 btn btn-primary">Connexion
                                    praticien</a>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
    </div><!-- /.Modal -->
    <main id="main">
        <?= $content ?>
    </main>
    <footer class="container-fluid py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4 bloc_gauche">
                    <div class="text-center">
                        <a class="navbar-brand" href="index.php">MED <span class="separator">IT</span> EASY</a>
                    </div>
                    <div class="logo-part text-center">
                        <p>15A, rue de la voûte<br> 56100 LORIENT</p>
                    </div>
                </div>

                <div class="col-4 liens_utiles borderLeft">
                    <ul>
                        <li><a href="https://www.ameli.fr/">Assurance Maladie</a></li>
                        <li><a
                                href="https://www.tabac-info-service.fr/?gclid=EAIaIQobChMInNTWrcKg2QIVzr3tCh1LyQXmEAAYASAAEgI4PvD_BwE#xtor=SEC-12-GOO-[Marque%20Pure]--S-[tabac%20info%20service]">Tabac
                                Info Services</a></li>
                        <li><a href="http://invs.santepubliquefrance.fr/">Santé publique France</a></li>
                        <li><a href="https://www.diplomatie.gouv.fr/fr/conseils-aux-voyageurs/">Conseil
                                aux voyageurs</a></li>
                    </ul>
                </div>
                <div class="col-4 liens_utiles border-left">
                    <ul>
                        <li><a href="https://www.pasteur.fr/fr/centre-medical/preparer-son-voyage">Préparer son
                                voyage</a>
                        </li>
                        <li><a href="https://lecrat.fr/sommaireFR.php">Centre de Référence</a>
                        </li>
                        <li><a href="http://www.infofemmes.com/v2/accueil.html">Infos femmes</a></li>
                        <li><a
                                href="http://stop-violences-femmes.gouv.fr/Les-associations-de-soutien-aux.html">Associations</a>
                        </li>
                    </ul>
                </div>

                <div id="hr"></div>

                <div class="row footer_height">
                    <div class="col-md-12 bloc_reseaux">
                        <div class="col-md-6 offset-md-4 col-sm-6 offset-sm-4 reseaux">
                            <a href="#" class="btn-footer"><img data-alt-src="app\public\images\mail.png"
                                    src="app\public\images\mail_orange.png" class="icon_color img-fluid"
                                    alt="contact par mail"></a>
                            <a href="#" class="btn-footer"><img data-alt-src="app\public\images\Linkedin.png"
                                    src="app\public\images\Linkedin_orange.png" class="icon_color img-fluid"
                                    alt="lien vers profil Med It Easy via Linkedin"></a>
                            <a href="#" class="btn-footer"><img data-alt-src="app\public\images\Twitter.png"
                                    src="app\public\images\Twitter_orange.png" class="icon_color img-fluid"
                                    alt="Lien vers profil Med It Easy via twitter"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 bloc_mid">
                    <div class="text-center">
                        <p><span class="navbar-brandFooter text-center">&copy MED <span class="separator">IT</span>
                                EASY
                                2019 <a href="index.php?action=mentionsLegales" class="space">Mentions
                                    légales</a></span></p>
                        <a href="tel:+33637888061"><span class="fas fa-phone"><span
                                    class="phone">06.37.88.80.61</span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- /.Footer -->
    <!-- Button to go back to the top of the page -->
    <a id="buttonToTop"></a>
</body>

</html>