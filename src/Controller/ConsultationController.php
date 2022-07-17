<?php

namespace App\Controller;

use App\Entity\Consultation;
use App\Form\ConsultationType;
use App\Form\ConsultationChoiceType;
use App\Repository\ConsultationRepository;
use App\Repository\SickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/consultation')]
class ConsultationController extends AbstractController
{
    #[Route('/', name: 'app_consultation_index', methods: ['GET'])]
    public function index(ConsultationRepository $consultationRepository): Response
    {
        return $this->render('consultation/index.html.twig', [
            'consultations' => $consultationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_consultation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConsultationRepository $consultationRepository): Response
    {
        $consultation = new Consultation();

        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $consultationRepository->add($consultation, $sick);
            return $this->redirectToRoute('app_consultation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('consultation/new.html.twig', [
            'consultation' => $consultation,
            'form' => $form,

        ]);
    }

    #[Route('/{sickId}/consultation_choice', name: 'consultation_choice', methods: ['GET', 'POST'])]
    public function ConsultationChoice(Request $request, SickRepository $sickRepository): Response
    {
        //$consultation = new Consultation();
        $sickId = $request->get('sickId');
        $sick = $sickRepository->find($sickId);
        $form = $this->createForm(ConsultationChoiceType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //  $consultationRepository->add($consultation, $sick);
            $type = $form->get('type')->getData();
            return $this->redirectToRoute('consultation_new', ['type'=>$type,'sickId'=>$sickId], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('consultation/choice.html.twig', [
            'form' => $form,
            'sick' => $sick,
        ]);
    }

    #[Route('/{sickId}/{type}/new', name: 'consultation_new', methods: ['GET', 'POST'])]
    public function newConsultation(Request $request, ConsultationRepository $consultationRepository, SickRepository $sickRepository): Response
    {
        $consultation = new Consultation();
        $sickId = $request->get('sickId');
        $type = $request->get('type');
        $consultation->setType($type);
        $sick = $sickRepository->find($sickId);
        $form = $this->createForm(ConsultationType::class, $consultation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $consultationRepository->add($consultation, $sick);
            return $this->redirectToRoute('app_consultation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('consultation/new.html.twig', [
            'consultation' => $consultation,
            'form' => $form,
            'sick' => $sick,
        ]);
    }

    #[Route('/{id}', name: 'app_consultation_show', methods: ['GET'])]
    public function show(Consultation $consultation): Response
    {
        return $this->render('consultation/show.html.twig', [
            'consultation' => $consultation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_consultation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Consultation $consultation, ConsultationRepository $consultationRepository): Response
    {
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($request);
        $sick = $consultation->getSick();
        if ($form->isSubmitted() && $form->isValid()) {
            $consultationRepository->add($consultation, $sick);
            return $this->redirectToRoute('app_consultation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('consultation/edit.html.twig', [
            'consultation' => $consultation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_consultation_delete', methods: ['POST'])]
    public function delete(Request $request, Consultation $consultation, ConsultationRepository $consultationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$consultation->getId(), $request->request->get('_token'))) {
            $consultationRepository->remove($consultation);
        }

        return $this->redirectToRoute('app_consultation_index', [], Response::HTTP_SEE_OTHER);
    }
}
