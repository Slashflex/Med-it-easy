<?php

namespace Projet\app\model;

use \Projet\app\model\Manager;
use \Exception;

class EventManager extends Manager
{
    // Add event and insert it into DataBase
    public function addEvents($id_event, $start, $id_type, $id_patient)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO events (id_event, start, id_type, id_patient) VALUES (?, ?, ?, ?)');
        $req->execute(array($id_event, $start, $id_type, $id_patient));
        return $req;
    }

    public function getEvents()
    {
        $db = $this->dbConnect();
        $json = array();
        $req = $db->query('SELECT * FROM events ORDER BY id');
        $resultat = $db->query($req) or die(print_r($db->errorInfo()));
        echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));
    }

    public function updateEvent()
    {
        $db = $this->dbConnect();
        $title = htmlspecialchars($_POST['title']);
        $start = htmlspecialchars($_POST['start']);
        $end = htmlspecialchars($_POST['end']);
        $req = $db->prepare('INSERT INTO events (title, start, end) VALUES (:title, :start, :end )');
        $req->execute(array('title'=>$title, 'start'=>$start, 'end'=>$end));
        return $req;
    }
    
    // Delete event that has this DataBase ID
    public function deleteEvent()
    {
        $db = $this->dbConnect();
        $id = htmlspecialchars($_POST['id']);
        $req = $db->prepare('DELETE from events WHERE id_event = $id');
        $req->execute();
        return $req;
    }
}
