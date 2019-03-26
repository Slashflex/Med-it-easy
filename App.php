<?php
// --- CLASS LOADING
    namespace Projet;

    use \Projet\app\controller\EventController;
    use \Projet\app\controller\PatientController;
    use \Projet\app\controller\PraticienController;
    use \Exception;

// --- CLASS MANAGING ACTIONS
    class App
    {
        private $eventController;
        private $patientController;
        private $praticienController;

        public function __construct()
        {
            $this->eventController = new EventController();
            $this->patientController = new PatientController();
            $this->praticienController = new PraticienController();
        }
// --- MAIN ROUTER
        public function run()
        {
            try {
                if (isset($_GET['action'])) {
// --- PATIENT's SECTION                
        // --- SIGN UP FORM                    
                    if ($_GET['action'] == 'inscription-patient') {
                        $this->patientController->methodPatient();
                    }
        // --- CONNEXION FORM
                    elseif ($_GET['action'] == 'connexion-patient') {
                        require('app/views/patients/connexionPatient.php');
                    }
        // --- REGISTER PATIENT
                    elseif ($_GET['action'] == 'inscription_patient') {
                        $this->patientController->registerPatient();
                    } 
        // --- PASSWORD VERIFY
                    // Displaying the ConnectedPatient View Once the Patient is Connected
                    elseif ($_GET['action'] == 'espace-patient') {
                        // Calling the passVerify function from the patientController
                        $this->patientController->passVerify($_POST['password_1'], $_POST['email']);
                    }
        // --- DELETE PATIENT
                    // Deleting the Patient in the DB and on the site (via his profile page)
                    elseif ($_GET['action'] == 'supprimer-votre-compte') {
                        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                            $suppressId = $_SESSION['id'];
                            echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . '</pre>';
                            require('app/views/patients/confirmDeletePatient.php');
                        }
                    }
        // --- DELETE PATIENT CONFIRMATION
                    // Confirmation request to the patient to delete his account or cancel the action
                    elseif ($_GET['action'] == 'confirmSuppression') {
                        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                            $this->patientController->delPatient($_SESSION['id']);
                            session_unset();
                            session_destroy();
                            header('Location: index.php');
                        } else {
                            throw new Exception('Echec de la suppression de votre compte');
                        }
                    }
        // --- CANCEL SUPPRESSION
                    // Action of button "cancelSuppression" from view (confirmDeletePatient.php)...
                    // ...allows the return to the profile page in case of cancellation
                    elseif ($_GET['action'] == 'annuler-suppresion') {
                        require('app/views/patients/connectedPatient.php');
                    }
        // --- LEADS BACK TO MAIN VIEW (back button form MultiStep FORM step 1, 2 and 3)
                    // On click returns to main Patient view
                    elseif ($_GET['action'] == 'retour-sur-votre-profil') {
                        require('app/views/patients/connectedPatient.php');
                    }
                    // On click, leads to booking form's first step
                    elseif ($_GET['action'] == 'prendre-un-rendez-vous') {
                        $this->patientController->rdvStep1();
                    }
                    // Write datas from rdvPatientStep1 view into a JSON file (app\public\json\testJson.json)
                    elseif ($_GET['action'] == 'testJson') {
                        $test = $this->patientController->testJson();
                        require('app/views/patients/rdvPatientStep2.php');
                    }
                    // Write datas from rdvPatientStep2 view into a JSON file (app\public\json\testJson2.json)
                    elseif ($_GET['action'] == 'testJson2') {
                        $test = $this->patientController->testJson2();
                        require('app/views/patients/rdvPatientStep3.php');
                    } elseif ($_GET['action'] == 'etape-2') {
                        require('app/views/patients/rdvPatientStep2.php');
                    } elseif ($_GET['action'] == 'etape-3') {
                        require('app/views/patients/rdvPatientStep3.php');
                    }
        // --- UPATE PATIENT (mail & password)
                    // Update patient informations
                    elseif ($_GET['action'] == 'mise-a-jour-de-votre-compte') {
                        // IF empty fields, returns an error...
                        if (isset($_POST['updateInfos']) && empty($_POST['email'])) {
                            throw new Exception('vous devez remplir tout les champs');
                        } elseif (isset($_POST['updateInfos']) && empty($_POST['password_1'])) {
                            throw new Exception('vous devez remplir tout les champs');
                        } 
                        //...else, update worked
                        else {
                            $this->patientController->updatePatientInfos();
                            unset($_SESSION['id']);
                            session_destroy();
                            require('app/views/patients/connexionPatient.php');
                            echo('<p class="displayChanges text-center mx-auto">Vos changements ont bien été pris en compte, veuillez vous reconnecter' . ' ' . $_POST['email'] . ' ' . $_POST['password_1'].'</p>');
                        }
                    }
        // --- LIST OF BOOKED EVENTS 
                    elseif ($_GET['action'] == 'liste-de-vos-rdv') {
                        $this->patientController->listingRDV($_SESSION['id']);
                    }
        // --- CHOOSE NEW DOCTOR FORM
                    // Form to choose a Doctor, if the patients' doctor chosen on patient registration, ...
                    //... deleted his account or doesn't want to use the website anymore
                    elseif ($_GET['action'] == 'choix-praticien') {
                        $this->patientController->updatePratOfPatient($_POST['id_praticien'], $_SESSION['id']);
                    }
// --- end: PATIENT's SECTION      


            
// --- DOCTOR's SECTION
        // --- DISPLAY A LIST OF SPECIALITIES TO CHOOSE FROM
                    // Show list of doctor's specialities (<select> on registerPraticien view)
                    elseif ($_GET['action'] == 'inscription-praticien') {
                        $this->praticienController->addPraticien();
                    }
        // --- SIGN UP FORM
                    // Register form for Doctors only
                    elseif ($_GET['action'] == 'inscription_praticen') {
                        $this->praticienController->registerPraticien();
                    }
        // --- CONNEXION FORM
                    // Connexion form for Doctors only
                    elseif ($_GET['action'] == 'connexion-praticien') {
                        require('app/views/praticiens/connexionPraticien.php');
                    }
        // --- PASSWORD VERIFY + LIST OF PATIENT's EVENTS
                    // Displaying the ConnectedPraticien.php View Once the Doctor is Connected
                    elseif ($_GET['action'] == 'espace-pro') {
                        // Calling the passVerify function from the controller
                        $this->praticienController->passVerif($_POST['password_1'], $_POST['praticienEmail']);
                        $this->patientController->listEventsOfPatient();
                    }
        // --- MAIN DISPLAY (once connected)
                    // On click on "Accueil" from off canva menu (connectedPraticien.php)...
                    // ...returns to the main doctor's page
                    elseif ($_GET['action'] == 'accueil') {
                        require('app/views/praticiens/connectedPraticien.php');
                    }
        // --- DISPLAY OF CALENDAR
                    // Agenda.php (FullCalendar plugin) view loaded on click
                    elseif ($_GET['action'] == 'agenda') {
                        //$this->eventController->getPatientRdv($_SESSION['id']);
                        require('app/views/praticiens/agendaAdmin.php');
                    }
        // --- DISPLAY OF PRICINGS
                    // Nav-link on connectedPraticien view to list pricings of actes
                    elseif ($_GET['action'] == 'tarifs') {
                        require('app/views/praticiens/tarifs.php');
                    }
        // --- DISPLAY OF PATIENTS LIST
                    // Nav-link on connectedPraticien view to list all patients bind to this doctor
                    elseif ($_GET['action'] == 'patientele') {
                        $this->praticienController->listAllPatients($_SESSION['id']);
                    }
        // --- DISPLAY OF SCHEDULE
                    elseif ($_GET['action'] == 'horaires') {
                        require('app/views/praticiens/horaires.php');
                    }
        // --- DELETE DOCTOR
                    // Delete doctor into DataBase (via his profil page (connectedPraticien.php))
                    elseif ($_GET['action'] == 'suppression-du-compte') {
                        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                            $suppressId = $_SESSION['id'];
                            echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['praticienPrenom']) . ' ' . ucfirst($_SESSION['praticienNom']) . '</pre>';
                            require('app/views/praticiens/confirmDeletePraticien.php');
                        }
                    }
        // --- DELETE DOCTOR CONFIRMATION
                    // Delete doctor into DataBase (via his profil page (connectedPraticien.php))
                    elseif ($_GET['action'] == 'confirmSuppressionPraticien') {
                        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                            $this->praticienController->delPraticien($_SESSION['id']);
                            session_unset();
                            session_destroy();
                            header('Location: index.php');
                        } else {
                            throw new Exception('Echec de la suppression de votre compte');
                        }
                    }
        // --- CANCEL SUPPRESSION
                    // Action of button "cancelSuppressionPraticien" from view (confirmDeletePraticien.php)...
                    // ...allows the return to the profile page in case of cancellation
                    elseif ($_GET['action'] == 'cancelSuppressionPraticien') {
                        require('app/views/praticiens/connectedPraticien.php');
                    }
