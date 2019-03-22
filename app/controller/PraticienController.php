<?php
// --- CLASS LOADING
    namespace Projet\app\controller;

    use \Projet\app\model\EventManager;
    use \Projet\app\model\PatientManager;
    use \Projet\app\model\PraticienManager;
    use \Projet\app\model\Manager;
    use \Exception;

// --- CLASS MANAGING DOCTORS
    class PraticienController
    {
        private $praticienManager;

        public function __construct()
        {
            // Creating class instance (object)
            $this->praticienManager = new PraticienManager;
        }
// --- REGISTER DOCTOR
        public function registerPraticien()
        {
            // Convert special characters to HTML entities
            $praticienPrenom = htmlspecialchars($_POST['praticienPrenom']);
            $praticienNom = htmlspecialchars($_POST['praticienNom']);
            $praticienDate = htmlspecialchars($_POST['praticienDate']);
            $praticienEmail = htmlspecialchars($_POST['praticienEmail']);
            $password_1 = htmlspecialchars($_POST['password_1']);
            $password_2 = htmlspecialchars($_POST['password_2']);
            $specialite = htmlspecialchars($_POST['specialite']);
            // If passwords doesn't match...
            if ($password_1 != $password_2) {
                //...returns an error
                throw new Exception("les deux mots de passe ne correspondent pas");
            } else {
                // Else, password is hashed...  
                $passHash = password_hash($password_1, PASSWORD_DEFAULT);
                //...and Doctor accound is created and his datas are stored into the database
                $this->praticienManager->createPraticien($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $passHash, $specialite);
            }
            // On Register complete, sends an email to Doctor to confirm his sign up
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
            require('app/views/praticiens/connexionPraticien.php');
        }
// --- PASSWORD VERIFICATION   
        public function passVerif($password_1, $praticienEmail)
        {
            // Method call of the model that will find in the database the Doctor...
            //... who has this email and store it in the variable $data
            $data = $this->praticienManager->connectPraticien($praticienEmail);
            // We recover the password of the Doctor having this email stored into database
            $result = password_verify($password_1, $data['password_1']);
            // If true ...
            if ($result) {
                // ...storing datas in super global variables
                $_SESSION['praticienPrenom'] = $data['praticienPrenom'];
                $_SESSION['praticienNom'] = $data['praticienNom'];
                $_SESSION['id'] = $data['id_praticien'];
                $_SESSION['praticienEmail'] = $data['praticienEmail'];
                $_SESSION['specialite'] = $data['description'];
                // If checkbox "Remember me" is checked ...
                if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == "on") {
                    // ... set cookie with datas
                    setcookie('id', 'praticienEmail', time() + 365243600, null, null, false, true);
                    $rememberMe = htmlspecialchars($_POST['rememberMe']);
                }
                require('app/views/praticiens/connectedPraticien.php');
            } else {
                // If passwords doesn't match, returns an error 
                throw new Exception('Mot de passe ou adresse email incorrect(e)');
            }
        }
// --- DELETE DOCTOR
        public function delPraticien($id_praticien)
        {   
            $patients = $this->praticienManager->getAllPatients($id_praticien);
            while ($patient = $patients->fetch())  {
                // Update Patients bound to this Default praticien
                $this->praticienManager->upBeforeDelete($patient['id_patient']);
            }
            // Delete the Doctor account with "this ID" in the DB
            $this->praticienManager->deletePraticien($id_praticien);
        }
// --- GET LIST OF DOCTORS (specialities)        
        public function addPraticien()
        {
            // Retrieve all datas from the 'specialite' table
            $specialites = $this->praticienManager->getSpecialites();
            require('app/views/praticiens/registerPraticien.php');
        }

// --- LISTING OF ALL PATIENTS
        public function listAllPatients($id)
        {
            // List patients bound to "this specific Doctor's ID" 
            $praticien = $this->praticienManager->getAllPatients($id);
            require('app/views/praticiens/patientBase.php');
        }
// --- LISTING OF ALL DOCTORS 
        public function doctorsList()
        {
            // List all Doctors registered into database to display them into a select list (app\views\patients\rdvPatientStep1.php)
            $this->praticienManager->getSubbedPraticien();
        }
}