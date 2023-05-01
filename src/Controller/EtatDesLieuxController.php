<?php

namespace App\Controller;

use Knp\Snappy\Pdf;
use App\Service\PdfService;
use App\Entity\EtatDesLieux;
use App\Form\EtatDesLieuxType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EtatDesLieuxRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;


class EtatDesLieuxController extends AbstractController
{
    #[Route('/etatdeslieux', name: 'app_etat_des_lieux')]
    public function index(EtatDesLieuxRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $etatdeslieuxs = $paginator->paginate(
            $repository->findAllbyId(),
            $request->query->getInt('page', 1), /* page number */
            20
        );

        return $this->render('etatdeslieux/EtatDesLieux.html.twig', [
            'etatdeslieuxs' => $etatdeslieuxs,
        ]);
    }

    #[Route('/etatdeslieux/new', name: 'app_etat_des_lieux_new',  methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $etatdeslieux = new EtatDesLieux();
        $form = $this->createForm(EtatDesLieuxType::class, $etatdeslieux);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $etatdeslieux = $form->getData();

            $manager->persist($etatdeslieux);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre Etat des lieux à été créée avec succès !'
            );

            return $this->redirectToRoute('app_etat_des_lieux');
        }

        return $this->render('etatdeslieux/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/etatdeslieux/edit/{id}', 'app_etat_des_lieux_edit',  methods: ['GET', 'POST'])]
    public function edit(EtatDesLieux $etatdeslieux, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(EtatDesLieuxEditType::class, $etatdeslieux);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $etatdeslieux = $form->getData();

            $manager->persist($etatdeslieux);
            $manager->flush();


            $this->addFlash(
                'success',
                'L\'état des lieux à été modifié avec succès !'
            );

            return $this->redirectToRoute('app_etat_des_lieux');
        }

        return $this->render('etatdeslieux/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/pdf/{id}', name: 'etatdeslieux.pdf')]
    public function generatePdf(Pdf $pdf, EtatDesLieux $etatdeslieux)
    {
        $html = $this->renderView('etatdeslieux/EDLTemplate.html.twig', [
            'etatdeslieux' => $etatdeslieux,
            "title" => "etat des lieux {$etatdeslieux->getId()}",
        ]);

        $filename =  "etat des lieux {$etatdeslieux->getId()}";

        return new Response(
            $pdf->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '".pdf"'
            ]
        );
    }

    #[Route('/etatdeslieux/delete/{id}', 'app_etat_des_lieux_delete',  methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, EtatDesLieux $etatdeslieux): Response
    {
        $manager->remove($etatdeslieux);
        $manager->flush();


        $this->addFlash(
            'success',
            'L\'état des lieux à été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_etat_des_lieux');
    }
}
