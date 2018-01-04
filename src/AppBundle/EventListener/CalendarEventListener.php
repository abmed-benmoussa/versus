<?php

namespace AppBundle\EventListener;

use ADesigns\CalendarBundle\Event\CalendarEvent;
use ADesigns\CalendarBundle\Entity\EventEntity;
use BackendBundle\Entity\Torneos;
use Doctrine\ORM\EntityManager;

class CalendarEventListener
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
      $this->entityManager = $entityManager;
    }


    public function loadData(CalendarEvent $calendarEvent)
    {

      //print "entra";exit;

      
        // You can retrieve information from the event dispatcher (eg, You may want which day was selected in the calendar):
        // $startDate = $calendarEvent->getStart();
        // $endDate = $calendarEvent->getEnd();
        // $filters = $calendarEvent->getFilters();

        // You may want do a custom query to populate the events
        // $currentEvents = $repository->findByStartDate($startDate);
        $repository = $this->em->getRepository('BackendBundle:Torneos');
        $torneos = $repository->findAll();

        dump($torneos); die();

        // You may want to add an Event into the Calendar view.
        /** @var Torneos $torneo */
        foreach ($torneos as $torneo) {
            $calendarEvent->addEvent(new Event($torneo->getNombre(), $torneo->getFechaInicio()));


        }
    }
}
