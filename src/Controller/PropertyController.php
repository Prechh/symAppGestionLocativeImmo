<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    #[Route('/property', name: 'app_property',  methods: ['GET'])]
    public function index(PropertyRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $propertys = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10
        );

        return $this->render('property/property.html.twig', [
            'propertys' => $propertys
        ]);
    }
}
