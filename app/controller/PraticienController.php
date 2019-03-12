<?php
// Loading classes
namespace Projet\app\controller;

use \Projet\app\model\EventManager;
use \Projet\app\model\PatientManager;
use \Projet\app\model\PraticienManager;
use \Projet\app\model\Manager;
use \Exception;

class PraticienController
{
    private $praticienManager;

    public function __construct()
    {
        // Creating class instance (object)
        $this->praticienManager = new PraticienManager;
    }
    public function registerPraticien()
    {
        $praticienPrenom = htmlspecialchars($_POST['praticienPrenom']);
        $praticienNom = htmlspecialchars($_POST['praticienNom']);
        $praticienDate = htmlspecialchars($_POST['praticienDate']);
        $praticienEmail = htmlspecialchars($_POST['praticienEmail']);
        $password_1 = htmlspecialchars($_POST['password_1']);
        $password_2 = htmlspecialchars($_POST['password_2']);
        $specialite = htmlspecialchars($_POST['specialite']);
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
        require('app\views\praticiens\connexionPraticien.php');
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
            require('app\views\praticiens\connectedPraticien.php');
        } else {
            throw new Exception('Mot de passe ou adresse email incorrect(e)');
        }
    }
    //
    public function delPraticien($id_praticien)
    {
        $this->praticienManager->upBeforeDelete($id_praticien);
        $this->praticienManager->deletePraticien($id_praticien);
    }
    public function addPraticien()
    {
        $specialites = $this->praticienManager->getSpecialites();
        require('app\views\praticiens\registerPraticien.php');
    }
    // Listing of all patients bound to this Doctor (PatientBase view)
    public function listAllPatients($id)
    {
        $praticien = $this->praticienManager->getAllPatients($id);
        require('app\views\praticiens\patientBase.php');
    }
    public function doctorsList()
    {
        $this->praticienManager->getSubbedPraticien();
    }
}