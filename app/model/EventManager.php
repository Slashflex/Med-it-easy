<?php
// --- CLASS LOADING
    namespace Projet\app\model;

    use \Projet\app\model\Manager;
    use \Exception;
    use \PDO;

// --- CLASS MANAGING EVENTS
    class EventManager extends Manager
    {
// --- INSERT EVENTS BOOKED BY PATIENTS INTO DATABASE
        public function addEvents($id_event, $start, $id_type, $id_patient)
        {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO events (id_event, start, id_type, id_patient) VALUES (?, ?, ?, ?)');
            $req->execute(array($id_event, $start, $id_type, $id_patient));
            return $req;
        }
// --- SELECT ALL EVENTS BOOKED BY PATIENTS WITH HIS DOCTOR(S)
        public function getEvents($id_praticien)
        {
            $db = $this->dbConnect();
            $json = array();
            $req = $db->prepare('SELECT e.id_event, description, dureeConsultation, couleur, patientNom, patientPrenom, start, hour
                                 FROM events AS e
                                 INNER JOIN patient 
                                 ON patient.id_patient = e.id_patient
                                 INNER JOIN typeacte
                                 ON typeacte.id_type = e.id_type
                                 WHERE patient.id_praticien = :id_praticien');
            $req->execute(array('id_praticien' => $id_praticien));
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
// --- UPDATES EVENTS ON DRAG AND DROP ?????
        // public function updateEvent()
        // {
        //     $db = $this->dbConnect();
        //     $title = htmlspecialchars($_POST['title']);
        //     $start = htmlspecialchars($_POST['start']);
        //     $end = htmlspecialchars($_POST['end']);
        //     $req = $db->prepare('INSERT INTO events (title, start, end) VALUES (:title, :start, :end )');
        //     $req->execute(array('title'=>$title, 'start'=>$start, 'end'=>$end));
        //     return $req;
        // }

// --- DELETES EVENTS
        // Delete event that has this DataBase ID
        // public function deleteEvent()
        // {
        //     $db = $this->dbConnect();
        //     $id = htmlspecialchars($_POST['id']);
        //     $req = $db->prepare('DELETE from events WHERE id_event = $id');
        //     $req->execute();
        //     return $req;
        // }
// --- INSERT EVENTS INTO DATABASE
        public function testEvent($param1, $param2, $param3, $param4)
        {
            $exp = explode('/', $param2);
            $param2 = $exp[2] . '-' . $exp[1] . '-' . $exp[0];
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO events (start, id_type, id_patient, hour) VALUES (:start, :id_type, :id_patient, :hour);');
            $req->execute(array(
                'start' => $param2,
                'id_type' => $param1,
                'id_patient' => $param4,
                'hour' => $param3
            ));
            return $req;
        }

// --- LIST ALL EVENTS BOUND TO PATIENT AND DOCTORS
        public function patientListEvents($id_patient)
        {
            $db = $this->dbConnect();
            $listRdv = $db->prepare('SELECT description, dureeConsultation, couleur, patientNom, patientPrenom, start, hour, praticienNom, praticienPrenom 
                                     FROM events 
                                     INNER JOIN patient 
                                     ON patient.id_patient = events.id_patient 
                                     INNER JOIN praticien ON praticien.id_praticien = patient.id_praticien 
                                     INNER JOIN typeacte ON typeacte.id_type = events.id_type
                                     WHERE patient.id_patient = :id_patient
                                     ORDER BY start, hour ASC');
            $listRdv->execute(array('id_patient' => $id_patient));
            return $listRdv;
        }

}