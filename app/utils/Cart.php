<?php

class Cart {
    // public function addProduct($productModel, $qty = 1)
    // {
    //     // On va stocker à la clé 'cart'
    //     // un tableau contenant la quantité et l'objet du produit concerné
    //     // sur l'index du produit en question

    //     // L'intérêt de ceci est de pouvoir récupérer le produit
    //     // selon son index dans le tableau
    //     $_SESSION['cart'][$productModel->getId()] = [
    //         'qty' => $qty,
    //         'product' => $productModel,
    //     ];
    // }

    public function getProducts()
    {
        return $_SESSION['cart'];
    }

    public function addProduct($productModel, $qty = 1)
        {
            // Pour simplifier la lecture et l'écriture du code
            $id = $productModel->getId();

            // On va stocker à la clé 'cart'
            // un tableau contenant la quantité et l'objet du produit concerné
            // sur l'index du produit en question

            // Si le produit est déjà dans la panier on ajoute 1 à la quantité
            if(isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['qty']++;
            } else {
                // Sinon on l'ajoute au panier

                // L'intérêt de cette technique avec l'id est de pouvoir récupérer le produit
                // selon son index dans le tableau
                $_SESSION['cart'][$id] = [
                    'qty' => $qty,
                    'product' => $productModel,
                ];
            }

        }

        public function getTotal()
        {
            // Total final, au début = 0
            $total = 0;
            foreach($_SESSION['cart'] as $cartLine) {
                // On calcule le total pour chaque ligne
                $product = $cartLine['product'];
                $total = $total + $product->getPrice() * $cartLine['qty'];
            }

            return $total;
        }
        
        public function delete($id)
        {
            // Suppression de l'index du taleau qui correspond à l'identifiant du produit
            unset($_SESSION['cart'][$id]);
        }

        public function empty()
        {
            // On vide le tableau
            $_SESSION['cart'] = [];
        }
}