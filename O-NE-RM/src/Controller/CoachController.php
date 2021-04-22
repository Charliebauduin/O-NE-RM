<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Exercise;
use App\Repository\UserRepository;
use App\Repository\ExerciseRepository;
use App\Repository\ProgressRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Location;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CoachController extends AbstractController
{
    /**
     * @Route("/api/coach/user", name="coach")
     */     
    public function userList(UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        $fitnessRoom = $user->getFitnessroom();

        $userList = $userRepository->findBy(['fitnessRoom' => $fitnessRoom]);
        
        return $this->json($userList, Response::HTTP_OK, [], ['groups' => 'listUsersFitnesstRoom']);

    }

    /**
     * @Route("/api/coach/user/workout/{id}/recap", name="totototo", methods={"GET", "POST"})
     */
    public function performanceUserOfOneExercise(Exercise $exercise, ExerciseRepository $exerciseRepository, Request $request, UserRepository $userRepository)
    {

        if ($exercise == null) {

            throw $this->createNotFoundException('exercice non trouvé.');
        }

        $jsonContent = $request->getContent();

        $jsonDecoded = json_decode($jsonContent, true);

        $userId = $jsonDecoded['user_id'];

        $user = $userRepository->find($userId);

        
        $lastPerformance = $exerciseRepository->OneExerciseWithUserProgress($user, $exercise);

        if($lastPerformance == []) {

            $lastPerformance['user_id']        = $user->getId();
            $lastPerformance['ID_exercise']    = $exercise->getId();
            $lastPerformance['name']           = $exercise->getName();
            $lastPerformance['illustration']   = $exercise->getIllustration();
            $lastPerformance['advice']         = $exercise->getAdvice();
            $lastPerformance['difficulty']     = $exercise->getDifficulty();
            $lastPerformance['ID_progress']    = null;
            $lastPerformance['date']           = null;
            $lastPerformance['repetition']     = null;
            $lastPerformance['weight']         = null;

        }


        return $this->json($lastPerformance, Response::HTTP_OK, [], ['groups' => 'progressUser']);



    }    
    

     /**
     * Méthode permettant d'obtenir que la derniere performance d'un exercice en fonction de l'utilisateur
     * 
     * @Route("/api/coach/user/{id}/getLastPerformances", name="getLastPerfForUserToCoach")
     */
    public function getLastPerformances(User $user = null , ExerciseRepository $exerciseRepository)
    {

        if ($user == null) {

            throw $this->createNotFoundException('utilisateur non trouvé.');
            
        }

        //la custom query trie les objects progress par date 'DESC' du coup en evitant les doublons on s'assure de ne récuperer que la derniere performance en date

        $lastPerformancesAndGoals = $exerciseRepository->ExerciseWithUserProgressAndGoals($user);
        

        $lastPerfAndGoalToSend = [];
        $checkExerciseID = [];
        

        //Ici on boucle sur les resultats pour ne recuperer que la derniere performance en date d'un exercice pour eviter de se retrouver avec des doublons de performance
        foreach ($lastPerformancesAndGoals as $last) {

            $exerciseID = $last['ID_exercise'];

            $last['user_id'] = $user->getID();

            if (!in_array($exerciseID, $checkExerciseID)) {

                $checkExerciseID[] = $exerciseID;

                $lastPerfAndGoalToSend[] = $last;
            }

        }

        return $this->json($lastPerfAndGoalToSend, Response::HTTP_OK, [], ['groups' => 'progressUser']);


    }

    

    /**
     * Méthode qui permet de poster un commentaire sur un exercice d'un utilisateur 
     * 
     * @Route("/api/coach/user/{id}/exercise/postComment", name="addComment", methods={"POST"})
     */
    public function postComment(User $user = null, Request $request, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $entityManager)
    {

        $jsonContent = $request->getContent();

        if ($jsonContent == null || "") {

            return $this->json("le coaching ne peut pas être vide", Response::HTTP_NO_CONTENT);
        } 

        
        $comment = $serializer->deserialize($jsonContent, Comment::class, 'json');

        $comment->setUser($user);

        $error = $validator->validate($comment);

        if (count($error) > 0) {

            return $this->json('erreur mon amis', Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        $entityManager->persist($comment);

        $entityManager->flush();

        return $this->json('coaching a bien été envoyé' , Response::HTTP_CREATED);

    }
    
}

