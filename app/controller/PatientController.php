<?php
// --- CLASS LOADING
    namespace Projet\app\controller;

    use \Projet\app\model\EventManager;
    use \Projet\app\model\PatientManager;
    use \Projet\app\model\PraticienManager;
    use \Projet\app\model\Manager;
    use \Exception;

// --- CLASS MANAGING PATIENTS
class PatientController
{
    private $patientManager;
    private $eventManager;

    public function __construct()
    {
        // Creating class instances (object)
        $this->patientManager = new PatientManager;
        $this->praticienManager = new PraticienManager;
        $this->eventManager = new EventManager;
    }
// --- REGISTER PATIENT
    public function registerPatient()
    {
        // Convert special characters to HTML entities
        $patientPrenom = htmlspecialchars($_POST['patientPrenom']);
        $patientNom = htmlspecialchars($_POST['patientNom']);
        $patientDate = htmlspecialchars($_POST['patientDate']);
        $email = htmlspecialchars($_POST['email']);
        $password_1 = htmlspecialchars($_POST['password_1']);
        $password_2 = htmlspecialchars($_POST['password_2']);
        $id_praticien = htmlspecialchars($_POST['id_praticien']);
        // If passwords doesn't match...
        if ($password_1 != $password_2) {
            //...returns an error
            throw new Exception("les deux mots de passe ne correspondent pas");
        } 
        // REGEXP control
        elseif (preg_match("/^[a-zA-Zéèêîïôüùâàäë]+([\ \-]{0,1})[a-zA-Zéèêîïôüùâàäë]*$/i", $patientPrenom) 
         && preg_match("/^[a-zA-Zéèêîïôüùâàäë]+([\ \-]{0,1})[a-zA-Zéèêîïôüùâàäë]*$/i", $patientNom) 
         && preg_match("/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+.[a-z]{2,4}$/", $email) 
         && preg_match("/^[A-Z][a-zA-Z0-9_-]{7,20}$/", $password_1) 
         && preg_match("/^[A-Z][a-zA-Z0-9_-]{7,20}$/", $password_2)) {
                // Else, password is hashed...
                $passHash = password_hash($password_1, PASSWORD_DEFAULT);
                // //...and Patient accound is created and his datas are stored into the database
                $this->patientManager->createPatient($patientPrenom, $patientNom, $patientDate, $email, $passHash, $id_praticien);
            } else {
                throw new Exception('Vous devez respecter les caractères autorisés par le formulaire');
            }
        // On Register complete, sends an email to Patient to confirm his sign up
        $to = $email;
        $subject = 'Med It Easy | Confirmation de compte';
        $message = 'Bonjour ! '. ucfirst($patientPrenom)  . ' ' . ucfirst($patientNom)  . '\r\n' . ' 
        Afin de confirmer votre inscription sur le site Med It Easy, 
        merci de cliquer sur le lien ci-dessous.
        <a href="action">Confirmez votre inscription</a>';
        $message .= '</body></html>';
        $headers = 'From: pro.davidsaoud@mediteasy.fr' . "\r\n" .
        'Reply-To: pro.davidsaoud@mediteasy.fr' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $message, $headers);
            require('app/views/patients/connexionPatient.php');
        }
// --- PASSWORD VERIFICATION
    public function passVerify($password_1, $email)
    {
        // Method call of the model that will find in the database the Patient...
        //... who has this email and store it in the variable $data
        $data = $this->patientManager->connectPatient($email);
        // We recover the password of the Patient having this email stored into database
        $result = password_verify($password_1, $data['password_1']);
        // Dropdown menu (<select></select>) displaying all Doctors registered
        $coords = $this->praticienManager->getPraticienCoords();
        // If true ...
        if ($result) {
            // ...storing datas in super global variables
            $_SESSION['patientPrenom'] = $data['patientPrenom'];
            $_SESSION['patientNom'] = $data['patientNom'];
            $_SESSION['id'] = $data['id_patient'];
            $_SESSION['patientEmail'] = $data['email'];
            $_SESSION['id_praticien'] = $data['id_praticien'];
            // If checkbox "Remember me" is checked ...
            if (isset($_POST['rememberMe']) && $_POST['rememberMe'] == "on") {
                // set cookie with datas
                setcookie('id', 'patientEmail', 'patientPrenom', 'patientNom', time() + 365243600, null, null, false, true);
                $rememberMe = htmlspecialchars($_POST['rememberMe']);
            }
                require('app/views/patients/connectedPatient.php');
            } else {
                // If passwords doesn't match, returns an error
                throw new Exception('Mot de passe ou adresse email incorrect(e)');
            }
        }
// --- LIST OF DOCTORS ALREADY REGISTERED (<select></select>)
    public function methodPatient()
    {
        $req = $this->praticienManager->getSubbedPraticien();
        require('app/views/patients/registerPatient.php');
    }
// --- DELETE PATIENT
    public function delPatient($id_patient)
    {
        // Delete events bound to patient
        $this->patientManager->delPatientEvents($id_patient);
        // Delete id_praticien bound to patient
        $this->patientManager->delPraticienOfPatient($id_patient);
        // Delete patient into DB
        $this->patientManager->deletePatient($id_patient);
    }
