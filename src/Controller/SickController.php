<?php

namespace App\Controller;

use App\Entity\Sick;
use App\Form\SickType;
use App\Repository\SickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sick')]
class SickController extends AbstractController
{
    #[Route('/', name: 'app_sick_index', methods: ['GET'])]
    public function index(SickRepository $sickRepository): Response
    {
        return $this->render('sick/index.html.twig', [
            'sicks' => $sickRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sick_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SickRepository $sickRepository): Response
    {
        $sick = new Sick();


        $form = $this->createForm(SickType::class, $sick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sickRepository->add($sick);
            return $this->redirectToRoute('app_sick_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sick/new.html.twig', [
            'sick' => $sick,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sick_show', methods: ['GET'])]
    public function show(Sick $sick): Response
    {
        return $this->render('sick/show.html.twig', [
            'sick' => $sick,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sick_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sick $sick, SickRepository $sickRepository): Response
    {
        $form = $this->createForm(SickType::class, $sick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sickRepository->add($sick);
            return $this->redirectToRoute('app_sick_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sick/edit.html.twig', [
            'sick' => $sick,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sick_delete', methods: ['POST'])]
    public function delete(Request $request, Sick $sick, SickRepository $sickRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sick->getId(), $request->request->get('_token'))) {
            $sickRepository->remove($sick);
        }

        return $this->redirectToRoute('app_sick_index', [], Response::HTTP_SEE_OTHER);
    }
}
