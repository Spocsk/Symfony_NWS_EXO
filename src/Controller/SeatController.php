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
     * @Route("/", name="seat")
     */
    public function new(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        $seat = new Seat();

        $form = $this->createFormBuilder($seat)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Valider'])
            ->getForm();

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
