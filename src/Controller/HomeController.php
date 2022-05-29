<?php

namespace App\Controller;

use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProductoRepository $productoRepository): Response
    {

        $productos = $productoRepository->findAll();

        $aleatorio = array_rand($productos, 2);

        return $this->render('home/index.html.twig', [
            'producto1'=>$productos[$aleatorio[0]],
            'producto2'=>$productos[$aleatorio[1]],
        ]);
    }

}
