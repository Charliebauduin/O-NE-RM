<?php

namespace App\Controller;

use App\Repository\ExerciseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorkoutController extends AbstractController
{
    /**
     * @Route("/workout", name="workout")
     */
    public function WorkoutList(ExerciseRepository $exerciseRepository): Response
    {
        //"TODO.."

        // Etape 1 : recuperer les workout présents en BDD
        $workout = $exerciseRepository->findAll();

        // Etape 2 : retourner les données en JSON
        return $this->json($workout, Response::HTTP_OK, [], ['groups' => 'workout_get']);
    }
}
