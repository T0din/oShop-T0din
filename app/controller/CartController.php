<?php
use SocialLinks\Page;
class CartController extends MainController {

    public function cart()
    {
        $cart = new Cart();
        // On va chercher les produits en session
        $cartContent = $cart->getProducts();

        $this->show('cart', [
            'title' => 'Mon panier',
            'cartContent' => $cartContent,
            'cartTotal' => $cart->getTotal(),
        ]);
    }

    // public function add() {
    //     // Récupérer les données du formulaire en POST

    //     // Validation des données

    //     // Actions à faire ensuite

    //     // Rediriger vers la page panier
    //     echo 'TODO (add) => rediriger vers le panier';

    //     // Aucun code HTML à afficher => pas de view
    // }

    public function add()
    {
        if(!empty($_POST['product_id'])) {
            // On récupère le produit depuis la base
            $product = $this->dbData->getProductDetails($_POST['product_id']);
            // ajouter le produit au panier
            // en utilisant la méthode addProduct($productModel, $qty)
            $cart = new Cart();
            $cart->addProduct($product);

            header('Location: '.$this->router->generate('cart_cart'));
            exit;
        }
    }

    public function update() {
        // Récupérer les données du formulaire en POST

        // Validation des données

        // Actions à faire ensuite

        // Rediriger vers la page panier
        echo 'TODO (update) => rediriger vers le panier';
        
        // Aucun code HTML à afficher => pas de view
    }
    
    // Comme j'ai des parties dynamiques dans la route de cette page
    // Je demande un paramètre que je nomme $urlParams
    public function delete($params)
    {
        $cart = new Cart();
        $cart->delete($params['id']);

        header('Location: '.$this->router->generate('cart_cart'));
        exit;
    }

    public function empty()
    {
        $cart = new Cart();
        $cart->empty();

        header('Location: '.$this->router->generate('cart_cart'));
        exit;
    }

}