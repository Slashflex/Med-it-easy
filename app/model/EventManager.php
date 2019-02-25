<?php

namespace Projet\app\model;

use \Projet\app\model\Manager;
use \Exception;

class EventManager extends Manager
{
    // Add event and insert it into DataBase
    public function addEvents($title, $start, $id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("INSERT INTO events (id_type, start, id_patient) VALUES (:title, :start, :id_patient )");
        $req->execute(array('title'=>$title, 'start'=>$start, 'id_patient'=>$id_patient));
    }

    public function getEvents()
    {
        $db = $this->dbConnect();
        $json = array();
        $req = "SELECT * FROM events ORDER BY id";
        $resultat = $db->query($req) or die(print_r($db->errorInfo()));
        echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
    }

    public function updateEvent()
    {
        $db = $this->dbConnect();
        $title = htmlspecialchars($_POST['title']);
        $start = htmlspecialchars($_POST['start']);
        $end = htmlspecialchars($_POST['end']);
        $req = $db->prepare("INSERT INTO events (title, start, end) VALUES (:title, :start, :end )");
        $req->execute(array('title'=>$title, 'start'=>$start, 'end'=>$end));
    }
    
    // Delete event that has this DataBase ID
    public function deleteEvent()
    {
        $db = $this->dbConnect();
        $id = htmlspecialchars($_POST['id']);
        $req = $db->prepare("DELETE from events WHERE id = $id");
        $req->execute();
        return $req;
    }
}
