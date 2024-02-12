<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route("/admin/product")]
class AdminProductController extends AbstractController
{
    #[Route('/', name: 'app_admin_product')]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin_product/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_product_new')]
    public function new(Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $products = new Product();
        $form=$this->createForm(ProductType::class, $products);
        $form-> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $image = $form->get('photo')->getData();
    
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
    
                $image->move(
                    $this->getParameter('product_photo'),
                    $newFilename
                );
                $products->setPhoto($newFilename);
    
                $em->persist($products);
                $em->flush();
    
                return new RedirectResponse($this->generateUrl('app_admin_product'));
            }
          

        return $this->render('admin_product/new.html.twig', [
            'products' => $products,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/edit/{id}', name: 'app_admin_product_edit')]
    public function edit(Product $product, Request $request, EntityManagerInterface $em, SluggerInterface $slugger, Filesystem $fs)
    {
        
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
        
            $products = $form->getData();
            $image = $form->get('photo')->getData();

            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                $fs->remove($this->getParameter('product_photo') . '/' . $products->getPhoto());

                $image->move(
                    $this->getParameter('product_photo'),
                    $newFilename
                );
                $products->setPhoto($newFilename);
            }
            $em->flush();
            return new RedirectResponse($this->generateUrl("app_admin_product"));
        }

        return $this->render('admin_product/edit.html.twig', [
            'form' => $form->createView(),
            'products' => $product
        ]);
    }
    #[Route('/delete/{id}', name: 'app_admin_product_delete')]
    public function delete(Product $product, Request $request, EntityManagerInterface $em)
    {$request;

        $em->remove($product);
        $em->flush();

        return new RedirectResponse($this->generateUrl("app_admin_product"));

    }
    #[Route('/show/{id}', name: 'app_admin_product_show')]
    public function detail(Product $product): Response
    {

        return $this->render('admin_product/show.html.twig', [
            'product' => $product
        ]);
    }
    
}
