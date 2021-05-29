<?php

namespace App\Controller;

use App\Entity\Seat;
use App\Repository\SeatRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SeatController extends AbstractController
{

    /**
     * @var SeatRepository
     */
    private SeatRepository $seatRepository;
    /**
     * @var NormalizerInterface
     */
    private NormalizerInterface $normalizer;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(SeatRepository $seatRepository,
                                NormalizerInterface $normalizer,
                                EntityManagerInterface $em)
    {
        $this->seatRepository = $seatRepository;
        $this->normalizer = $normalizer;
        $this->em = $em;
    }


    #[Route('/seat', name: 'seat')]
    public function show(): Response
    {
        $seat = $this->seatRepository->findAll();
        $seatNormalize = $this->normalizer->normalize($seat);

        return $this->render('seat/index.html.twig', [
            'seat_data' => $seatNormalize,
        ]);
    }

    #[Route('/seat/{id}/edit', name: 'edit')]
    public function modify(Seat $seat, Request $request) {

        $form = $this->createFormBuilder($seat)
            ->add("occupant")
            ->add('Enregistrer', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $seat->setUpdatedAt(new DateTime());
            $this->em->persist($seat);
            $this->em->flush();

            return $this->redirectToRoute("seat");
        }


        return $this->render('seat/form.html.twig', [
            'formSeat' => $form->createView(),
        ]);

    }
}
