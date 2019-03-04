<?php
namespace Projet;

use \Projet\app\controller\Controller;
use \Exception;

class App
{
    private $controller;

    public function __construct()
    {
        $this->controller = new Controller();
    }
    public function run()
    {
        try {
            if (isset($_GET['action'])) {
                
                /*=============================================
                =            Section Patient                  =
                =============================================*/
                if ($_GET['action'] == 'addPatient') {
                    // TO DO...
                    $this->controller->methodPatient();
                //require('app\view\registerPatient.php');
                } elseif ($_GET['action'] == 'registerPatient') {
                    // TO DO
                    $patientPrenom = htmlspecialchars($_POST['patientPrenom']);
                    $patientNom = htmlspecialchars($_POST['patientNom']);
                    $patientDate = htmlspecialchars($_POST['patientDate']);
                    $email = htmlspecialchars($_POST['email']);
                    $password_1 = htmlspecialchars($_POST['password_1']);
                    $password_2 = htmlspecialchars($_POST['password_2']);
                    $id_praticien = htmlspecialchars($_POST['id_praticien']);
                    $this->controller->formPatient($patientPrenom, $patientNom, $patientDate, $email, $password_1, $password_2, $id_praticien);
                } elseif ($_GET['action'] == 'connexionPatient') {
                    require('app\view\connexionPatient.php');
                }
                // Displaying the ConnectedPatient.php View Once the Patient Connected
                elseif ($_GET['action'] == 'connectedPatient') {
                    // Calling the passVerify function from the controller
                    $this->controller->passVerify($_POST['password_1'], $_POST['email']);
                }
                // Deleting the patient in the DB and on the site (via his profile page)
                elseif ($_GET['action'] == 'deletePatient') {
                    if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                        $suppressId = $_SESSION['id'];
                        echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . '</pre>';
                        require('app\view\confirmDeletePatient.php');
                    }
                }
                // Confirmation request to the patient to delete his account or cancel the action
                elseif ($_GET['action'] == 'confirmSuppression') {
                    if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                        $deleteid = $_SESSION['id'];
                        $this->controller->delPatient($deleteid);
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
                    require('app\view\connectedPatient.php');
                } elseif ($_GET['action'] == 'backToConnectedPatient') {
                    require('app\view\connectedPatient.php');
                } elseif ($_GET['action'] == 'rdvPatient') {
                    $this->controller->rdvStep1();
                } elseif ($_GET['action'] == 'testJson2') {
                    $date = $_POST['date'];
                    $hour = $_POST['hour'];
                    $test = $this->controller->testJson2($date, $hour);
                    require('app\view\rdvPatientStep3.php');
                    
                // require('app\view\decodeJson.php');
                } elseif ($_GET['action'] == 'testJson') {
                    $consult = $_POST['test'];
                    $prat = $_POST['id_praticien'];

                    $test = $this->controller->testJson($consult, $prat);
                    require('app\view\rdvPatientStep2.php');
                } 
                elseif ($_GET['action'] == 'rdvStep1ToStep2') 
                {
                    require('app\view\rdvPatientStep2.php');
                }
                elseif ($_GET['action'] == 'rdvStep2ToStep3') 
                {
                    require('app\view\rdvPatientStep3.php');
                }
                elseif ($_GET['action'] == 'testEvent') {
                    $json = fopen('app\public\json\testJson.json', 'r');
                    $jsonRead = fread($json, 2000);
                    $decode = json_decode($jsonRead);
                    $json2 = fopen('app\public\json\testJson2.json', 'r');
                    $jsonRead2 = fread($json2, 2000);
                    $decode2 = json_decode($jsonRead2);
                    $this->controller->testAddEvent($decode['0'], $decode2['0'], $decode2['1'], $_SESSION['id']);    
                }


                




                /*=========== End of Section Patient =========*/

                elseif ($_GET['action'] == 'connected') {
                    // If user with an email related to patients exist...
                    // ...redirect to his account main view (connectedPatient.php)
                    if (isset($_SESSION['patientEmail'])) {
                        require('app\view\connectedPatient.php');
                    }
                    
                    // If user with an email related to patients exist...
                    // ...redirect to his account main view (connectedPraticien.php)
                    elseif (isset($_SESSION['praticienEmail'])) {
                        require('app\view\connectedPraticien.php');
                    } else {
                        throw new Exception('Erreur');
                    }
                }
                 //elseif ($_GET['action'] == 'rdvStep1') {
                //$req = $this->controller->listTypeActes($id_type);
                //}
                /* Deconnexion */
                elseif ($_GET['action'] == 'disconnect') {
                    unset($_SESSION['id']);
                    session_destroy();
                    header('Location: index.php');
                }


                /*=============================================
                =              Section Praticien              =
                ==============================================*/
                elseif ($_GET['action'] == 'addPraticien') {
                    $this->controller->addPraticien();
                } elseif ($_GET['action'] == 'registerPraticien') {
                    // TO DO
                    $praticienPrenom = htmlspecialchars($_POST['praticienPrenom']);
                    $praticienNom = htmlspecialchars($_POST['praticienNom']);
                    $praticienDate = htmlspecialchars($_POST['praticienDate']);
                    $praticienEmail = htmlspecialchars($_POST['praticienEmail']);
                    $password_1 = htmlspecialchars($_POST['password_1']);
                    $password_2 = htmlspecialchars($_POST['password_2']);
                    $specialite = htmlspecialchars($_POST['specialite']);
                    $this->controller->formPraticien($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $password_1, $password_2, $specialite);
                } elseif ($_GET['action'] == 'connexionPraticien') {
                    require('app\view\connexionPraticien.php');
                }
                // Displaying the ConnectedPraticien.php View Once the Doctor Connected
                elseif ($_GET['action'] == 'connectedPraticien') {
                    // Calling the passVerify function from the controller
                    $this->controller->passVerif($_POST['password_1'], $_POST['praticienEmail']);
                }
                // Delete doctor into DataBase (via his profil page (connectedPraticien.php))
                elseif ($_GET['action'] == 'deletePraticien') {
                    if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                        $suppressId = $_SESSION['id'];
                        echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['praticienPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . '</pre>';
                        require('app\view\confirmDeletePraticien.php');
                    }
                } 
                //elseif ($_GET['action'] == 'addEvent') {
                //     $this->controller->addEvent($id_event, $start, $id_type, $id_patient);
                // }
                
                // Ask for confirmation to doctor if he's sure to delete his account or cancel action
                elseif ($_GET['action'] == 'confirmSuppressionPraticien') {
                    if (isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                        $deleteid = $_SESSION['id'];
                        $this->controller->delPraticien($deleteid);
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
                    require('app\view\connectedPatient.php');
                }
                // On click on "Accueil" from off canva menu (connectedPraticien.php)...
                // ...returns to the main doctor's page
                elseif ($_GET['action'] == 'accueil') {
                    require('app\view\connectedPraticien.php');
                }
                // Agenda.php view loaded on click
                elseif ($_GET['action'] == 'agendaAdmin') {
                    require('app\view\agendaAdmin.php');
                }
                elseif ($_GET['action'] == 'pricings') {
                    require('app\view\tarifs.php');
                }
                elseif ($_GET['action'] == 'patientBase') {
                    $this->controller->listAllPatients($_SESSION['id']);
                }
                
                /*=========== End of Section Doctor =========*/


                /*=============== Section Agenda ============*/
                


                /*========== End of Section Agenda ==========*/
                elseif ($_GET['action'] == 'mentionsLegales') {
                    require('app\view\mentionsLegales.php');
                }
            } else {
                require('app\view\home.php');
            }
        } catch (Exception $e) {
            $errors = $e->getMessage();
            require('app\view\errors.php');
        }
    }
}
