<?php

namespace Projet\app\model;

use \Projet\app\model\Manager;
use \Exception;

class PraticienManager extends Manager
{
    public function getPraticien($deletedid)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM praticien WHERE id_praticien = $deletedid');
        return $req;
    }

    // Praticien creation
    public function createPraticien($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $password_1, $id_spe)
    {
        $db = $this->dbConnect();
        $email = htmlspecialchars($_POST['praticienEmail']);
        $req = $db->prepare("SELECT * FROM praticien WHERE praticienEmail = ?");
        $req->execute([$praticienEmail]);
        $praticien = $req->fetch();
        // If user mail already exist, return an error
        if ($praticien) {
            throw new Exception('Cet email existe déjà, veuillez réessayer avec une autre adresse email');
        // else, user is created
        } else {
            $praticien = $db->prepare('INSERT INTO praticien (praticienPrenom, praticienNom, praticienDate, praticienEmail, password_1, id_spe) 
            VALUES (?, ?, ?, ?, ?, ?)');
            $praticien->execute(array($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $password_1, $id_spe));
            return $praticien;
        }
    }
    // TO DO ...
    public function getSubbedPraticien()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM praticien 
                           INNER JOIN specialite 
                           ON praticien.id_praticien = specialite.id_spe');
                           return $req;
    }
    // Praticien connexion
    public function connectPraticien($praticienEmail)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM praticien 
        INNER JOIN specialite ON specialite.id_spe = praticien.id_spe WHERE praticienEmail = ?');
        $req->execute(array($praticienEmail));
        $praticien = $req->fetch();
        $req->closeCursor();
        return $praticien;
    }

    // Deleting the praticien account with this ID in the DB
    public function deletePraticien($deleteid)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM praticien WHERE id_praticien = (:deleteid)");
        $req->execute(array("deleteid" => $deleteid));
        return $req;
    }
    // retrieve all datas from the "specialite" table
    public function getSpecialites()
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM specialite");
        $req->execute();
        return $req;
    }
}
