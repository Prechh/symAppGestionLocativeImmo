<?php

namespace App\Controller;

use Knp\Snappy\Pdf;
use App\Entity\Tenant;
use App\Entity\Payments;
use App\Form\TenantType;
use App\Repository\TenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PHPUnit\Framework\Test;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TenantController extends AbstractController
{
    #[Route('/tenant', name: 'app_tenant',  methods: ['GET'])]
    public function index(TenantRepository $repository, PaginatorInterface $paginator,  Request $request): Response
    {
        $tenants = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10
        );

        return $this->render('tenant/tenant.html.twig', [
            'tenants' => $tenants
        ]);
    }

    #[Route('/tenant/new', name: 'app_tenant_new',  methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $tenant = new Tenant();
        $form = $this->createForm(TenantType::class, $tenant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tenant = $form->getData();

            $manager->persist($tenant);
            $manager->flush();

            $this->addFlash(
                'success',
                'Le locataire à été ajoutée avec succès !'
            );

            return $this->redirectToRoute('app_tenant');
        }

        return $this->render('tenant/newTenant.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/tenant/edit/{id}', 'app_tenant_edit',  methods: ['GET', 'POST'])]
    public function edit(Tenant $tenant, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(TenantType::class, $tenant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tenant = $form->getData();

            $manager->persist($tenant);
            $manager->flush();

            $this->addFlash(
                'success',
                'Le locataire à été modifié avec succès !'
            );

            return $this->redirectToRoute('app_tenant');
        }

        return $this->render('tenant/editTenant.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/tenant/delete/{id}', 'app_tenant_delete',  methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Tenant $tenant): Response
    {
        $manager->remove($tenant);
        $manager->flush();


        $this->addFlash(
            'success',
            'Le locataire à été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_tenant');
    }



    /*  #[Route('/pdf/{id}', name: 'bilancompte.pdf')]
    public function generatePdf(Pdf $pdf, Tenant $tenant, Payments $payments)
    {

        $html = $this->renderView('tenant/BilanCompteTemplate.html.twig', [
            '$tenant' => $tenant,
            "title" => "BilanCompte {$tenant->getId()}",
        ]);

        $filename =  "BilanCompte {$tenant->getId()}";

        return new Response(
            $pdf->getOutputFromHtml($html),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '".pdf"'
            ]
        );
    }*/
}
