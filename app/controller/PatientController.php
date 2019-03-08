<?php
// Loading classes
namespace Projet\app\controller;

use \Projet\app\model\EventManager;
use \Projet\app\model\PatientManager;
use \Projet\app\model\PraticienManager;
use \Projet\app\model\Manager;
use \Exception;

class PatientController
{
    private $patientManager;

    public function __construct()
    {
        // Creating class instance (object)
        $this->patientManager = new PatientManager;
        $this->praticienManager = new PraticienManager;
        $this->eventManager = new EventManager;
    }
    public function registerPatient()
    {
        $patientPrenom = htmlspecialchars($_POST['patientPrenom']);
        $patientNom = htmlspecialchars($_POST['patientNom']);
        $patientDate = htmlspecialchars($_POST['patientDate']);
        $email = htmlspecialchars($_POST['email']);
        $password_1 = htmlspecialchars($_POST['password_1']);
        $password_2 = htmlspecialchars($_POST['password_2']);
        $id_praticien = htmlspecialchars($_POST['id_praticien']);
        // Passwords compararison, if different...
        if ($password_1 != $password_2) {
            // ..returns an Exception
            throw new Exception("les deux mots de passe ne correspondent pas");
        } else {
            // Otherwise, password is hashed...
            $passHash = password_hash($password_1, PASSWORD_DEFAULT);
            // ...And a Patient account is created
            $this->patientManager->createPatient($patientPrenom, $patientNom, $patientDate, $email, $passHash, $id_praticien);
        }
        // Sending mail confirmation on register
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
        require('app\views\patients\connexionPatient.php');
    }
    public function methodPatient()
    {
        $req = $this->praticienManager->getSubbedPraticien();
        require('app\views\patients\registerPatient.php');
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
            require('app\views\patients\connectedPatient.php');
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
        require('app\views\patients\rdvPatientStep1.php');
    }
    // Update patient informations
    public function updatePatientInfos()
    {
        $email = htmlspecialchars($_POST['email']);
        $password_1 = htmlspecialchars($_POST['password_1']);
        $id_patient = $_SESSION['id'];
        $passHash = password_hash($password_1, PASSWORD_DEFAULT);
        $req = $this->patientManager->updatePatient($email, $passHash, $id_patient);
    }
    // TO DO...
    public function testJson()
    {
        $consult = htmlspecialchars($_POST['test']);
        $prat = htmlspecialchars($_POST['id_praticien']);
        $donneesArray = array($consult, $prat);
        $fichierOpen = fopen('app\public\json\testJson.json', 'w');
        $fichierWrite = fwrite($fichierOpen, json_encode($donneesArray));
    }
    public function testJson2()
    {
        $date = htmlspecialchars($_POST['date']);
        $hour = htmlspecialchars($_POST['hour']);
        $donneesArray = array($date, $hour);
        $fichierOpen = fopen('app\public\json\testJson2.json', 'w');
        $fichierWrite = fwrite($fichierOpen, json_encode($donneesArray));
    }
    // TO DO...
    public function testAddEvent($param1, $param2, $param3, $param4)
    {
        $this->eventManager->testEvent($param1, $param2, $param3, $param4);
        require('app\views\patients\connectedPatient.php');
    }
    
    // // TO DO ...
    // public function getPatientRdv()
    // {
    //     $save = $this->eventManager->getEvents();
    //     $events = $this->convert($save);
    //     echo $events;
    // }
    // private function convert($events)
    // {
    //     $formatedEvents = [];
    //     foreach ($events as $event) {
    //         $formatedEvent['title'] = $event['patientNom'] . ' ' . $event['patientPrenom'] . ' ' . $event['description'];
    //         $formatedEvent['start'] = $event['start'] . ' ' . $event['hour'];
    //         $dateSrc = strtotime($formatedEvent['start']);
    //         $interval = 30 * 60;
    //         $formatedEvent['end'] = date("Y-m-d H:i:s", $dateSrc + $interval);
    //         $formatedEvent['color'] = $event['couleur'];
    //         $formatedEvents[] = $formatedEvent;
    //     }
    //     return json_encode($formatedEvents);
    // }
    // Display of legal notices
    public function displayLegalNotice()
    {
        header('Location: app\views\mentionsLegales.php');
    }
}
