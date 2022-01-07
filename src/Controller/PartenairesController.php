<?php

namespace App\Controller;

use App\Repository\PartenairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenairesController extends AbstractController
{
    #[Route('/partenaires', name: 'partenaires')]
    public function index(PartenairesRepository $repository): Response
    {
        $partenaires = $repository -> findAll();
        return $this->render('partenaires/index.html.twig', [
            'partenaires' => $partenaires ,
        ]);
    }
}
