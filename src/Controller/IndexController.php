<?php

namespace App\Controller;

use App\Entity\Bookings;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\EntityManagerInterface;

class IndexController extends AbstractController {
    public function index() {
        return $this->render('main.html.twig');
    }

    /**
     * @Route("/bookings/create")
     */
    public function create(EntityManagerInterface $em)
    {
        $booking = new Bookings();
        $booking->setFirstName('Meelis');
        $booking->setLastName('Leelis');
        $booking->setPhone('55555555');
        $booking->setEmail('meelis.leelis@test.ee');
        $booking->setBirthdate(new \DateTime('1990-01-01'));
        $booking->setStartDate(new \DateTime('2019-11-05'));
        $booking->setEndDate(new \DateTime('2019-11-30'));
        $booking->setArrivalTime(new \DateTime('15:00'));
        $booking->setNumberOfPeople(2);
        $booking->setAdditionaInformation('lisainfo');
        $booking->setPayingMethod('cash');
        $em->persist($booking);
        $em->flush();
        return new Response(
            '<html><body><h1>'.$booking->getFirstName().' '.$booking->getLastName().', booking data is saved.</h1></body></html>'
        );
    }
}
