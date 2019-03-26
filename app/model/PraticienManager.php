<?php
// --- CLASS LOADING
namespace Projet\app\model;

use \Projet\app\model\Manager;
use \Exception;

// --- CLASS MANAGING DOCTORS
class PraticienManager extends Manager
{
// --- REGISTER DOCTOR   
    public function createPraticien($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $password_1, $id_spe)
    {
        // TO DO...
        $db = $this->dbConnect();
        $email = htmlspecialchars($_POST['praticienEmail']);
        $req = $db->prepare('SELECT * FROM praticien WHERE praticienEmail = (:praticienEmail)');
        $req->execute(array('praticienEmail' => $email));
        $praticien = $req->fetch();
        // If user mail already exist, return an error
        if ($praticien) {
            throw new Exception('Cet email existe déjà, veuillez réessayer avec une autre adresse email');
        // else, user is created
        } else {
            $praticien = $db->prepare('INSERT INTO praticien (praticienPrenom, praticienNom, praticienDate, praticienEmail, password_1, id_spe) 
            VALUES (:praticienPrenom, :praticienNom, :praticienDate, :praticienEmail, :password_1, :id_spe)');
            $praticien->execute(array(
                'praticienPrenom' => $praticienPrenom,
                'praticienNom' => $praticienNom,
                'praticienDate' => $praticienDate,
                'praticienEmail' => $praticienEmail, 
                'password_1' => $password_1, 
                'id_spe' => $id_spe));
            return $praticien;
        }
    }
// --- DOCTOR CONNEXION
    public function connectPraticien($praticienEmail)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM praticien 
                            INNER JOIN specialite 
                            ON specialite.id_spe = praticien.id_spe 
                            WHERE praticienEmail = (:praticienEmail)');
        $req->execute(array('praticienEmail' => $praticienEmail));
        $praticien = $req->fetch();
        $req->closeCursor();
        return $praticien;
    }
// --- LIST ALL DOCTORS WHO SIGNED UP
    public function getSubbedPraticien()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM praticien 
                           INNER JOIN specialite 
                           ON praticien.id_spe = specialite.id_spe 
                           WHERE id_praticien > 1 
                           ORDER BY description');
        return $req;
    }
// --- LIST PATIENTS BOUND TO "THIS" DOCTOR's ID
    public function getAllPatients($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT patientPrenom, patientNom, patientDate, email, id_patient, id_praticien 
                             FROM patient 
                             INNER JOIN specialite 
                             ON specialite.id_spe = patient.id_praticien 
                             WHERE patient.id_praticien = (:id)');
        $req->execute(array('id' => $id));
        return $req;
    }
// --- LIST ALL DATAS FROM "SPECIALITE" TABLE
    public function getSpecialites()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM specialite');
        $req->execute();
        return $req;
    }
// Request to display the doctor's informations on the patient registration form...
// ...so patient can choose his doctor
    public function getPraticienCoords()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT praticienPrenom, praticienNom, id_praticien, specialite.description 
                           FROM praticien 
                           INNER JOIN specialite 
                           ON praticien.id_spe = specialite.id_spe 
                           WHERE id_praticien > 1
                           ORDER BY description');
        return $req;
    }
// --- REMOVES DUPLICATE FIELDS (on select menu)
    public function removeDuplicatesSpe()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT DISTINCT description FROM specialite');
        return $req;
    }  
// --- UPDATE PATIENTS HAVING DEFAULT DOCTOR (id -> 1)
    public function upBeforeDelete($id_patient) 
    {
        $db = $this->dbConnect();
        $req = $db->prepare("UPDATE patient SET id_praticien = 1 WHERE id_patient = $id_patient");
        $req->execute(array('id_patient' => $id_patient));
        return $req;
    }
// --- DELETE DOCTOR'S ACCOUNT 
    public function deletePraticien($id_praticien)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM praticien WHERE id_praticien = $id_praticien");
        $req->execute(array('id_praticien' => $id_praticien));
        return $req;
    }
}
