<?php

namespace App\Controller\Admin;

use App\Entity\Calendar;
use App\Entity\User;
use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class CalendarController extends AbstractController
{
    /**
     * @Route("/admin/calendar", name="app_calendar")
     */
    public function index(CalendarRepository $calendar)
    {
        $events= $calendar->findAll();
        $rdvs=[];
        foreach ($events as $event ) {

           $rdvs[] =[
               'id'=>$event->getId(),
               'start'=>$event->getStart()->format('Y-m-d H:i:s'),
               'end'=>$event->getEnd()->format('Y-m-d H:i:s'),
               'title'=>$event->getTitle(),
               'description'=>$event->getDescription(),
               'backgroundColor'=>$event->getBackgroundColor(),
               'borderColor'=>$event->getBorderColor(),
               'textColor'=>$event->getTextColor()

           ] ;
        }
        $data = json_encode($rdvs);
        return $this->render('admin/calendar/index.html.twig', compact('data'));
    
    }
}
