<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Product;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $produit= new Product;
            $produit->setName('produit numero :  ' . $i);
            $produit->setDescription('Produit from libie');
			$produit->setPhoto('URL photo');
			$produit->setPrice(4.80);
			$manager->persist($produit);
			
	    
        }
		
		
		// $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
