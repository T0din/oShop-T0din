<?php

class CoreController
{
    // TODO factoriser les controller (prendre depuis Main pour mettre dans Core)
    private $router;

    public function __construct($routerParam)
    {
        // On transmet le router à l'instanciation du contrôleur
        $this->router = $routerParam;
    }

    protected function show($viewName, $viewVars=array()) {
        

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
            
        $dbData = new DBData();
        $types = $dbData->getFooterProductTypes();
        $brands = $dbData->getFooterBrands();
        $viewVars['types'] = $types;
        $viewVars['brands'] = $brands;
        $viewVars['socialPage'] = $socialPage;

        include __DIR__.'/../views/header.tpl.php';
        include __DIR__.'/../views/'.$viewName.'.tpl.php';
        include __DIR__.'/../views/footer.tpl.php';
    }
    }
    