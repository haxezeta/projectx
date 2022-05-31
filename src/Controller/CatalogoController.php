<?php

namespace App\Controller;

use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CatalogoController extends AbstractController
{
    #[Route('/catalogo', name: 'app_catalogo')]
    public function catalogo(ProductoRepository $productoRepository): Response
    {

        $productos = $productoRepository->findAll();

        $session = new Session();
        //$session->start();

        // set and get session attributes

        $session->get('name');

        return $this->render('catalogo/index.html.twig', [
            'productos' => $productos, 'usuario' => $session->get('name')
        ]);
    }
}
