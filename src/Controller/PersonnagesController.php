<?php

namespace App\Controller;

use App\Entity\Personnages;
use App\Form\PersonnagesType;
use App\Repository\PersonnagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/personnages')]
class PersonnagesController extends AbstractController
{
    #[Route('/', name: 'personnagesIndex', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $this->getDoctrine()->getRepository(Personnages::class)->findBy([],['Nom' => 'asc']);

        $personnages = $paginator->paginate(
            $donnees, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );
        
        return $this->render('personnages/index.html.twig', [
            'personnages' => $personnages,
        ]);
    }

    #[Route('/new', name: 'app_personnages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PersonnagesRepository $personnagesRepository): Response
    {
        $personnage = new Personnages();
        $form = $this->createForm(PersonnagesType::class, $personnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnagesRepository->add($personnage);
            return $this->redirectToRoute('app_personnages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personnages/new.html.twig', [
            'personnage' => $personnage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personnages_show', methods: ['GET'])]
    public function show(Personnages $personnage): Response
    {
        return $this->render('personnages/show.html.twig', [
            'personnage' => $personnage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_personnages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Personnages $personnage, PersonnagesRepository $personnagesRepository): Response
    {
        $form = $this->createForm(PersonnagesType::class, $personnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personnagesRepository->add($personnage);
            return $this->redirectToRoute('app_personnages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personnages/edit.html.twig', [
            'personnage' => $personnage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personnages_delete', methods: ['POST'])]
    public function delete(Request $request, Personnages $personnage, PersonnagesRepository $personnagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnage->getId(), $request->request->get('_token'))) {
            $personnagesRepository->remove($personnage);
        }

        return $this->redirectToRoute('app_personnages_index', [], Response::HTTP_SEE_OTHER);
    }

    
}
