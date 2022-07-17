<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Security;

/**
* Require IS_AUTHENTICATED_FULLY only for this class
*
* @IsGranted("IS_AUTHENTICATED_FULLY")
*/
#[Route('/user')]
class UserController extends AbstractController
{
    /**
* Require ROLE_ADMIN only for this action
*
* @IsGranted("ROLE_ADMIN")
*/
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    /**
* Require ROLE_ADMIN only for this action
*
* @IsGranted("ROLE_ADMIN")
*/
    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, ): Response
    {
        $user = new User();
        $getPathinfo=$request->getPathinfo();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $userRepository->add($user);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user, Request $request, Security $security): Response
    {
        $requestId = $request->get('id');
        $userId = strval($this->container->get('security.token_storage')->getToken()->getUser()->getId());
        //var_dump($userId);
        //exit;

        if ($requestId === $userId) {
            return $this->render('user/show.html.twig', [
              'user' => $user,
              ]);
        }

        if ($security->IsGranted('ROLE_ADMIN')) {
            return $this->render('user/show.html.twig', [
            'user' => $user,
            ]);
        }
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        User $user,
        UserRepository $userRepository,
        Security $security
    ): Response {
        $requestId = $request->get('id');
        $userId = strval($this->container->get('security.token_storage')->getToken()->getUser()->getId());

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            $data = $form->getData(); // we fetch all data from the form
            $id = $data->getId();     // we fetch the id value in the form
            return $this->redirectToRoute('app_user_show', ['id' =>  $id], Response::HTTP_SEE_OTHER);
        }
        if ($requestId === $userId) {
            return $this->renderForm('user/edit.html.twig', [
              'user' => $user,
              'form' => $form,
          ]);
        }
        if ($security->IsGranted('ROLE_ADMIN')) {
            return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
        }
    }
    /*
    * Require ROLE_ADMIN only for this action
    *
    * @IsGranted("ROLE_ADMIN")
    */
    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
