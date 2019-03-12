<?php

namespace Projet\app\model;

use \Projet\app\model\Manager;
use \Exception;

class PatientManager extends Manager
{
    // Patient creation
    public function createPatient($patientPrenom, $patientNom, $patientDate, $email, $password_1, $id_praticien)
    {
        $db = $this->dbConnect();
        $email = htmlspecialchars($_POST['email']);
        $req = $db->prepare("SELECT * FROM patient WHERE email = ?");
        $req->execute(array($email));
        $patient = $req->fetch();
        // If user mail already exist, return an error
        if ($patient) {
            throw new Exception('Cet email existe déjà, veuillez réessayer avec une autre adresse email.');
            header('Location: app\views\patients\registerPatient.php');
        // else, user is created
        } else {
            $patient = $db->prepare('INSERT INTO patient (patientPrenom, patientNom, patientDate, email, password_1, id_praticien) 
            VALUES (:patientPrenom, :patientNom, :patientDate, :email, :password_1, :id_praticien)');
            $patient->execute(array(
                'patientPrenom' => $patientPrenom,
                'patientNom' => $patientNom,
                'patientDate' => $patientDate,
                'email' => $email,
                'password_1' => $password_1,
                'id_praticien' => $id_praticien));
            return $patient;
        }
    }
    
    // Patient connexion
    public function connectPatient($email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM patient WHERE email = (:email)');
        $req->execute(array('email' => $email));
        $patient = $req->fetch();
        $req->closeCursor();
        return $patient;
    }
    // Update patient informations
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
    public function updatePraticienOfPatient($id_praticien, $id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE patient SET id_praticien = :id_praticien WHERE id_patient = :id_patient');
        $req->execute(array('id_praticien' => $id_praticien, 'id_patient' => $id_patient));
        return $req;
    }
    // TO DO...
    // Request to get all types of actes
    public function getTypeActes()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM typeActe LIMIT 0, 7');
        return $req;
    }
    // Delete patient account that has this DataBase ID
    public function deletePatient($deleteid)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM patient WHERE id_patient = (:deleteid)");
        $req->execute(array('deleteid' => $deleteid));
        return $req;
    }

    // Updates patients who have 
    public function delFkPraticien($id_praticien, $id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE patient SET id_praticien = 1000 WHERE id_patient = :id_patient');
        $req->execute(array('id_prat' => $id_praticien,
                            'id_patient' => $id_patient));
        return $req;
    }
}
