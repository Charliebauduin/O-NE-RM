<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManagerController extends AbstractController
{
    /**
     * 
     * Méthode qui permet de gérer les demandes d'ouvertures de salle = création d'une salle en BDD.
     *
     * @Route("api/manager/newFitnessroom", name="roomrequest", methods={"POST","PUT","PATCH"})
     * 
     */
    public function newFitnessRoom(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $entityManager): Response
    {

        $jsonContent = $request->getContent();

        $fitnessRoom = $serializer->deserialize($jsonContent, FitnessRoom::class, 'json');

        //  On valide l'entité désérialisée
        $errors = $validator->validate($fitnessRoom);

        // Si nombre d'erreur > 0 alors on renvoie une erreur
        if (count($errors) > 0) {
            // On retourne le tableau d'erreurs en Json au front avec un status code 422
            return $this->json('Salle non créée', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // On persiste les données
        $entityManager->persist($fitnessRoom);
        // On flush pour enregistrer en BDD
        $entityManager->flush($fitnessRoom);
        // REST nous dit : status 201 + Location: movies/{id}
        return $this->json(['message' => 'La Salle a été crée'], Response::HTTP_CREATED);

    }

    /**
     * Liste des membres par salle de sport
     *
     * @Route("/api/manager", name="allusers")
     *
     */
    public function userList(UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        $fitnessRoom = $user->getFitnessroom();

        $userList = $userRepository->findBy(['fitnessRoom' => $fitnessRoom]);
        
        return $this->json($userList, Response::HTTP_OK, [], ['groups' => 'listUsersFitnesstRoom']);
    }
    

    /**
     * Méthode permettant de modifier les informations d'un membre
     *
     * @Route("/api/manager/user/{id}/edit", name="user_edit", methods={"PATCH"})
     */
    public function edit(User $user = null, EntityManagerInterface $entityManager, SerializerInterface $serializer, Request $request, ValidatorInterface $validator): Response
    {

        if ($user == null) {

            throw $this->createNotFoundException('utilisateur non trouvé.');
        }

        $jsonContent = $request->getContent();

        $object = $serializer->deserialize($jsonContent, User::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $user] );

        $error = $validator->validate($user);

        if (count($error) > 0) {

            return $this->json('Erreur', Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        $entityManager->flush();

        return $this->json(['message' => 'Informations utilisateur modifiées.'], Response::HTTP_OK);
        

    }

    /**
     * Suppression d'un membre
     * 
     * @Route("api/manager/user/{id}/delete", name="delete_user", methods = {"DELETE"})
     *
     */
    public function userDelete(User $user = null, EntityManagerInterface $entityManager): Response
    {

        if ($user == null) {

            throw $this->createNotFoundException('utilisateur non trouvé.');
        }

        $entityManager->remove($user);

        $entityManager->flush();
        
        return $this->json(['message' => 'Membre supprimé'], Response::HTTP_OK);

    }


}