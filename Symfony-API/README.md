

-Installe : composer,symfony cli,PHP 8,serveur local (XAMPP ou autres),Postman



- Dans votre terminal :  

      faites ces commandes  :
	  
	  php bin/console doctrine:database:create
	  
	  php bin/console doctrine:schema:update --force
	  
	  php bin/console doctrine:fixtures:load
	  
	  composer require symfony/serializer-pack
	  
	  symfony serve:start
	  
-Lance votre  serveur local notamment votre PHPmyadmin
	  
-Ouvrir Postman et faites vos requetes HTTP voir ProductController.php
 pour voir les requetes à faire pour votre api :
 
   Exemple : 

      Dans le champ  pour les requetes saisir ceci

	  http://127.0.0.1:8000/api/products  
	  
	  choisir la requete get , clique sur send
	  
	  ceci affiche tous les produits  
   