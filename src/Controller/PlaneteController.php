<?php

namespace App\Controller;

use App\Entity\Planete;
use App\Form\PlaneteType;
use App\Repository\PlaneteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/planete')]
class PlaneteController extends AbstractController
{
    #[Route('/', name: 'app_planete_index', methods: ['GET'])]
    public function index(PlaneteRepository $planeteRepository): Response
    {
        return $this->render('planete/index.html.twig', [
            'planetes' => $planeteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_planete_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $planete = new Planete();
        $form = $this->createForm(PlaneteType::class, $planete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($planete);
            $em->flush();

            $this->addFlash('success', 'Planète créée !');

            return $this->redirectToRoute('app_planete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planete/new.html.twig', [
            'planete' => $planete,
            'form'    => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_planete_show', methods: ['GET'])]
    public function show(Planete $planete): Response
    {
        return $this->render('planete/show.html.twig', [
            'planete' => $planete,
        ]);
    }

    #[Route('/{id}/card', name: 'app_planete_show_card', methods: ['GET'])]
    public function showCard(Planete $planete): Response
    {
        return $this->render('planete/_card.html.twig', [
            'planete' => $planete,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_planete_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Planete $planete, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PlaneteType::class, $planete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Planète modifiée !');

            return $this->redirectToRoute('app_planete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planete/edit.html.twig', [
            'planete' => $planete,
            'form'    => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_planete_delete', methods: ['POST'])]
    public function delete(Request $request, Planete $planete, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planete->getId(), $request->request->get('_token'))) {
            $em->remove($planete);
            $em->flush();

            $this->addFlash('success', 'Planète supprimée !');
        }

        return $this->redirectToRoute('app_planete_index', [], Response::HTTP_SEE_OTHER);
    }
}
