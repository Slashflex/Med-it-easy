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
                // Affichage de la view ConnectedPatient.php une fois le patient connecté
                elseif ($_GET['action'] == 'connectedPatient') {
                    // Appel de la fonction passVerify depuis le controller
                    $this->controller->passVerify($_POST['password_1'], $_POST['email']);
                } 
                // Suppression du patient dans la BDD et sur le site (via sa page de profil)
                elseif ($_GET['action'] == 'deletePatient') {
                    
                    if(isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                        $suppressId = $_SESSION['id'];
                        echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['patientPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . '</pre>';
                        require('app\view\confirmDeletePatient.php');
                    }
                }
                // Demande de confirmation au patient afin de supprimer son compte ou annuler l'action
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
                // Action du bouton "cancelSuppression" de la vue confirmDelete.php...
                // ...permet le retour à la page du profil en cas d'annulation
                elseif ($_GET['action'] == 'cancelSuppression') {
                    require('app\view\connectedPatient.php');
                }
                /*=========== End of Section Patient =========*/




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
                // Affichage de la vue ConnectedPraticien.php une fois le praticien connecté
                elseif ($_GET['action'] == 'connectedPraticien') {
                    // Appel de la fonction passVerif depuis le controller
                    $this->controller->passVerif($_POST['password_1'], $_POST['praticienEmail']);
                } 
                // Suppression du praticien dans la BDD et sur le site (via sa page de profil)
                elseif ($_GET['action'] == 'deletePraticien') {
                    
                    if(isset($_SESSION['id']) && $_SESSION['id'] > 0) {
                        $suppressId = $_SESSION['id'];
                        echo '<pre class="mx-auto">Etes vous sûr de vouloir nous quitter ' . ucfirst($_SESSION['praticienPrenom']) . ' ' . ucfirst($_SESSION['patientNom']) . '</pre>';
                        require('app\view\confirmDeletePraticien.php');
                    }
                }
                // Demande de confirmation au praticien afin de supprimer son compte ou annuler l'action
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
                /*=========== End of Section Praticien =========*/
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