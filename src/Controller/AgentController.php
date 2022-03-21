<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("agent/user")
 */
class AgentController extends AbstractController
{
    /**
     * @Route("/", name="agent_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        if ($this->getUser()) {
            $user = $this->getUser(); // Get login User data
            if ($user->getRoles()[0] == 'ROLE_ADMIN') {
                return $this->render('agents/index.html.twig'
                , [
                    'users' => $userRepository->findAll(),
                    'roles'=> $userRepository->findAll()
                ]);
            } else {
                return $this->redirectToRoute('home');
            }
        }
       
    }
}
