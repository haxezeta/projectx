<?php

namespace App\Controller;

use App\Entity\Producto;
use App\Form\ProductoTipo;
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
    //FUNCION LISTAR PRODUCTOS
    #[Route('/', name: 'editar')]
    public function index(ProductoRepository $productoRepository)
    {
        $productos = $productoRepository->findAll();

        return $this->render('producto/index.html.twig', [
            'productos' => $productos
        ]);
    }

    //FUNCION CREAR PRODUCTO
    #[Route('/crear', name: 'crear')]
    public function crearProducto(Request $request)
    {
        $producto = new Producto();

        //Formulario de producto
        $form = $this->createForm(ProductoTipo::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $imagen = $form->get('imagen')->getData();
            // $imagen = $request->files->get('producto')['imagen'];

            //Para poder procesar las imagenes subidas a la base de datos
            if ($imagen) {

                $filename = md5(uniqid()) . '.' . $imagen->guessClientExtension();
            }

            $imagen->move(
                $this->getParameter('img_carpeta'),
                $filename
            );

            $producto->setImagen($filename);
            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('producto.editar'));
        }

        return $this->render('producto/crear.html.twig', [
            'crearForm' => $form->createView()
        ]);
    }

    //FUNCION BORRAR PRODUCTO
    #[Route('/borrar/{id}', name: 'borrar')]
    public function borrarProducto($id, ProductoRepository $productoRepository)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $producto = $productoRepository->find($id);
        $entityManager->remove($producto);
        $entityManager->flush();   

        return $this->redirect($this->generateUrl('producto.editar'));
    }

    #[Route('/mostrar/{id}', name: 'mostrar')]
    public function mostrarImagen(Producto $producto){
        return $this->render('producto/mostrar.html.twig', [
            'producto' => $producto
        ]);
    }
}