// --- end: DOCTOR's SECTION                   
                  
                    /*=============== Section Events ============*/

                    // Displaying events
                    elseif ($_GET['action'] == 'displayEvents') {
                        $this->eventController->getPatientRdv($_SESSION['id']);
                    }


                    ////
                    elseif ($_GET['action'] == 'test') {
                        $id = $_GET['id'];
                        $this->eventController->getPatientIdEvent($id);
                    }
                    ////

                    elseif ($_GET['action'] == 'validation') {
                        $json = fopen('app/public/json/testJson.json', 'r');
                        $jsonRead = fread($json, 2000);
                        $decode = json_decode($jsonRead);
                        $json2 = fopen('app/public/json/testJson2.json', 'r');
                        $jsonRead2 = fread($json2, 2000);
                        $decode2 = json_decode($jsonRead2);
                        $this->patientController->testAddEvent($decode['0'], $decode2['0'], $decode2['1'], $_SESSION['id']);
                    } 
                    /*========== End of Section Events ==========*/
                    
        // --- EMAIL CHECK
                    elseif ($_GET['action'] == 'mon-compte') {
                        // If user with an email related to patients exist...
                        // ...redirect to his account main view (connectedPatient.php)
                        if (isset($_SESSION['patientEmail'])) {
                            require('app/views/patients/connectedPatient.php');
                        }
        // --- EMAIL CHECK            
                        // If user with an email related to patients exist...
                        // ...redirect to his account main view (connectedPraticien.php)
                        elseif (isset($_SESSION['praticienEmail'])) {
                            require('app/views/praticiens/connectedPraticien.php');
                        } else {
                            throw new Exception('Erreur');
                        }
                    }
        // --- DISCONNECT                 
                    // Deconnexion for both Patient and Doctor
                    elseif ($_GET['action'] == 'deconnexion') {
                        unset($_SESSION['id']);
                        session_destroy();
                        header('Location: ../index.php');
                    }
        // --- DISPLAY
                    // Legal notices display
                    elseif ($_GET['action'] == 'mentionsLegales') {
                        require('app/views/mentionsLegales.php');
                    }
                } else {
                    require('app/views/home.php');
                }   
            } catch (Exception $e) {
                $errors = $e->getMessage();
                require('app/views/errors.php');
            }
        }
}
