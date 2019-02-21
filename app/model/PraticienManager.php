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
    public function createPraticien($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $password_1, $specialite)
    {
        $db = $this->dbConnect();
        $email = htmlspecialchars($_POST['praticienEmail']);
        $req = $db->prepare("SELECT * FROM praticien WHERE praticienEmail = ?");
        $req->execute([$praticienEmail]);
        $praticien = $req->fetch();
        // If user mail already exist, return an error
        if ($praticien) {
            throw new Exception ('Cet email existe déjà, veuillez réessayer avec une autre adresse email');
        // else, user is created
        } else {
            $praticien = $db->prepare('INSERT INTO praticien (praticienPrenom, praticienNom, praticienDate, praticienEmail, password_1, specialite) 
            VALUES (?, ?, ?, ?, ?, ?)');
            $praticien->execute(array($praticienPrenom, $praticienNom, $praticienDate, $praticienEmail, $password_1, $specialite));
            return $praticien;
        }
    }

    // Connexion de praticien
    public function connectPraticien($praticienEmail)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM praticien WHERE praticienEmail = ?');
        $req->execute(array($praticienEmail));
        $praticien = $req->fetch();
        $req->closeCursor();
        return $praticien;
    }

    // Suppression du compte praticien ayant cet ID dans la BDD
    public function deletePraticien($deleteid)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM praticien WHERE id_praticien = (:deleteid)");
        $req->execute(array("deleteid" => $deleteid));
        return $req;
    }
}
