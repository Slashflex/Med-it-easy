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
                    require('app\view\registerPatient.php');
                }
                elseif ($_GET['action'] == 'registerPatient') {
                    // TO DO
                    $patientPrenom = htmlspecialchars($_POST['patientPrenom']);
                    $patientNom = htmlspecialchars($_POST['patientNom']);
                    $patientDate = htmlspecialchars($_POST['patientDate']);
                    $email = htmlspecialchars($_POST['email']);
                    $password_1 = htmlspecialchars($_POST['password_1']);
                    $password_2 = htmlspecialchars($_POST['password_2']);
                    $this->controller->formPatient($patientPrenom, $patientNom, $patientDate, $email, $password_1, $password_2);
                } 
                elseif ($_GET['action'] == 'connexionPatient') {
                    require('app\view\connexionPatient.php');
                } 
                // Displaying the ConnectedPatient.php View Once the Patient Connected
                elseif ($_GET['action'] == 'connectedPatient') {
                    // Calling the passVerify function from the controller
                    $this->controller->passVerify($_POST['password_1'], $_POST['email']);
                } 
                // Deleting the patient in the DB and on the site (via his profile page)
                elseif ($_GET['action'] == 'deletePatient') {
                    
                    if(isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                        $suppressId = $_SESSION['id'];
                        echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . '</pre>';
                        require('app\view\confirmDeletePatient.php');
                    }
                }
                // Confirmation request to the patient to delete his account or cancel the action
                elseif ($_GET['action'] == 'confirmSuppression') 
                { 
                    if (isset($_SESSION['id']) && $_SESSION['id'] > 0) 
                    {  
                        $deleteid = $_SESSION['id'];
                        $this->controller->delPatient($deleteid);
                        session_unset();
                        session_destroy();
                        header('Location: index.php');
                    }
                    else 
                    {
                        throw new Exception('Echec de la suppression de votre compte');
                    }
                }
                // Action of button "cancelSuppression" from view (confirmDeletePatient.php)...
                // ...allows the return to the profile page in case of cancellation
                elseif ($_GET['action'] == 'cancelSuppression') {
                    require('app\view\connectedPatient.php');
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
                    }
                    else {
                        throw new Exception ('Erreur');
                    }
                }
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
                    require('app\view\registerPraticien.php');
                }
                elseif ($_GET['action'] == 'registerPraticien') {
                    // TO DO
                    $praticienPrenom = htmlspecialchars($_POST['praticienPrenom']);
                    $praticienNom = htmlspecialchars($_POST['praticienNom']);
                    $praticienDate = htmlspecialchars($_POST['praticienDate']);
                    $praticienEmail = htmlspecialchars($_POST['praticienEmail']);
                    $password_1 = htmlspecialchars($_POST['password_1']);
                    $password_2 = htmlspecialchars($_POST['password_2']);
                    $specialite = htmlspecialchars($_POST['specialite']);
                    $this->controller->formPraticien($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $password_1, $password_2, $specialite);
                } 
                elseif ($_GET['action'] == 'connexionPraticien') {
                    require('app\view\connexionPraticien.php');
                } 
                // Displaying the ConnectedPraticien.php View Once the Doctor Connected
                elseif ($_GET['action'] == 'connectedPraticien') {
                    // Calling the passVerify function from the controller
                    $this->controller->passVerif($_POST['password_1'], $_POST['praticienEmail']);
                } 
                // Delete doctor into DataBase (via his profil page (connectedPraticien.php))
                elseif ($_GET['action'] == 'deletePraticien') {
                    
                    if(isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                        $suppressId = $_SESSION['id'];
                        echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['praticienPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . '</pre>';
                        require('app\view\confirmDeletePraticien.php');
                    }
                }
                // Ask for confirmation to doctor if he's sure to delete his account or cancel action
                elseif ($_GET['action'] == 'confirmSuppressionPraticien') 
                { 
                    if (isset($_SESSION['id']) && $_SESSION['id'] > 0) 
                    {  
                        $deleteid = $_SESSION['id'];
                        $this->controller->delPraticien($deleteid);
                        session_unset();
                        session_destroy();
                        header('Location: index.php');
                    }
                    else 
                    {
                        throw new Exception('Echec de la suppression de votre compte');
                    }
                }
                // Action of button "cancelSuppressionPraticien" from view (confirmDeletePraticien.php)...
                // ...allows the return to the profile page in case of cancellation
                elseif ($_GET['action'] == 'cancelSuppressionPraticien') {
                    require('app\view\connectedPatient.php');
                }
                // Agenda.php view loaded on click
                elseif ($_GET['action'] == 'agendaAdmin') {
                    require('app\view\agendaAdmin.php');
                }
                
                /*=========== End of Section Doctor =========*/


                /*=============== Section Agenda ============*/
                


                /*========== End of Section Agenda ==========*/
                elseif ($_GET['action'] == 'mentionsLegales') {
                    require('app\view\mentionsLegales.php');
                }
            } 
            else {
                require('app\view\home.php');
            }
        } 
        catch (Exception $e) {
            $errors = $e->getMessage();
            require('app\view\errors.php');
        }
    }
}