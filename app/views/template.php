<!DOCTYPE html>
<html>

<head>
    <base href="http://localhost/Test-projet-perso-MVC/" />
    <!-- <base href="http://www.mediteasy.fr/"> -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta Tags -->
    <meta name="Content-Type" content="UTF-8">
    <meta name="Content-Language" content="fr">
    <meta name="Description"
        content="Plateforme de mise en relation praticien - patient, afin de facilité la prise - gestion de rendez-vous">
    <meta name="Keywords"
        content="médecine consultation rendez-vous télé-secrétariat patient praticien médecin urgence agenda gestion patientèle santé">
    <meta name="Subject" content="Télésecrétariat médical">
    <meta name="Copyright" content="Slashflex">
    <meta name="Author" content="David Saoud">
    <meta name="Publisher" content="David Saoud">
    <meta name="Revisit-After" content="15 days">
    <meta name="Robots" content="all">
    <meta name="Rating" content="general">
    <meta name="Distribution" content="global">
    <meta name="Category" content="health">
    <title>
        <?= $title ?>
    </title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <!-- Custom CSS compiled using Ruby Sass -->
    <link rel="stylesheet" href="app/public/css/style.css">
    <!-- Font-Awesome Core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- JQuery / Moment Core -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <!-- Bootstrap Core Css / JS -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <!-- FullCalendar Plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <!-- FullCalendar localization -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/locale/fr.js"></script>
    <!-- Custom Jquery -->
    <script src="app/public/js/script.js"></script>
    <script src="app/public/js/agenda.js"></script>
    <!-- JQUERY cookie Core -->
    <script src="app/public/js/jquery.cookie.js"></script>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top " style="background-color: #353c3f;">
        <!-- Navbar brand -->
        <a id="mainLogo" class="navbar-brand" href="index.php">MED <span class="separator">IT</span> EASY </a>
        <!-- Collapse button -->
        <button class="navbar-toggler first-button" id="nav_toggler" type="button" data-toggle="collapse"
            data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false"
            aria-label="Toggle navigation">
            <div class="burgerNav"><span></span><span></span><span></span></div>
        </button>
        <!-- Collapsible content -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarToggler">
            <ul class="navbar-nav nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php#concept" id="scrollToConcept">concept</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#solution" id="scrollToSolution">solution</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#tarification" id="scollToPricing">tarifs</a>
                </li>
                <?php if (isset($_SESSION['id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="fr/mon-compte" id="scollToPricing">Mon compte</a>
                    <script>
                    // Script to add active class to 4th button (this button appears once SESSiON is created
                    $(function() {
                        $('.nav a:lt(4)').filter(function() {
                            return this.href == location.href
                        }).parent().addClass('active').siblings().removeClass('active')
                        $('.nav a:lt(4)').click(function() {
                            $(this).parent().addClass('active').siblings().removeClass('active')
                        });
                    });
                    </script>
                </li>
                <?php endif; ?>
                <li>
                    <?php if (isset($_SESSION['id'])): ?>
                    <div class="hideLogBtn">
                        <a class="nav-link btn-nav" id="connexionBtn" href="fr/deconnexion">Déconnexion</a>
                    </div>
                    <?php else: ?>
                    <div class="hideLogBtn">
                        <a class="nav-link btn-nav" id="connexionBtn" data-toggle="modal"
                            data-target="#modal_register_login" href="#">Espace utilisateurs</a>
                    </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav><!-- end: Navbar -->

    <!-- Modal brings up two blocks => Patient user space and Doctor user space,
    who will redirect to their dedicated Creation / Account Login pages -->
    <div class="modal closeModal" id="modal_register_login" tabindex="-1" role="dialog"
        aria-labelledby="modal_register_loginTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <header class="container justify-content-center">
                    <div class="row card-deck">
                        <!-- Left block offering the Patient the choice to register or log in -->
                        <div class="card text-center" id="leftCard">
                            <img src="app/public/images/patient.png" class="card-img-top"
                                alt="Lien vers l'espace de connexion du patient">
                            <div class="card-body">
                                <a href="fr/inscription-patient" class="col-md-12 btn btn-primary">Inscription
                                    patient</a>
                                <a href="fr/connexion-patient" class="col-md-12 btn btn-primary">Connexion
                                    patient</a>
                            </div>
                        </div>
                        <!-- Right block offering the Doctor the choice to register or to log in -->
                        <div class="card text-center" id="rightCard">
                            <img src="app/public/images/docteur.png" class="card-img-top"
                                alt="Lien vers l'espace de connexion du medecin">
                            <div class="card-body">
                                <a href="fr/inscription-praticien" class="col-md-12 btn btn-primary">Inscription
                                    praticien</a>
                                <a href="fr/connexion-praticien" class="col-md-12 btn btn-primary">Connexion
                                    praticien</a>
                            </div>
                        </div>
                        <div id="backBtnModal">
                            <a href="index.php" class="btnBackModal p-2"><i class="fas fa-chevron-left"></i> Fermer</a>
                        </div>
                    </div>
                </header>
            </div>
        </div>
    </div><!-- end: Modal -->


    <!-- Main Content -->
    <main id="main">
        <?= $content ?>
    </main><!-- end: Main Content -->

    <!-- Footer -->
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
                        <li><a href="https://www.tabac-info-service.fr/">Tabac
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
                <!-- Social icons -->
                <div class="row footer_height">
                    <div class="col-md-12 bloc_reseaux">
                        <div class="col-md-6 offset-md-4 col-sm-6 offset-sm-4 reseaux">
                            <a href="mailto:pro.davidsaoud@gmail.com" class="btn-footer"><img
                                    data-alt-src="app/public/images/mail.png" src="app/public/images/mail_orange.png"
                                    class="icon_color img-fluid" alt="contact par mail"></a>
                            <a href="https://www.linkedin.com/in/david-saoud-775624174/" class="btn-footer"><img
                                    data-alt-src="app/public/images/Linkedin.png"
                                    src="app/public/images/Linkedin_orange.png" class="icon_color img-fluid"
                                    alt="lien vers profil Med It Easy via Linkedin"></a>
                            <a href="https://twitter.com/saoud_david" class="btn-footer"><img
                                    data-alt-src="app/public/images/Twitter.png"
                                    src="app/public/images/Twitter_orange.png" class="icon_color img-fluid"
                                    alt="Lien vers profil Med It Easy via twitter"></a>
                        </div>
                    </div>
                </div><!-- end: Social icons -->

                <div class="col-md-12 bloc_mid">
                    <div class="text-center">
                        <p><span class="navbar-brandFooter text-center">&copy MED <span class="separator">IT</span>
                                EASY
                                2019 <a href="fr/mentionsLegales" class="space">Mentions
                                    légales</a></span></p>
                        <a href="tel:+33637888061"><span class="fas fa-phone"><span
                                    class="phone">06.37.88.80.61</span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- end: Footer -->
    <!-- Button to go back to the top of the page -->
    <a id="buttonToTop"></a>

</body>

</html>