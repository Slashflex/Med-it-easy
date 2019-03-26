<?php
// --- CLASS LOADING
namespace Projet\app\controller;

use \Projet\app\model\EventManager;
use \Projet\app\model\PatientManager;
use \Projet\app\model\PraticienManager;
use \Projet\app\model\Manager;
use \Exception;

// --- CLASS MANAGING EVENTS
class EventController
{
    private $eventManager;

    public function __construct()
    {
        // Creating class instance (object)
        $this->eventManager = new EventManager;
    }
// --- ADD EVENTS
    public function addEvent($id_event, $start, $id_type, $id_patient)
    {
        // Convert special characters to HTML entities
        $title = htmlspecialchars($_POST['id_event']);
        $start = htmlspecialchars($_POST['start']);
        $type = htmlspecialchars($_POST['id_type']);
        $id = htmlspecialchars($_POST['id_patient']);
        $this->eventManager = new EventManager;
        $event = $eventManager->addEvents($title, $start, $type, $id);
    }
// --- FORMAT BOOKING FORM's FIELDS INTO STRING EXPECTED BY FULL CALENDAR PLUGIN   
    private function convert($events)
    {
        $formatedEvents = [];
        foreach ($events as $event) {
            $formatedEvent['id'] = $event['id_event'];
            $formatedEvent['title'] = ucfirst($event['patientNom']) . ' ' . ucfirst($event['patientPrenom']) . ' ' . 'Motif : ' . ucfirst($event['description']);
            $formatedEvent['start'] = $event['start'] . ' ' . $event['hour'];
            $dateSrc = strtotime($formatedEvent['start']);
            $interval = 30 * 60;
            $formatedEvent['end'] = date("Y-m-d H:i:s", $dateSrc + $interval);
            $formatedEvent['color'] = $event['couleur'];
            $formatedEvents[] = $formatedEvent;
        }
        return json_encode($formatedEvents);
    }
    // // TO DO ...
    public function getPatientRdv($id_praticien)
    {
        $save = $this->eventManager->getEvents($id_praticien);
        $events = $this->convert($save);
        echo $events;
    }

// --- RETRIEVE EVENTS BOUND TO "THIS" PATIENT (to update event's hour and date)
    public function getPatientIdEvent($id)
    {
        $req = $this->eventManager->get_Id_Event($id);
        require('app/views/praticiens/updateRdv.php');
    }       
}
