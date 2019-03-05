<?php
// Loading classes
namespace Projet\app\controller;

use \Projet\app\model\EventManager;
use \Projet\app\model\PatientManager;
use \Projet\app\model\PraticienManager;
use \Projet\app\model\Manager;
use \Exception;

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
    public function formPatient($patientPrenom, $patientNom, $patientDate, $email, $password_1, $password_2, $id_praticien)
    {
        if ($password_1 != $password_2) {
            throw new Exception("les deux mots de passe ne correspondent pas");
        } else {
            $passHash = password_hash($password_1, PASSWORD_DEFAULT);
            $this->patientManager->createPatient($patientPrenom, $patientNom, $patientDate, $email, $passHash, $id_praticien);
        }
        // TO DO... Sending mail confirmation
        $to = $email;
        $subject = 'Med It Easy | Confirmation de compte';
        $message = 'Bonjour ! '. ucfirst($patientPrenom)  . ' ' . ucfirst($patientNom) . '<br> 
        Afin de confirmer votre inscription sur le site Med It Easy, 
        merci de cliquer sur le lien ci-dessous. <br>
        <a href="action">Confirmez votre inscription</a>';
        $headers = 'From: admin@med-it-easy.com' . "\r\n" .
        'Reply-To: admin@med-it-easy.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
        require('app\view\connexionPatient.php');
    }
    // TO DO ...
    public function methodPatient()
    {
        $req = $this->praticienManager->getSubbedPraticien();
        require('app\view\registerPatient.php');
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
                $rememberMe = htmlspecialchars($_POST['rememberMe']);
            }
            require('app\view\connectedPatient.php');
        } else {
            throw new Exception('Mot de passe ou adresse email incorrect(e)');
        }
    }
    public function delPatient($deleteid)
    {
        $this->patientManager->deletePatient($deleteid);
    }



    public function rdvStep1()
    {
        // List all types of actes on patient's booking form
        $typeActes = $this->patientManager->getTypeActes();
        $duplicate = $this->praticienManager->removeDuplicatesSpe();
        // Request to display the doctor's informations on the patient registration form...
        // ...so patient can choose his doctor
        $coords = $this->praticienManager->getPraticienCoords();
        require('app\view\rdvPatientStep1.php');
    }
    // Update patient informations
    public function updatePatientInfos($email, $password_1, $id_patient)
    {
        $passHash = password_hash($password_1, PASSWORD_DEFAULT);
        $req = $this->patientManager->updatePatient($email, $passHash, $id_patient);
    }
    


    // TO DO...
    public function testJson($param1, $param2)
    {
        $donneesArray = array($param1, $param2);
        $fichierOpen = fopen('app\public\json\testJson.json', 'w');
        $fichierWrite = fwrite($fichierOpen, json_encode($donneesArray));
    }
    public function testJson2($param1, $param2)
    {
        $donneesArray = array($param1, $param2);
        $fichierOpen = fopen('app\public\json\testJson2.json', 'w');
        $fichierWrite = fwrite($fichierOpen, json_encode($donneesArray));
    }

    public function testAddEvent($param1, $param2, $param3, $param4)
    {
        $this->eventManager->testEvent($param1, $param2, $param3, $param4);
        require('app\view\connectedPatient.php');
    }
    
    // TO DO ...
    public function getPatientRdv()
    {
        $save = $this->eventManager->getEvents();
        echo $save;
    }


    // Display of legal notices
    public function displayLegalNotice()
    {
        header('Location: app\view\mentionsLegales.php');
    }
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
        }
        // TO DO... Sending mail confirmation
        $to = $praticienEmail;
        $subject = 'Med It Easy | Confirmation de compte';
        $message = 'Bonjour ! '. ucfirst($praticienPrenom)  . ' ' . ucfirst($praticienNom) . '<br> 
        Afin de confirmer votre inscription sur le site Med It Easy, 
        merci de cliquer sur le lien ci-dessous. <br>
        <a href="action">Confirmez votre inscription</a>';
        $headers = 'From: admin@med-it-easy.com' . "\r\n" .
        'Reply-To: admin@med-it-easy.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
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
            $_SESSION['specialite'] = $praticienTest['description'];
            if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == "on") {
                // set cookie
                setcookie('id', 'praticienEmail', time() + 365243600, null, null, false, true);
                $rememberMe = htmlspecialchars($_POST['rememberMe']);
            }
            require('app\view\connectedPraticien.php');
        } else {
            throw new Exception('Mot de passe ou adresse email incorrect(e)');
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
    public function addPraticien()
    {
        $specialites = $this->praticienManager->getSpecialites();
        // $_SESSION['id_spe'] = $specialites['description'];
        require('app\view\registerPraticien.php');
    }
    public function listAllPatients($id)
    {
        $praticien = $this->praticienManager->getAllPatients($id);
        require('app\view\patientBase.php');
    }
    /*=================== Fin Section Praticien =====================*/

    /*===================== Section Event =========================*/
    // Function to add event
    public function addEvent($id_event, $start, $id_type, $id_patient)
    {
        $title = htmlspecialchars($_POST['id_event']);
        $start = htmlspecialchars($_POST['start']);
        $type = htmlspecialchars($_POST['id_type']);
        $id = htmlspecialchars($_POST['id_patient']);
        $this->eventManager = new EventManager;
        $event = $eventManager->addEvents($title, $start, $type, $id);
    }

    /*==================== Fin Section Event ======================*/
}
