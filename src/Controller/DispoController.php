<?php

namespace App\Controller;

use App\Entity\Dispo;
use App\Form\DispoType;
use App\Repository\DispoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dispo')]
class DispoController extends AbstractController
{
    #[Route('/search', name: 'app_dispo_search', methods:['GET', 'POST'])]
    public function search(Request $request, EntityManagerInterface $em,DispoRepository $dr):Response
    {
        $dateDebut = $request->get('debut');
        $dateFin = $request->get('fin');
        $prixMax = $request->get('prix');

       // dd($dateDebut);

        $dispos = $dr->searchDispo($dateDebut, $dateFin, $prixMax);
       
       //dd($dispos);
        $rows = [];

        foreach ($dispos as $dispo)
        {
            $rows[]=[
                'photo'=>$dispo->getVehicule()->getImage(),
                'prix'=>$dispo->getPrixParJour(),
                'marque'=>$dispo->getVehicule()->getMarque(),
                'modele'=>$dispo->getVehicule()->getModele(),
                'dateDebut'=>$dispo->getDateDebut()->format('d/m/Y'),
                'dateFin'=>$dispo->getDateFin()->format('d/m/Y'),
                'show_dispo_url'=>$this->generateUrl('app_dispo_show', ['id'=> $dispo->getId()]),
                'edit_dispo_url'=>$this->generateUrl('app_dispo_edit', ['id'=> $dispo->getId()])
            ];
        }

        return $this->json($rows);
    }

    #[Route('/', name: 'app_dispo_index', methods: ['GET'])]
    public function index(DispoRepository $dispoRepository): Response
    {
        return $this->render('dispo/index.html.twig', [
            'dispos' => $dispoRepository->findBy(["statut"=>"Disponible"]),
        ]);
    }

    #[Route('/new', name: 'app_dispo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dispo = new Dispo();
        $form = $this->createForm(DispoType::class, $dispo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dispo);
            $entityManager->flush();

            return $this->redirectToRoute('app_dispo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dispo/new.html.twig', [
            'dispo' => $dispo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dispo_show', methods: ['GET'])]
    public function show(Dispo $dispo): Response
    {
        return $this->render('dispo/show.html.twig', [
            'dispo' => $dispo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dispo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dispo $dispo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DispoType::class, $dispo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dispo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dispo/edit.html.twig', [
            'dispo' => $dispo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dispo_delete', methods: ['POST'])]
    public function delete(Request $request, Dispo $dispo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dispo->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($dispo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dispo_index', [], Response::HTTP_SEE_OTHER);
    }
}