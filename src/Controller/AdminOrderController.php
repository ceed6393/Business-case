<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/order")]
class AdminOrderController extends AbstractController
{
    #[Route('/', name: 'app_admin_order')]
    public function index(OrderRepository $orderRepository): Response
    {
        return $this->render('admin_order/index.html.twig', [
            'orders' => $orderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_order_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $order = new Order();
        $form=$this->createForm(OrderType::class, $order);
        $form-> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($order);
            $em->flush();
            return new RedirectResponse($this->generateUrl('app_admin_order'));

        }


        return $this->render('admin_order/new.html.twig', [
            'orders' => $order,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/edit/{id}', name: 'app_admin_order_edit')]
    public function edit(Order $order, Request $request, EntityManagerInterface $em)
    {
        
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return new RedirectResponse($this->generateUrl("app_admin_order"));
        }

        return $this->render('admin_order/edit.html.twig', [
            'form' => $form->createView(),
            'orders' => $order
        ]);
    }
    #[Route('/delete/{id}', name: 'app_admin_order_delete')]
    public function delete(Order $order, Request $request, EntityManagerInterface $em)
    {$request;

        $em->remove($order);
        $em->flush();

        return new RedirectResponse($this->generateUrl("app_admin_order"));

    }
    #[Route('/show/{id}', name: 'app_admin_order_show')]
    public function detail(Order $order): Response
    {

        return $this->render('admin_order/show.html.twig', [
            'order' => $order
        ]);
    }
}
