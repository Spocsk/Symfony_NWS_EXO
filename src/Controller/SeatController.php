<?php

namespace App\Controller;

use App\Entity\Seat;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeatController extends AbstractController
{
    /**
     * @Route("/new", name="seat")
     */
    public function new(Request $request): Response
    {
        // just setup a fresh $task object (remove the example data)
        $seat = new Seat();

        $form = $this->createForm(Seat::class, $seat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $seat = $form->getData();

            // fait des truc avec la bdd
            // $entityManager->persist($seat);
            // $entityManager->flush();

        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
