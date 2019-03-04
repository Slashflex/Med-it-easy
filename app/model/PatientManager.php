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
        $req->execute([$email]);
        $patient = $req->fetch();
        // If user mail already exist, return an error
        if ($patient) {
            throw new Exception('Cet email existe déjà, veuillez réessayer avec une autre adresse email.');
            header('Location: app\view\registerPatient.php');
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
}
