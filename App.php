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
                    /*=============================================
                    =            Section Patient                  =
                    =============================================*/
                    if ($_GET['action'] == 'addPatient') {
                        $this->patientController->methodPatient();
                    }
                    // Register Patient
                    elseif ($_GET['action'] == 'registerPatient') {
                        
                        $this->patientController->registerPatient();
                        //
                        $this->patientController->passVerify($_POST['password_1'], $_POST['email']);
                        //
                    } elseif ($_GET['action'] == 'connexionPatient') {
                        require('app/views/patients/connexionPatient.php');
                    }
                    // Displaying the ConnectedPatient View Once the Patient is Connected
                    elseif ($_GET['action'] == 'connectedPatient') {
                        // Calling the passVerify function from the patientController
                        $this->patientController->passVerify($_POST['password_1'], $_POST['email']);
                        
                    }
                    // Deleting the Patient in the DB and on the site (via his profile page)
                    elseif ($_GET['action'] == 'deletePatient') {
                        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                            $suppressId = $_SESSION['id'];
                            echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . '</pre>';
                            require('app/views/patients/confirmDeletePatient.php');
                        }
                    }
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
                    // Action of button "cancelSuppression" from view (confirmDeletePatient.php)...
                    // ...allows the return to the profile page in case of cancellation
                    elseif ($_GET['action'] == 'cancelSuppression') {
                        require('app/views/patients/connectedPatient.php');
                    }
                    // On click returns to main Patient view
                    elseif ($_GET['action'] == 'backToConnectedPatient') {
                        require('app/views/patients/connectedPatient.php');
                    }
                    // On click, leads to booking form's first step
                    elseif ($_GET['action'] == 'rdvPatient') {
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
                    } elseif ($_GET['action'] == 'rdvStep1ToStep2') {
                        require('app/views/patients/rdvPatientStep2.php');
                    } elseif ($_GET['action'] == 'rdvStep2ToStep3') {
                        require('app/views/patients/rdvPatientStep3.php');
                    }
                    
                    // Update patient informations
                    elseif ($_GET['action'] == 'updatePatient') {
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
                    elseif ($_GET['action'] == 'listRdv') {
                        $this->patientController->listingRDV($_SESSION['id']);
                    }
                    // Form to choose a Doctor, if the patients' doctor chosen on patient registration, ...
                    //... deleted his account or doesn't want to use the website anymore
                    elseif ($_GET['action'] == 'choosePraticien') {
                        $this->patientController->updatePratOfPatient($_POST['id_praticien'], $_SESSION['id']);
                    }
                    /*=========== End of Section Patient =========*/
                    
                    /*=============================================
                    =              Section Praticien              =
                    ==============================================*/
                    // Show list of doctor's specialities (<select> on registerPraticien view)
                    elseif ($_GET['action'] == 'addPraticien') {
                        $this->praticienController->addPraticien();
                    }
                    // Register form for Doctors only
                    elseif ($_GET['action'] == 'registerPraticien') {
                        $this->praticienController->registerPraticien();
                    }
                    // Connexion form for Doctors only
                    elseif ($_GET['action'] == 'connexionPraticien') {
                        require('app/views/praticiens/connexionPraticien.php');
                    }
                    // Displaying the ConnectedPraticien.php View Once the Doctor is Connected
                    elseif ($_GET['action'] == 'connectedPraticien') {
                        // Calling the passVerify function from the controller
                        $this->praticienController->passVerif($_POST['password_1'], $_POST['praticienEmail']);
                        $this->patientController->listEventsOfPatient();
                    }
                    // On click on "Accueil" from off canva menu (connectedPraticien.php)...
                    // ...returns to the main doctor's page
                    elseif ($_GET['action'] == 'accueil') {
                        require('app/views/praticiens/connectedPraticien.php');
                    }
                    // Agenda.php (FullCalendar plugin) view loaded on click
                    elseif ($_GET['action'] == 'agendaAdmin') {
                        //$this->eventController->getPatientRdv($_SESSION['id']);
                        require('app/views/praticiens/agendaAdmin.php');
                    }
                    // Nav-link on connectedPraticien view to list pricings of actes
                    elseif ($_GET['action'] == 'pricings') {
                        require('app/views/praticiens/tarifs.php');
                    }
                    // Nav-link on connectedPraticien view to list all patients bind to this doctor
                    elseif ($_GET['action'] == 'patientBase') {
                        $this->praticienController->listAllPatients($_SESSION['id']);
                    }
                    // Delete doctor into DataBase (via his profil page (connectedPraticien.php))
                    elseif ($_GET['action'] == 'deletePraticien') {
                        if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                            $suppressId = $_SESSION['id'];
                            echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['praticienPrenom']) . ' ' . ucfirst($_SESSION['praticienNom']) . '</pre>';
                            require('app/views/praticiens/confirmDeletePraticien.php');
                        }
                    }
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
                    // Action of button "cancelSuppressionPraticien" from view (confirmDeletePraticien.php)...
                    // ...allows the return to the profile page in case of cancellation
                    elseif ($_GET['action'] == 'cancelSuppressionPraticien') {
                        require('app/views/praticiens/connectedPraticien.php');
                    }
                    /*=========== End of Section Praticien =========*/


                    /*=============== Section Events ============*/

                    //elseif ($_GET['action'] == 'addEvent') {
                    //     $this->controller->addEvent($id_event, $start, $id_type, $id_patient);
                    // }
                    // Displaying events
                    elseif ($_GET['action'] == 'displayEvents') {
                        $this->eventController->getPatientRdv($_SESSION['id']);
                    }
                    /*========== End of Section Events ==========*/
                    elseif ($_GET['action'] == 'testEvent') {
                        $json = fopen('app/public/json/testJson.json', 'r');
                        $jsonRead = fread($json, 2000);
                        $decode = json_decode($jsonRead);
                        $json2 = fopen('app/public/json/testJson2.json', 'r');
                        $jsonRead2 = fread($json2, 2000);
                        $decode2 = json_decode($jsonRead2);
                        $this->patientController->testAddEvent($decode['0'], $decode2['0'], $decode2['1'], $_SESSION['id']);
                    } 
                    elseif ($_GET['action'] == 'connected') {
                        // If user with an email related to patients exist...
                        // ...redirect to his account main view (connectedPatient.php)
                        if (isset($_SESSION['patientEmail'])) {
                            require('app/views/patients/connectedPatient.php');
                        }
                    
                        // If user with an email related to patients exist...
                        // ...redirect to his account main view (connectedPraticien.php)
                        elseif (isset($_SESSION['praticienEmail'])) {
                            require('app/views/praticiens/connectedPraticien.php');
                        } else {
                            throw new Exception('Erreur');
                        }
                    }    
                        
                    
                    // Deconnexion for both Patient and Doctor
                    elseif ($_GET['action'] == 'disconnect') {
                        unset($_SESSION['id']);
                        session_destroy();
                        header('Location: index.php');
                    }
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