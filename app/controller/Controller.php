<?php
// Chargement des classes
// require_once('app\model\PatientManager.php');
// require_once('app\model\PraticienManager.php');
// require_once('app\model\Manager.php');
namespace Projet\app\controller;

use \Projet\app\model\PatientManager;
use \Projet\app\model\PraticienManager;
use \Projet\app\model\Manager;

class Controller
{
    private $patientManager;
    private $praticienManager;

    public function __construct()
    {
        // Création d'une instance de classe (objet)
        $this->patientManager = new PatientManager;
        $this->praticienManager = new PraticienManager;
    }
    /*=================== Section Patient ======================*/
    // Appel d'une fonction de cet objet
    public function formPatient($patientPrenom, $patientNom, $patientDate, $email, $password_1, $password_2)
    {

        if ($password_1 != $password_2) 
        {
            throw new Exception("les deux mots de passe ne correspondent pas");
        } else {
            $passHash = password_hash($password_1, PASSWORD_DEFAULT);
            $this->patientManager->createPatient($patientPrenom, $patientNom, $patientDate, $email, $passHash);
            //todo tester le fonctionnement
        }
        require('app\view\connexionPatient.php');
    }
    public function passVerify($password_1, $email)
    {
        // Appel de methode du model qui va chercher dans la bdd l'utilisateur ...
        // ...qui a cet email et le stock dans la variable $patientTest
        $patientTest = $this->patientManager->connectPatient($email);
        // On récupere le password de l'utilisateur ayant pour email contenu dans la BDD 
        $result = password_verify($password_1, $patientTest['password_1']);
        
        if ($result) {
            
            $_SESSION['patientPrenom'] = $patientTest['patientPrenom'];
            $_SESSION['patientNom'] = $patientTest['patientNom'];
            $_SESSION['id'] = $patientTest['id_patient'];
            $_SESSION['patientEmail'] = $patientTest['email'];
            
            require('app\view\connectedPatient.php');

        } else {
            echo '<pre>MDP/Login incorrect</pre>';
        }
    }
    function delPatient($deleteid)
    {
        //$patientManager = new PatientManager();
        $this->patientManager->deletePatient($deleteid);
        //header('Location: index.php');
    }
    // Affichage des mentions légales
    public function displayLegalNotice()
    {
        header('Location: app\view\mentionsLegales.php');
    }
    public function patient($id) {
        $this->patientManager = new PatientManager;
        $patient = $patientManager->getPatient($deleteid);
    }





    /*=================== Section Praticien ======================*/
    // Appel d'une fonction de cet objet
    public function formPraticien($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $password_1, $password_2, $specialite)
    {

        if ($password_1 != $password_2) 
        {
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
                setcookie( 'id','praticienEmail', time() + 365243600, null, null, false, true);
                $rememberMe = $_POST['rememberMe'];
                // echo $rememberMe; 
                //die;
            }
            require('app\view\connectedPraticien.php');

        } else {
            echo '<pre>MDP/Login incorrect</pre>';
        }
    }
    function delPraticien($deleteid)
    {
        //$praticienManager = new PraticienManager();
        $this->praticienManager->deletePraticien($deleteid);
        //header('Location: index.php');
    }
    
    public function praticien($id) {
        $this->praticienManager = new PraticienManager;
        $praticien = $praticienManager->getPraticien($deleteid);
    }

}