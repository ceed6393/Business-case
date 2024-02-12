<?php

namespace App\Controller;

use App\Entity\Prestations;
use App\Form\PrestationsType;
use App\Repository\PrestationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/admin/prestation")]
class AdminPrestationController extends AbstractController
{
    #[Route('/', name: 'app_admin_prestation')]
    public function index(PrestationsRepository $prestationsRepository): Response
    {
        return $this->render('admin_prestation/index.html.twig', [
            'prestation' => $prestationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_prestation_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $prestation = new Prestations();
        $form=$this->createForm(PrestationsType::class, $prestation);
        $form-> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($prestation);
            $em->flush();
            return new RedirectResponse($this->generateUrl('app_admin_prestation'));

        }


        return $this->render('admin_prestation/new.html.twig', [
            'prestations' => $prestation,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/edit/{id}', name: 'app_admin_prestation_edit')]
    public function edit(Prestations $prestation, Request $request, EntityManagerInterface $em)
    {
        
        $form = $this->createForm(PrestationsType::class, $prestation);

        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return new RedirectResponse($this->generateUrl("app_admin_prestation"));
        }

        return $this->render('admin_prestation/edit.html.twig', [
            'form' => $form->createView(),
            'prestations' => $prestation
        ]);
    }
    #[Route('/delete/{id}', name: 'app_admin_prestation_delete')]
    public function delete(Prestations $prestation, Request $request, EntityManagerInterface $em)
    {$request;

        $em->remove($prestation);
        $em->flush();

        return new RedirectResponse($this->generateUrl("app_admin_prestation"));

    }
    #[Route('/show/{id}', name: 'app_admin_prestation_show')]
    public function detail(Prestations $prestation): Response
    {

        return $this->render('admin_prestation/show.html.twig', [
            'prestation' => $prestation
        ]);
    }
}
