<?php

namespace Projet\app\model;

use \Projet\app\model\Manager;
use \Exception;

class PraticienManager extends Manager
{
    public function getPraticien($deletedid)
    {
        // prepare execute
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM praticien WHERE id_praticien = $deletedid');
        $req->execute();
        return $req;
    }

    // Praticien creation
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
    // TO DO ...
    public function getSubbedPraticien()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM praticien 
                           INNER JOIN specialite 
                           ON praticien.id_spe = specialite.id_spe 
                           WHERE id_praticien < 1000 
                           ORDER BY description');
        return $req;
    }
    // Praticien connexion
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

    public function getAllPatients($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT patientPrenom, patientNom, patientDate, email, id_praticien 
                             FROM patient 
                             INNER JOIN specialite 
                             ON specialite.id_spe = patient.id_praticien 
                             WHERE patient.id_praticien = (:id)');
        $req->execute(array('id' => $id));
        //$praticien = $req->fetch();
        return $req;
    }
    // TO DO ..
    // public function getDescription()
    // {
    //     $db = $this->dbConnect();
    //     $req = $db->prepare('SELECT praticienPrenom, praticienNom, description, dureeConsultation, couleur FROM praticien INNER JOIN typeacte ON praticien.id_spe = typeacte.id_type');
    //     $req->execute();
    //     $description = $req->fetch();
    //     return $description;
    // }



    // retrieve all datas from the 'specialite' table
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
                           WHERE id_praticien < 1000
                           ORDER BY description');
        return $req;
    }
    // Removes duplicate from 'specialite' table
    public function removeDuplicatesSpe()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT DISTINCT description FROM specialite');
        return $req;
    }
    // Updates Patients bound to this Default praticien
    public function upBeforeDelete($id_praticien) 
    {
        $db = $this->dbConnect();
        $req = $db->query("UPDATE patient SET id_praticien = 1000 WHERE id_praticien = $id_praticien");
        return $req;
    }
    // Deleting the praticien account with this ID in the DB
    public function deletePraticien($id_praticien)
    {
        $db = $this->dbConnect();
        $req = $db->query("DELETE FROM praticien WHERE id_praticien = $id_praticien");
        return $req;
    }


    








    
    
}