// --- LIST TYPE OF ACTES & LIST ALL DOCTORS BY SPECIALITIES
        public function rdvStep1()
        {
            // List all types of actes on patient's booking form
            $typeActes = $this->patientManager->getTypeActes();
            $duplicate = $this->praticienManager->removeDuplicatesSpe();
            // Request to display the doctor's informations on the patient registration form...
            // ...so patient can choose his doctor
            $coords = $this->praticienManager->getPraticienCoords();
            require('app/views/patients/rdvPatientStep1.php');
        }

// --- UPDATE PATIENT DATAS
    public function updatePatientInfos()
    {
        $email = htmlspecialchars($_POST['email']);
        $password_1 = htmlspecialchars($_POST['password_1']);
        $id_patient = $_SESSION['id'];
        $passHash = password_hash($password_1, PASSWORD_DEFAULT);
        $req = $this->patientManager->updatePatient($email, $passHash, $id_patient);
    }

// --- WRITE DATAS ON JSON FILE
    // Write datas from rdvPatientStep1 view into a JSON file (app\public\json\testJson.json)
    public function testJson()
    {
        $consult = htmlspecialchars($_POST['test']);
        $prat = htmlspecialchars($_POST['id_praticien']);
        //$pratPrenom = htmlspecialchars($_GET['praticienPrenom']);
        $donneesArray = array($consult, $prat);
        $fichierOpen = fopen('app/public/json/testJson.json', 'w');
        $fichierWrite = fwrite($fichierOpen, json_encode($donneesArray));
    }

    // Write datas from rdvPatientStep2 view into a JSON file (app\public\json\testJson2.json)
    public function testJson2()
    {
        $date = htmlspecialchars($_POST['date']);
        $hour = htmlspecialchars($_POST['hour']);
        $donneesArray = array($date, $hour);
        $fichierOpen = fopen('app/public/json/testJson2.json', 'w');
        $fichierWrite = fwrite($fichierOpen, json_encode($donneesArray));
    }

    // TO DO...
    public function testAddEvent($param1, $param2, $param3, $param4)
    {
        $this->eventManager->testEvent($param1, $param2, $param3, $param4);
        // $json = file_get_contents('app\public\json\testJson.json');
        // $json2 = file_get_contents('app\public\json\testJson2.json');
        // //Decode JSON
        // $json_data = json_decode($json,true);
        // $json_data2 = json_decode($json2,true);
        // On Register complete, sends an email to Patient to confirm his sign up
        // $to = $_SESSION['patientEmail'];
        // $subject = 'Med It Easy | Confirmation de rendez-vous';
        // $message = 'Bonjour ! '. ucfirst($_SESSION['patientPrenom'])  . ' ' . ucfirst($_SESSION['patientNom']) . '<br>
        // Votre rendez-vous est confirmé pour le ' . $json_data2['0']. ' à ' . $json_data2['1'].',
        // avec le Docteur ' . $json_data['1'] . ' pour le type de rendez-vous : ' . $json_data['0'] . '.<br>
        // merci de penser à vous munir de votre carte vitale.';
        // $headers = 'From: admin@med-it-easy.com' . "\r\n" .
        // 'Reply-To: admin@med-it-easy.com' . "\r\n" .
        // 'X-Mailer: PHP/' . phpversion();
        // mail($to, $subject, $message, $headers);
        require('app/views/patients/connectedPatient.php');
    }
    
    // --- SELECT ALL EVENTS BOOKED BY PATIENTS WITH HIS DOCTOR(S)
        // public function getPatientRdv($id_praticien)
        // {
        //     $save = $this->eventManager->getEvents($id_praticien);
        //     $events = $this->convert($save);
        //     echo $events;
        // }

// --- FORMAT FORM'S BOOKING FILEDS INTO STRING EXPECTED BY FULL CALENDAR PLUGIN
    private function convert($events)
    {
        $formatedEvents = [];
        foreach ($events as $event) {
            $formatedEvent['title'] = $event['patientNom'] . ' ' . $event['patientPrenom'] . ' ' . $event['description'];
            $formatedEvent['start'] = $event['start'] . ' ' . $event['hour'];
            $dateSrc = strtotime($formatedEvent['start']);
            $interval = 30 * 60;
            $formatedEvent['end'] = date("Y-m-d H:i:s", $dateSrc + $interval);
            $formatedEvent['color'] = $event['couleur'];
            $formatedEvents[] = $formatedEvent;
        }
        return json_encode($formatedEvents);
    }

// --- UPDATE PATIENT'S DOCTOR
    public function updatePratOfPatient($id_praticien, $id_patient)
    {
        $_SESSION['id_praticien'] = $id_praticien;
        $this->patientManager->updatePraticienOfPatient($id_praticien, $id_patient);
        require('app/views/patients/connectedPatient.php');
    }

// --- UPDATE PATIENT HAVING DEFAULT DOCTOR (if a DOCTOR delete his account, patient bound to this docotor will have to choose a new one)
    public function delFk($id_prat, $id_patient)
    {
        $this->patientManager->delFkPraticien($id_prat, $id_patient);
    }
// --- LIST ALL PATIENTS APPOINTMENTS
    public function listingRDV($id_patient)
    {
        $listRdv = $this->eventManager->patientListEvents($id_patient);
        $typeActes = $this->patientManager->getTypeActes();
        $coords = $this->praticienManager->getPraticienCoords();
        require('app/views/patients/listRdv.php');
    }
}