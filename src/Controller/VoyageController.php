<?php
// src/Controller/VoyageController.php
namespace App\Controller;

use App\Entity\Voyage;
use App\Form\VoyageType;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/voyage')]
class VoyageController extends AbstractController
{
#[Route('/', name: 'app_voyage_index', methods: ['GET'])]
public function index(VoyageRepository $voyageRepository): Response
{
$voyages = $voyageRepository->findBy([], ['id' => 'DESC']);

return $this->render('voyage/index.html.twig', [
'voyages' => $voyages,
]);
}

#[Route('/new', name: 'app_voyage_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $em): Response
{
$voyage = new Voyage();
$form = $this->createForm(VoyageType::class, $voyage);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
$em->persist($voyage);
$em->flush();

$this->addFlash('success', 'Voyage créé !');

return $this->redirectToRoute('app_voyage_index');
}

return $this->render('voyage/new.html.twig', [
'voyage' => $voyage,
'form' => $form->createView(),
]);
}

#[Route('/{id}', name: 'app_voyage_show', methods: ['GET'])]
public function show(Voyage $voyage): Response
{
return $this->render('voyage/show.html.twig', [
'voyage' => $voyage,
]);
}

#[Route('/{id}/edit', name: 'app_voyage_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Voyage $voyage, EntityManagerInterface $em): Response
{
$form = $this->createForm(VoyageType::class, $voyage);
$form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
$em->flush();

$this->addFlash('success', 'Voyage mis à jour !');

return $this->redirectToRoute('app_voyage_index');
}

return $this->render('voyage/edit.html.twig', [
'voyage' => $voyage,
'form' => $form->createView(),
]);
}

#[Route('/{id}/delete', name: 'app_voyage_delete', methods: ['POST'])]
public function delete(Request $request, Voyage $voyage, EntityManagerInterface $em): Response
{
if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
$em->remove($voyage);
$em->flush();

$this->addFlash('success', 'Voyage supprimé !');
}

return $this->redirectToRoute('app_voyage_index');
}
}
