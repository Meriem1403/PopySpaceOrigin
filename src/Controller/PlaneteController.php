<?php

namespace App\Controller;

use App\Entity\Planete;
use App\Form\PlaneteType;
use App\Repository\PlaneteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/planet')]
class PlaneteController extends AbstractController
{
    #[Route('/', name: 'app_planet_index', methods: ['GET'])]
    public function index(PlaneteRepository $planetRepository): Response
    {
        return $this->render('planete/index.html.twig', [
            'planets' => $planetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_planet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $planet = new Planete();
        $form = $this->createForm(PlaneteType::class, $planet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($planet);
            $entityManager->flush();

            $this->addFlash('success', 'Planète ajoutée avec succès.');

            return $this->redirectToRoute('app_planet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planete/new.html.twig', [
            'planet' => $planet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planet_show', methods: ['GET'])]
    public function show(Planete $planet): Response
    {
        return $this->render('planete/show.html.twig', [
            'planet' => $planet,
        ]);
    }

    #[Route('/{id}/card', name: 'app_planet_show_card', methods: ['GET'])]
    public function showCard(Planete $planet): Response
    {
        return $this->render('planete/_card.html.twig', [
            'planet' => $planet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_planet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Planete $planet, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlaneteType::class, $planet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Planète mise à jour.');

            return $this->redirectToRoute('app_planet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('planete/edit.html.twig', [
            'planet' => $planet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_planet_delete', methods: ['POST'])]
    public function delete(Request $request, Planete $planet, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planet->getId(), $request->request->get('_token'))) {
            $entityManager->remove($planet);
            $entityManager->flush();

            $this->addFlash('success', 'Planète supprimée.');
        }

        return $this->redirectToRoute('app_planet_index', [], Response::HTTP_SEE_OTHER);
    }
}
