<?php

namespace App\Controller;

use App\Entity\SousService;
use App\Entity\Proprety;
use App\Entity\Photo;
use App\Repository\PropretyRepository;
use App\Repository\SousServiceRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
    */
    public function index(PropretyRepository $repository)
    {
        $properties = $repository->findAll();
        return $this->render('home.html.twig',[
            'properties' => $properties
        ]);
    }
    /**
     * @Route("portfolio/", name="portfolio")
    */
    public function portfolio(PhotoRepository $repository)
    {
        $photos = $repository->findAll();
        return $this->render('pages/portfolio.html.twig',[
            'photos' => $photos
        ]);

    }
    /**
     * @Route("service/{id}", name="service")
    */
    public function show(Proprety $proprety)
    {
        $sousServices = new SousService();
        return $this -> render('pages/service.html.twig',[
            'proprety' => $proprety,
            'id'=> $proprety->getId()
        ]);

    }
    /**
     * @Route("{name}/gallerie", name="photo")
    */
    public function gallerie(SousService $sousservice, SousServiceRepository $repository)
    {   
        $services = $repository->findLatest();
        $photos = new Photo();
        return $this -> render('pages/gallerie.html.twig',[
            'sousServices' => $sousservice,
            'name'=> $sousservice->getName(),
            'services' => $services
        ]);
    }
}