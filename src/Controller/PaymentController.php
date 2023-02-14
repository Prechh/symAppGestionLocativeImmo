<?php

namespace App\Controller;

use App\Entity\Payments;
use App\Form\PaymentType;
use App\Repository\PaymentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment', methods: ['GET'])]
    public function index(PaginatorInterface $paginator, PaymentsRepository $repository, Request $request): Response
    {
        $payments = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            10
        );

        return $this->render('payment/payment.html.twig', [
            'payments' => $payments
        ]);
    }

    #[Route('/payment/new', name: 'app_payment_new',  methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $payment = new Payments();
        $form = $this->createForm(PaymentType::class, $payment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $payment = $form->getData();

            $manager->persist($payment);
            $manager->flush();

            $this->addFlash(
                'success',
                'Le paiment à été ajoutée avec succès !'
            );

            return $this->redirectToRoute('app_payment');
        }

        return $this->render('payment/newPayment.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/payment/edit/{id}', 'app_payment_edit',  methods: ['GET', 'POST'])]
    public function edit(Payments $payment, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(PaymentType::class, $payment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $payment = $form->getData();

            $manager->persist($payment);
            $manager->flush();

            $this->addFlash(
                'success',
                'Le paiment à été modifié avec succès !'
            );

            return $this->redirectToRoute('app_payment');
        }

        return $this->render('payment/editPayment.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/payment/delete/{id}', 'app_payment_delete',  methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Payments $payment): Response
    {
        $manager->remove($payment);
        $manager->flush();


        $this->addFlash(
            'success',
            'Le paiment à été supprimé avec succès !'
        );

        return $this->redirectToRoute('app_payment');
    }
}
