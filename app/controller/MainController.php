<?php
// "use" à toujours placer en haut
use SocialLinks\Page;

class MainController {
    // Méthode de la page d'accueil

    protected $router;
    protected $dbData;

    public function __construct($routerParam)
    {
        // On transmet le router à l'instanciation du contrôleur
        $this->router = $routerParam;
        $this->dbData = new DBData();
    }
    public function home() {
         
        //  $products = $dbData -> getCategoryProducts($urlParams['id']);
        //  $category = $dbdata->getCategoryDetails($urlParams);
        $homeCategories = $this->dbData->getHomeCategories();
        $this->show('home', [

            'categories' => $homeCategories,
            // 'products' => $products,
            // 'category' => $category

        ]);
    }

    public function legalMentions() {


        $this->show('legal-mentions', [

        ]);
    }

    public function productsAll() {
        $allProducts = $this->dbData->getAllProducts();
        $this->show('products-all', [
            'products' => $allProducts
        ]);
    }

    public function brandsAll() {

        $this->show('brands-all', [

            ]);
        
    }

    public function blog() {

        $this->show('blog', [

            ]);

    }

    public function shop() {


        $this->show('shop', [

            ]);

    }
    public function contact() {
        $this->show('contact', [

            ]);
    }
    public function error404() {

        $this->show('404');
    }

    protected function show($viewName, $viewVars=array()) {
        $router=$this->router;
        $dbData=$this->dbData;

        $viewVars['baseURL'] = $_SERVER['BASE_URI'];

        foreach ($viewVars as $viewVarName=>$viewVarValue) {
            $$viewVarName = $viewVarValue; 
        }       

        $socialPage = new Page([
            'url' => 'http://localhost/o-clock-Lunar/S05/S05-E03-oShop/public/',
            'title' => 'Dans les shoe',
            'text' => 'Site de vente en ligne de chaussures',
            'image' => 'https://www.podologue-meigneux.fr/wp-content/uploads/2015/01/chaussures-noires-500x281.jpg',
            'icon' => 'https://cdn3.iconfinder.com/data/icons/shoes-3/100/05-512.png',
            'twitterUser' => '@oclock_io'
            ]);
            
        $types = $this->dbData->getFooterProductTypes();
        $brands = $this->dbData->getFooterBrands();
        $viewVars['types'] = $types;
        $viewVars['brands'] = $brands;
        $viewVars['socialPage'] = $socialPage;

        include __DIR__.'/../views/header.tpl.php';
        include __DIR__.'/../views/'.$viewName.'.tpl.php';
        include __DIR__.'/../views/footer.tpl.php';
    }
}