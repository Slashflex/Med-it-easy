<?php
// Loading classes
namespace Projet\app\controller;

use \Projet\app\model\EventManager;
use \Projet\app\model\PatientManager;
use \Projet\app\model\PraticienManager;
use \Projet\app\model\Manager;

class Controller
{
    private $patientManager;
    private $praticienManager;
    private $eventManager;

    public function __construct()
    {
        // Creating class instances (object)
        $this->patientManager = new PatientManager;
        $this->praticienManager = new PraticienManager;
        $this->eventManager = new EventManager;
    }
    /*=================== Section Patient ======================*/
    // Call a function of this object
    public function formPatient($patientPrenom, $patientNom, $patientDate, $email, $password_1, $password_2)
    {
        if ($password_1 != $password_2) {
            throw new Exception("les deux mots de passe ne correspondent pas");
        } else {
            $passHash = password_hash($password_1, PASSWORD_DEFAULT);
            $this->patientManager->createPatient($patientPrenom, $patientNom, $patientDate, $email, $passHash);
        }
        require('app\view\connexionPatient.php');
    }
    public function passVerify($password_1, $email)
    {
        // Calling the method of the model that will search in the database...
        //... the user who has this email and stock it in the variable $patientTest
        $patientTest = $this->patientManager->connectPatient($email);
        $result = password_verify($password_1, $patientTest['password_1']);
        
        if ($result) {
            $_SESSION['patientPrenom'] = $patientTest['patientPrenom'];
            $_SESSION['patientNom'] = $patientTest['patientNom'];
            $_SESSION['id'] = $patientTest['id_patient'];
            $_SESSION['patientEmail'] = $patientTest['email'];
            if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == "on") {
                // set cookie
                setcookie('id', 'patientEmail', 'patientPrenom', 'patientNom', time() + 365243600, null, null, false, true);
                $rememberMe = $_POST['rememberMe'];
            }
            require('app\view\connectedPatient.php');
        } else {
            echo '<pre>MDP/Login incorrect</pre>';
        }
    }
    public function delPatient($deleteid)
    {
        $this->patientManager->deletePatient($deleteid);
    }
    // Display of legal notices
    public function displayLegalNotice()
    {
        header('Location: app\view\mentionsLegales.php');
    }
    // public function patient($id)
    // {
    //     $this->patientManager = new PatientManager;
    //     $patient = $patientManager->getPatient($deleteid);
    // }
    /*=================== Fin Section Patient ======================*/




    /*=================== Section Praticien =======================*/
    // Appel d'une fonction de cet objet
    public function formPraticien($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $password_1, $password_2, $specialite)
    {
        if ($password_1 != $password_2) {
            throw new Exception("les deux mots de passe ne correspondent pas");
        } else {
            $passHash = password_hash($password_1, PASSWORD_DEFAULT);
            $this->praticienManager->createPraticien($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $passHash, $specialite);
            //todo tester le fonctionnement
        }
        require('app\view\connexionPraticien.php');
    }
    public function passVerif($password_1, $praticienEmail)
    {
        // Appel de methode du model qui va chercher dans la bdd l'utilisateur ...
        // ...qui a cet email et le stock dans la variable $patientTest
        $praticienTest = $this->praticienManager->connectPraticien($praticienEmail);
        // On récupere le password de l'utilisateur ayant pour email contenu dans la BDD
        $result = password_verify($password_1, $praticienTest['password_1']);
        
        if ($result) {
            $_SESSION['praticienPrenom'] = $praticienTest['praticienPrenom'];
            $_SESSION['praticienNom'] = $praticienTest['praticienNom'];
            $_SESSION['id'] = $praticienTest['id_praticien'];
            $_SESSION['praticienEmail'] = $praticienTest['praticienEmail'];
            if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == "on") {
                // set cookie
                setcookie('id', 'praticienEmail', time() + 365243600, null, null, false, true);
                $rememberMe = $_POST['rememberMe'];
                // echo $rememberMe;
                //die;
            }
            require('app\view\connectedPraticien.php');
        } else {
            echo '<pre>MDP/Login incorrect</pre>';
        }
    }
    public function delPraticien($deleteid)
    {
        $this->praticienManager->deletePraticien($deleteid);
    }
    
    // public function praticien($id)
    // {
    //     $this->praticienManager = new PraticienManager;
    //     $praticien = $praticienManager->getPraticien($deleteid);
    // }
    /*=================== Fin Section Patient =====================*/

    /*===================== Section Event =========================*/
    // Function to add event
    public function addSingleEvent()
    {
        $this->eventManager = new EventManager;
        $event = $eventManager->addEvents();
    }

    /*==================== Fin Section Event ======================*/
}
