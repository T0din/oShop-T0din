<?php

// Inclure le fichier qui s'occupe d'utiliser les dépendances installées via Composer

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../app/controller/CoreController.php';
require_once __DIR__.'/../app/controller/MainController.php';
require_once __DIR__.'/../app/controller/CatalogController.php';
require_once __DIR__.'/../app/controller/CartController.php';
require_once __DIR__.'/../app/utils/DBData.php';
require_once __DIR__.'/../app/utils/Cart.php';
require_once __DIR__.'/../app/model/CoreModel.php';
require_once __DIR__.'/../app/model/TypeModel.php';
require_once __DIR__.'/../app/model/BrandModel.php';
require_once __DIR__.'/../app/model/ProductModel.php';
require_once __DIR__.'/../app/model/CategoryModel.php';

// $_GET['_url'] contient l'adresse URL actuelle
// Ici, on admet qu'on récupére l'URL demandée, ou / si ça n'existe pas
//$currentUrl = isset($_GET['_url']) ? $_GET['_url'] : '/';

session_start();

$baseUrl = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';

// Routes & Dispatcher
// Instanciation de la classe AltoRouter (dispo grâce à Composer)
// AltoRouter est une librairie s'occupant du routage
// => match d'une route par rapport à l'URL courante
$router = new AltoRouter();

// Je dis à AltoRouter, d'ignorer dans l'URL complète actuelle, tous les dossiers et sous-dossiers qui nous amènent jusqu'à notre projet
$router->setBasePath($baseUrl);

$router->map('GET', '/', 'MainController#home', 'home');
$router->map('GET', '/mentions-legales', 'MainController#legalMentions', 'main_legal-mentions');
$router->map('GET', '/blog', 'MainController#blog', 'main_blog');
$router->map('GET', '/contact', 'MainController#contact', 'main_contact');
$router->map('GET', '/shop', 'MainController#shop', 'main_shop');
$router->map('GET', '/products-all', 'MainController#productsAll', 'main_products-all');
$router->map('GET', '/brands-all', 'MainController#brandsAll', 'main_brands-all');
$router->map('GET', '/catalogue/categorie/[i:id]', 'CatalogController#category', 'catalog_category');
$router->map('GET', '/catalogue/brand/[i:id]', 'CatalogController#brand', 'catalog_brand');
// Je déclare le reste des routes
$router->map('GET', '/catalogue/type/[i:id]', 'CatalogController#type', 'catalog_type');
$router->map('GET', '/catalogue/produit/[i:id]', 'CatalogController#product', 'catalog_product');
$router->map('GET', '/mon-panier', 'CartController#cart', 'cart_cart');
$router->map('POST', '/ajout-panier', 'CartController#add', 'cart_add');
$router->map('POST', '/modif-panier', 'CartController#update', 'cart_update');
$router->map('GET', '/supp-product-panier/[i:id]', 'CartController#delete', 'cart_delete');

$match = $router->match();

if ($match !== false) {
    // Alors je veux récupérer le nom du Controller et le nom de la méthode à appeler
    $target = $match['target'];
    $urlParamsFromMatch = $match['params'];
 

    // Je sépare la chaine de caractère par le délimiteur #
    $explodedArray = explode('#', $target);
 

    // Je stocke les infos dans les bonnes variables
    $controllerName = $explodedArray[0];
    $methodName = $explodedArray[1];


    // On veut instancier le bon controller
    $controller = new $controllerName($router);
    // Puis appeler la méthode de ce controller
    $controller->$methodName($match['params']);
    

}
else {
    header("HTTP/1.0 404 Not Found");


    $controller = new MainController();
    $controller->error404();
}


// $tata = 'defaite';
// $titi = 'tata';

// $tata = 'victoire';


// je lis un $, ok je regarde la suite, $titi ok $titi c'est : tata
// je prends tata je lui mets notre premier $ devant, donc $tata, du coup j'ai $tata = 'victoire'






