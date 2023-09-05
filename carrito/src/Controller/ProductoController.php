<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Producto;



class ProductoController extends AbstractController
{
 /**
 * @Route("/", name="listar_productos")
 */
 public function listarProductos(ManagerRegistry $doctrine): Response
 {
   $repository = $doctrine->getRepository(Producto::class);
    $productos = $repository->findAll();

    return $this->render('producto/lista.html.twig', ['productos' => $productos]);

 }

 /**
 * @Route("/producto/{id}", name="detalle_producto")
 */
public function detalleProducto(ManagerRegistry $doctrine, int $id): Response
{
   $repository = $doctrine->getRepository(Producto::class);
   $producto = $repository->find($id);

   if (!$producto) {
      throw $this->createNotFoundException('No existe');
   }

   return $this->render('producto/detalle.html.twig', ['productoDeta' => $producto]);

}

}


?>