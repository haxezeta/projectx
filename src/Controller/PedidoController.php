<?php

namespace App\Controller;

use App\Entity\Pedido;
use App\Entity\Producto;
use App\Repository\PedidoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PedidoController extends AbstractController
{
    #[Route('/pedido', name: 'app_pedido')]
    public function index(PedidoRepository $pedidoRepository): Response
    {

        $pedido = $pedidoRepository->findBy(
            ['usuario' => 'usuario1@gmail.com']
        );

        return $this->render('pedido/index.html.twig', [
            'pedidos' => $pedido
        ]);
    }

    #[Route('/carrito/{id}', name: 'app_carrito')]
    public function carrito(Producto $producto): Response
    {
        $pedido = new Pedido();

        $pedido->setUsuario("usuario1@gmail.com");
        $pedido->setNombre($producto->getNombre());
        $pedido->setPedido($producto->getId());
        $pedido->setPrecio($producto->getPrecio());
        $pedido->setEstado("No procesado");

        //entityManager
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pedido);
        $entityManager->flush();

        $this->addFlash('pedido', $pedido->getNombre() . ' se ha agregado al pedido');

        return $this->redirect($this->generateUrl('app_catalogo'));
    }

    #[Route('/estado/{id},{estado}', name: 'app_estado')]
    public function status($id, $estado) {
        $entityManager = $this->getDoctrine()->getManager();
        $pedido = $entityManager->getRepository(Pedido::class)->find($id);

        $pedido->setEstado($estado);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('app_pedido'));
    }
}
