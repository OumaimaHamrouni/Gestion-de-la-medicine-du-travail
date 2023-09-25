<?php

namespace App\EventSubscriber;

use App\Entity\Enquette;

use App\Repository\EnquetteRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $enquetteRepository;
    private $router;

    public function __construct(
        EnquetteRepository $enquetteRepository,
        UrlGeneratorInterface $router
    ) {
        $this->enquetteRepository = $enquetteRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change booking.beginAt by your start date property
        $enquette= $this->enquetteRepository
            ->createQueryBuilder('enquette')
            ->where('enquette.date_arret BETWEEN :start and :end OR enquette.date_prevue BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;
        $date= gettimeofday();
        foreach ($enquette as $enquette) {
           // this create the events with your data (here booking data) to fill calendar
            $enquetteEvent = new Event(
                $enquette->getIdS()->getNom(),

                $enquette->getDateArret(),
                $enquette->getDatePrevue() // If the end date is null or not defined, a all day event is created.
            );


            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $enquetteEvent->setOptions([
                'backgroundColor' => '#b785a7',
                'borderColor' => 'theme02',
            ]);
            $enquetteEvent->addOption(
                'url',
                $this->router->generate('enquette_show', [
                    'id' => $enquette->getId(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($enquetteEvent);
        }
    }
}