<?php

namespace Projet\app\model;

use \Projet\app\model\Manager;
use \Exception;

class EventManager extends Manager
{
    // Add event and insert it into DataBase
    public function addEvents()
    {
        $db = $this->dbConnect();
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $req = $db->prepare("INSERT INTO events (title, start, end) VALUES (:title, :start, :end )");
        $req->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end));
        //$patient = $req->fetch();
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
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $req = $db->prepare("INSERT INTO events (title, start, end) VALUES (:title, :start, :end )");
        $req->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end));
    }
    
    // Delete event that has this DataBase ID
    public function deleteEvent()
    {
        $db = $this->dbConnect();
        $id = $_POST['id'];
        $req = $db->prepare("DELETE from events WHERE id = $id");
        $req->execute();
        return $req;
    }
}
