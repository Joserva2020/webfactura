<?php

namespace App\Controller;

use App\Entity\Imagen;
use App\Form\ImagenType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
       
        $imagenes = $this->getDoctrine()
        ->getRepository(Imagen::class)  
        ->findAll();

        return $this->render('home/index.html.twig', [
            'imagenes' => $imagenes,
        ]);
    }


    public function show(Imagen $imagenes): Response
    {
        return $this->render('home/index.html.twig', [
            'imagen' => $imagen,
        ]);
    }

   


}

   
   

