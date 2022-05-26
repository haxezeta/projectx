<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Repository\ProductoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


//SE PONE producto. los métodos que hay dentro de la clase en el TWIG se llamarán como producto.rutamétodo. 
//Ej: producto.editar para llamar al método index y proudcto.crear para llamar al crearProducto
#[Route('/producto', name: 'producto.')]
class ProductoController extends AbstractController
{
    #[Route('/', name: 'editar')]
    public function index(ProductoRepository $productoRepository)
    {
        $productos = $productoRepository->findAll();

        return $this->render('producto/index.html.twig', [
            'productos' => $productos
        ]);
    }

    #[Route('/crear', name: 'crear')]
    public function crearProducto(Request $request){
        $producto = new Producto();
        $producto->setNombre('Death Stranding');
        $producto->setDescripcion('El mejor juego');
        $producto->setPrecio(40);

        //EntityManager
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($producto);
        $entityManager->flush();

        //Response
        return new Response("Nuevo producto creado");
    }
}
