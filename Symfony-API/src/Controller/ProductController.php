<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ProductRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;

class ProductController extends AbstractController
{
    #[Route('/api/products', name: 'list_product', methods: ['GET'])]

    public function GetProductsList(ProductRepository $produitRepository, SerializerInterface $serializer  ): Response
    {
        $ProductList = $produitRepository->findAll();
        $jsonProductList = $serializer->serialize($ProductList, 'json');
        return new JsonResponse($jsonProductList, Response::HTTP_OK, [], true);

    }
	
	 #[Route('/api/products/{productId}', name: 'one_product', methods: ['GET'])]
    
	
	
	
       public function getOneProduct(int $productId, SerializerInterface $serializer, ProductRepository $produitRepository): JsonResponse {

        $product = $produitRepository->find($productId);
        if ($product) {
            $jsonProduct = $serializer->serialize($product, 'json');
            return new JsonResponse($jsonProduct, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
   }
   
   
   	 #[Route('/api/products/', name: 'add_product', methods: ['POST'])]

  public function AddProduct(ManagerRegistry $doctrine, Request $request): Response
    {
        $entityManager = $doctrine->getManager();
  
        $produit = new Product();
        $produit->setName($request->request->get('name'));
        $produit->setDescription($request->request->get('description'));
		$produit->setPhoto($request->request->get('photo'));
		$produit->setPrice($request->request->get('price'));

        $entityManager->persist($produit);
        $entityManager->flush();
  
        return $this->json('Created new project successfully ');
    }
	
	  #[Route('/api/products/{productId}', name: 'add_product', methods: ['DELETE'])]

	
	public function supp_product(ManagerRegistry $doctrine, int $productId): Response
    {
        $entityManager = $doctrine->getManager();
        $produit= $entityManager->getRepository(Product::class)->find($productId);
  
        if (!$produit) {
            return $this->json('No product found for id' . $productId, 404);
        }
  
        $entityManager->remove($produit);
        $entityManager->flush();
  
        return $this->json('Deleted a product successfully with id ' . $productId);
    }
	
	
	#[Route('/api/products/{productId}', name: 'update_product', methods: ['PUT'])]

	
	public function edit(ManagerRegistry $doctrine, Request $request, int $productId): Response
    {
        $entityManager = $doctrine->getManager();
        $produit = $entityManager->getRepository(Product::class)->find($productId);
  
        if (!$produit) {
            return $this->json('No product found for id' . $productId, 404);
        }
  
        $get_name_description_json = json_decode($request->getContent(), true);
            
  
        $produit->setName($get_name_description_json['name']);
        $produit->setDescription($get_name_description_json['description']);
        $entityManager->flush();
  
        $data =  [
            'id' => $produit->getId(),
            'name' => $produit->getName(),
            'description' => $produit->getDescription(),
        ];
          
        return $this->json($data);
	
	
	
	
     }
}
