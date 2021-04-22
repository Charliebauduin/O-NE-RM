<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Repository\UserRepository;
use App\Repository\ExerciseRepository;
use App\Repository\FitnessRoomRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function Home(): Response
    {
        return $this->redirectToRoute('app_login');
    }

    /**
     * Méthode renvoyant la liste des salles de sport pour le select du formulaire d'inscription
     *
     * @Route("/getFitnessRoomList", name="getFitnessRoomList")
     */
    public function fitnessRoomList(FitnessRoomRepository $fitnessRoomRepository) {

        $fitnessRoomList = $fitnessRoomRepository->findAll();

        return $this->json($fitnessRoomList, Response::HTTP_OK, [], ['groups' => 'fitnessRoom_get']);

    }


}
