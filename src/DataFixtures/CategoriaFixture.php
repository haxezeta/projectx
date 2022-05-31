<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriaFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        //CATEGORIA 1 - CONSOLAS
        $categoria1 = new Categoria();
        $categoria1->setNombre("Consolas");
        $manager->persist($categoria1);


        //CATEGORIA 2 - JUEGOS
        $categoria2 = new Categoria();
        $categoria2->setNombre("Juegos");
        $manager->persist($categoria2);


        //CATEGORIA 3 - ACCESORIOS
        $categoria3 = new Categoria();
        $categoria3->setNombre("Accesorios");
        $manager->persist($categoria3);


        //CATEGORIA 4 - PC GAMING
        $categoria4 = new Categoria();
        $categoria4->setNombre("Gaming");
        $manager->persist($categoria4);

        $manager->flush();
    }
}
