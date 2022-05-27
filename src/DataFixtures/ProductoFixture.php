<?php

namespace App\DataFixtures;

use App\Entity\Producto;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductoFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $producto = new Producto();
            $producto
                ->setNombre('Product ' . $i)
                ->setDescripcion('Lorem ipsum dolor sit amet, consectetur adipiscing elit')
                ->setPrecio(mt_rand(10, 500));

            $manager->persist($producto);
        }

        $manager->flush();
    }
}
