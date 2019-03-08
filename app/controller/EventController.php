<?php
// Loading classes
namespace Projet\app\controller;

use \Projet\app\model\EventManager;
use \Projet\app\model\PatientManager;
use \Projet\app\model\PraticienManager;
use \Projet\app\model\Manager;
use \Exception;

class EventController
{
    private $eventManager;

    public function __construct()
    {
        // Creating class instance (object)
        $this->eventManager = new EventManager;
    }
    public function addEvent($id_event, $start, $id_type, $id_patient)
    {
        $title = htmlspecialchars($_POST['id_event']);
        $start = htmlspecialchars($_POST['start']);
        $type = htmlspecialchars($_POST['id_type']);
        $id = htmlspecialchars($_POST['id_patient']);
        $this->eventManager = new EventManager;
        $event = $eventManager->addEvents($title, $start, $type, $id);
    }
    // TO DO ...
    public function getPatientRdv()
    {
        $save = $this->eventManager->getEvents();
        $events = $this->convert($save);
        echo $events;
    }
    private function convert($events)
    {
        $formatedEvents = [];
        foreach ($events as $event) {
            $formatedEvent['title'] = $event['patientNom'] . ' ' . $event['patientPrenom'] . ' ' . $event['description'];
            $formatedEvent['start'] = $event['start'] . ' ' . $event['hour'];
            $dateSrc = strtotime($formatedEvent['start']);
            $interval = 30 * 60;
            $formatedEvent['end'] = date("Y-m-d H:i:s", $dateSrc + $interval);
            $formatedEvent['color'] = $event['couleur'];
            $formatedEvents[] = $formatedEvent;
        }
        return json_encode($formatedEvents);
    }
}
