<?php
// --- CLASS LOADING
namespace Projet\app\model;

use \Projet\app\model\Manager;
use \Exception;

// --- CLASS MANAGING PATIENTS
class PatientManager extends Manager
{
    
// --- REGISTER PATIENT
    public function createPatient($patientPrenom, $patientNom, $patientDate, $email, $password_1, $id_praticien, $token)
    {
        $db = $this->dbConnect();
        $email = htmlspecialchars($_POST['email']);
        $req = $db->prepare("SELECT * FROM patient WHERE email = ?");
        $req->execute(array($email));
        $patient = $req->fetch();
        // If patient mail already exist, returns an error...
        if ($patient) {
            throw new Exception('Cet email existe déjà, veuillez réessayer avec une autre adresse email.');
            header('Location: app\views\patients\registerPatient.php');
            exit();
        //...else, patient is created
        } else {
            $patient = $db->prepare('INSERT INTO patient (patientPrenom, patientNom, patientDate, email, password_1, id_praticien, confirmationToken) 
                                     VALUES (:patientPrenom, :patientNom, :patientDate, :email, :password_1, :id_praticien, :token)');
            $patient->execute(array(
                'patientPrenom' => $patientPrenom,
                'patientNom' => $patientNom,
                'patientDate' => $patientDate,
                'email' => $email,
                'password_1' => $password_1,
                'id_praticien' => $id_praticien,
                'token' => $token));
            return $patient;
        }
    }

// --- PATIENT CONNEXION
    public function connectPatient($email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM patient WHERE email = (:email)');
        $req->execute(array('email' => $email));
        $patient = $req->fetch();
        $req->closeCursor();
        return $patient;
    }

// --- AUTO LOGIN ONCE ACCOUNT IS CONFIRMED
    public function autoLog($token)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM patient WHERE confirmationToken = :confirmationToken');
        $req->execute(array('confirmationToken' => $token));
        return $req;
    }

// --- SENDS NEW CONFIRMATION MAIL 
    public function checkPatientMail($email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT email FROM patient WHERE email = :email');
        $req->execute(array('email' => $email));
        return $req;
    }

// --- UPDATE TOKEN TO THIS EMAIL
    public function reSentMail($email, $token)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE patient SET confirmationToken = :token WHERE email = :email');
        $req->execute(array('email' => $email, 'token' => $token));
        return $req;
    }

// --- UPDATE TOKEN WHEN EMAIL LINK IS CLICKED
    public function updateToken($confirmationToken)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE patient SET confirmed = :confirmed WHERE confirmationToken = :confirmationToken');
        $req->execute(array(
            'confirmed' => 'true',
            'confirmationToken' => $confirmationToken));
        ////
        $req = $db->prepare('UPDATE patient SET confirmationToken = :confirmationToken WHERE confirmationToken = :confirmationToken');
        $req->execute(array('confirmationToken' => 'Confirmed Account'));
        ////
    }

// --- UPDATES PATIENT INFORMATIONS
    public function updatePatient($email, $password_1, $id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE patient SET email = :email, password_1 = :password_1 WHERE id_patient = :id_patient');
        $req->execute(array(
            'email' => $email,
            'password_1' => $password_1,
            'id_patient' => $id_patient));
        return $req;
    }

// --- UPDATES PATIENT'S DOCTOR ONCE THIS ONE DELETED HiS ACCOUNT
    public function updatePraticienOfPatient($id_praticien, $id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE patient SET id_praticien = :id_praticien WHERE id_patient = :id_patient');
        $req->execute(array('id_praticien' => $id_praticien, 'id_patient' => $id_patient));
        return $req;
    }
// --- LISTING ALL TYPES OF ACTES     
    public function getTypeActes()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM typeacte LIMIT 0, 7');
        return $req;
    }
// --- DELETE PATIENT
    public function deletePatient($id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM patient WHERE id_patient = (:id_patient)');
        $req->execute(array('id_patient' => $id_patient));
        return $req;
    }
// --- DELETE ALL EVENTS BOUND TO PATIENT
    public function delPatientEvents($id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM events WHERE id_patient = (:id_patient)');
        $req->execute(array('id_patient' => $id_patient));
        return $req;
    }
// --- DELETE DOCTOR'S ID BOUND TO PATIENT
    public function delPraticienOfPatient($id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM patient WHERE id_praticien = (:id_patient)');
        $req->execute(array('id_patient' => $id_patient));
        return $req;
    }
// --- IF PATIENT'S DOCTOR ACCOUNT IS NO MORE, ASK PATIENT TO CHOOSE A NEW ONE
    public function delFkPraticien($id_praticien, $id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE patient SET id_praticien = 1 WHERE id_patient = :id_patient');
        $req->execute(array('id_prat' => $id_praticien,
                            'id_patient' => $id_patient));
        return $req;
    }    
}