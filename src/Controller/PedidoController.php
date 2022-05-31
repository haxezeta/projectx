<?php

namespace App\Controller;

use App\Entity\Pedido;
use App\Entity\Producto;
use App\Entity\Usuario;
use App\Repository\PedidoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PedidoController extends AbstractController
{
    #[Route('/pedido', name: 'app_pedido')]
    public function index(PedidoRepository $pedidoRepository): Response
    {
        
        $user = $this->getUser()->getUserIdentifier();
        
        if($user == 'admin@gmail.com') {
            $pedido = $pedidoRepository->findAll();
        } else {
            $pedido = $pedidoRepository->findBy(
                ['usuario' => $user]
            );
        }

        return $this->render('pedido/index.html.twig', [
            'pedidos' => $pedido
        ]);
    }

    #[Route('/carrito/{id}', name: 'app_carrito')]
    public function carrito(Producto $producto): Response
    {
        $pedido = new Pedido();

        $user = $this->getUser()->getUserIdentifier();

        $pedido->setUsuario($user);
        $pedido->setNombre($producto->getNombre());
        $pedido->setPedido($producto->getId());
        $pedido->setPrecio($producto->getPrecio());
        $pedido->setEstado("No procesado");

        //entityManager
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pedido);
        $entityManager->flush();

        $this->addFlash('pedido', $pedido->getNombre() . ' se ha agregado al pedido');

        // return $this->render('pedido/index.html.twig', [
        //     'usuario' => $user
        // ]);

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
