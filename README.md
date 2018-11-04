# dernière actualisation 434 


# log 28/10/18 01:20

DbData, controller, index, header, footer et models modifiés pour que tout soit dynamique.

Autant les `models` ont été factorisé, autant les `controllers`, j'ai (*Pierre*) répété le code avec du copier-coller de partout.

Mais ça marche : 
- Tous les liens de la nav sont fonctionnels (tpl.php, routes et méthodes dans Controller créés quand nécessaires). 
- Les liens des header et footer fonctionnent dans toutes les pages du site (on peut même accéder au panier via l'onglet cart dans le header).

# TODO : factoriser les controllers
- J'ai essayé de créer 2 instances de show dans la même méthode de `MainController` (home par exemple) afin de pouvoir décomposer ce qui est répété et ce qui ne l'est pas et de pouvoir créer une méthode type `template` pour factoriser, sans succès.

- Faire une page avec un seul produit pour faire fonctionner une requete sql avec un produit spécifique. (id dynamique en sql)

# BONUS 

<details><summary>SPOILER</summary>

    # BONUS : intégration des différentes pages 

    ... à commencer par l'acceuil (génrer les col-6 et col-4 dans le foreach via des conditions).
    Puis page avec un seul produit, page catégorie, type , marque et page panier (voir les images dans`resultat` dans un des anciens repos, atelier).

    # BONUS : qui pique
    
    Gestion du loggin de l'utilisateur via le petit bonhomme dans le header.
    Gestion du mail envoyé pour la newsletter dans la bdd.
    Gestion d'un formulaire de contact dans la page contact.

    # BONUS : de la mort qui pique vraiment GRAVE de chez GRAVE !!!

    Gestion du panier avec actualisation en temps réel selon les modifications (ajouts d'un produit depuis la boutique, délétion dans la page panier) et somme dans la page panier selon quantité et prix.


</details>

# UPDATE : 29/10/18

Cours

- Début de factorisation des controllers. A finir TODO
  
- Dynamisation de la page produit (il faut tapper l'url à la main. Nous n'avons pas encore de liens).

- problème avec l'utilisation de la correction pour home (voir dans *trash*). ~TODO~ réussit 29/10 21:15
  -> l'inté et les liens ne sont pas correctement fait actuellement.
  --> `29/10 22: 33` L'inté est presque OK. Tout est dynamique sauf les liens. Je n'arrive pas à aller les chercher correctement.
  J'ai remplacé les 'category' qui font planter le site par 'home' mais je ne crois pas que la route soit contenu par dans la méthode 'home'. Il faudrait pouvoir la rendre dynamique et y intégrer un 'id' pour aller chercher la route.
  
- ajouts multiples dans DBData. Attention à bien modifier Controller (comme la méthode product de CatalogController) si nécessaire !
  
- TODO ya un truc à faire dans DBdata et dans CatalogController pour faire fonctionner category.tpl.php comme dans la correction


# TODO Continuer à partir d'ici après le log du 31/10/18

# TODO Continuer à partir de la ligne 280 après le log du 03/11/18


-  créer Cart.php dans utils pour gérer les infos du cart et le require.
  
- TODO faire méthode add dans CartController ()

- TODO dans `CoreController` :
private $dbdata
et dans son `__construct` : 
    $this->dbdata = new DBData();
 
 - ajouter session dans l'index et $_SESSION dans CartController.php
  
 - code de Cart.php : 
<details><summary>SPOILER</summary>
    ```
    class Cart
    {
        public function addProduct($productModel, $qty = 1)
        {
            // On va stocker à la clé 'cart'
            // un tableau contenant la quantité et l'objet du produit concerné
            // sur l'index du produit en question

            // L'intérêt de ceci est de pouvoir récupérer le produit
            // selon son index dans le tableau
            $_SESSION['cart'][$productModel->getId()] = [
                'qty' => $qty,
                'product' => $productModel,
            ];
        }
    }
    ```
</details>

- code de méthode add dans CartController : 
<details><summary>SPOILER</summary>
    ```
    public function add()
        {
            if(!empty($_POST['product_id'])) {
                // On récupère le produit depuis la base
                $product = $this->dbdata->getProductDetails($_POST['product_id']);
                // ajouter le produit au panier
                // en utilisant la méthode addProduct($productModel, $qty)
                $cart = new Cart();
                $cart->addProduct($product);

                header('Location: '.$this->router->generate('cart'));
                exit;
            }
        }
    ```
</details>

- création méthode getProducts() pour Cart.php : 
  
 <details><summary>SPOILER</summary>
    ```
        public function getProducts()
        {
            return $_SESSION['cart'];
        }
    ```
</details>


- dans CartController, on instancie Cart() pour récupérer les infos dans $products : 
  
<details><summary>SPOILER</summary>
    ```
    public function cart()
        {
            $cart = new Cart();
            // On va chercher les produits en session
            $products = $cart->getProducts();

            $this->show('cart', [
                'title' => 'Mon panier',
                'products' => $products,
            ]);
        } 
    ```
</details>

- `ATTENTION` il faut charger la session avec "session_start();" dans l'index APRES les require !!! 

- dans cart.tpl.php : 
<details><summary>SPOILER</summary>
    ```
    <h1>Mon panier</h1>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Quantité</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viewVars['cartContent'] as $cartLine) : ?>
            <?php $product = $cartLine['product'] ?>
            <tr>
                <th scope="row"><?php echo $product->getId(); ?></th>
                <td><a href="<?php echo $this->router->generate('product', ['id' => $product->getId()]) ?>">
                <?php echo $product->getName() ?></a></td>
                <td><?php echo $cartLine['qty'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    ```
</details>

- REMARQUE : à ce stade, quand on ajoute au panier un produit qui y ait déjà, la quantité ne change pas (reste à 1).

- modif addProduct dans la class Cart : 
  
<details><summary>SPOILER</summary>
    ```
    
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
    ```
</details>

- Update cart.tpl.php pour ajouter prix, somme de qty*prix en ligne et somme totale :
  
<details><summary>SPOILER</summary>
    ```
    <h1>Mon panier</h1>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Sous-total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viewVars['cartContent'] as $cartLine) : ?>
            <?php $product = $cartLine['product'] ?>
            <tr>
                <th scope="row"><?php echo $product->getId(); ?></th>
                <td><a href="<?php echo $this->router->generate('product', ['id' => $product->getId()]) ?>">
                <?php echo $product->getName() ?></a></td>
                <td><?php echo $product->getPrice() ?> &euro;</a></td>
                <td><?php echo $cartLine['qty'] ?></td>
                <td><?php echo $cartLine['qty'] * $product->getPrice() ?> &euro;</td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right">Total</td>
                <td><?php echo $viewVars['cartTotal'] ?> &euro;</td>
            </tr>
        </tfoot>
    </table>
    ```
</details>

- Ajout de méthode getTotal() dans Cart.php : 
<details><summary>SPOILER</summary>
    ```
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
    ```
</details>

- dans CartController, dans la function cart() : 
<details><summary>SPOILER</summary>
    ```
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
    ```
</details>

# REPRENDRE ICI 03/11/18 13:51

- Update dans SESSION cart pour calculer le prix d'une ligne (pour éviter de le faire dans cart.tpl.php et pouvoir le réutiliser ailleurs): 
- 
<details><summary>SPOILER</summary>
    ```
    // à ajouter juste avant la fin de addProduct (dans le futur:TODO parce que ça risquerait de générer des erreurs atm)

    $_SESSION['cart'][$id]['priceLine'] = $_SESSION['cart'][$id]['qty'] * $productModel->getPrice();
    ```
</details>

- création route dans index : 
$router->map('GET', '/suppr-panier/[i:id]', 'CartController#delete', 'cart-delete');

- ajout icone et création lien pour supprimer (ce spoiler semble bugger. Voir le README une fois téléchargé pour accéder au contenu) : 
<details><summary>SPOILER</summary>
    ```
    <td><a href="<?php echo $this->router->generate('cart-delete', ['id' => $product->getId()]) ?>">
    <i class="fa fa-trash"></i></a></td>

    ```
</details>

- ajout méthode dans CartController : 
<details><summary>SPOILER</summary>
    ```
  public function delete($params)
    {
        $cart = new Cart();
        $cart->delete($params['id']);

        header('Location: '.$this->router->generate('cart'));
        exit;
    }
    ```
</details>

- ajout méthode dans Cart.php :
<details><summary>SPOILER</summary>
    ```
   public function delete($id)
    {
        // Suppression de l'index du taleau qui correspond à l'identifiant du produit
        unset($_SESSION['cart'][$id]);
    }
    ```
</details>
  
- A ce stade, la suppresion est sencé fonctionner.
  
- dans Cart.php, on crée une méthode pour vider le panier :
<details><summary>SPOILER</summary>
    ```
 public function empty()
    {
        // On vide le tableau
        $_SESSION['cart'] = [];
    }
    ```
</details>

- on crée empty dans le controller :
<details><summary>SPOILER</summary>
    ```
    public function empty()
    {
        $cart = new Cart();
        $cart->empty();

        header('Location: '.$this->router->generate('cart'));
        exit;
    }
    ```
</details>

- On change le message en cas de panier vide dans cart.tpl.php (ce spoiler semble être interprêté aussi. Voir le README une fois téléchargé) : 
- 
<details><summary>SPOILER</summary>
        ```
    <h1>Mon panier</h1>

    <?php if(!empty($viewVars['cartContent'])): ?>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Sous-total</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($viewVars['cartContent'] as $cartLine) : ?>
            <?php $product = $cartLine['product'] ?>
            <tr>
                <th scope="row"><?php echo $product->getId(); ?></th>
                <td><a href="<?php echo $this->router->generate('product', ['id' => $product->getId()]) ?>">
                <?php echo $product->getName() ?></a></td>
                <td><?php echo $product->getPrice() ?> &euro;</a></td>
                <td><?php echo $cartLine['qty'] ?></td>
                <td><?php echo $cartLine['qty'] * $product->getPrice() ?> &euro;</td>
                <td><a href="<?php echo $this->router->generate('cart-delete', ['id' => $product->getId()]) ?>"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: right">Total</td>
                <td><?php echo $viewVars['cartTotal'] ?> &euro;</td>
            </tr>
        </tfoot>
    </table>

    <a href="<?php echo $this->router->generate('cart-empty'); ?>" class="btn btn-warning">Vider le panier</a>

    <?php else: ?>

    <p>Votre panier est vide. Allez vite le remplir :)</p>

    <?php endif ?>

       
        ```
</details>


# Log 31/10/18 10:02 
- home fonctionnelle, factorisation faite (pour les controller, j'ai tout laissé dans Main par flemme).
- Etape suivante : s'occuper du panier
- Faire de l'inté

# 03/11/18 12:32
- J'ai commencé à copier coller les bouts de code du cours jusqu'à au delete. J'ai des erreurs. Donc je vais essayer de gérer ça.
- Erreurs réglées. Cart fonctionnel (je crois. A tester !!!)
- J'ai mis en place la page produits (accessible depuis la barre de nav) sans une inté correcte.
  => suite : mise en place suppression et vidage pour le panier.

# 04/11/18 11:46 
- Inté page produits bien avancée (je réalise que bcp des pages de la nav et du footer n'ont pas d'inté. Il va falloir s'en occuper, histoire que ce site puisse attérir dans un portefolio).
- Il faudrait que je trouve le moyen que les produits soient ajouté sans redirection. Soit en blocant la façon "normale" de fonctionner d'un form POST soit en utilisant JS ?
- Le panier est fonctionnel. Mais je ne peux pas gérer les quantités à la main ni au moment de l'ajout ni dans le panier lui même. 
- Le mini panier n'est pas à jour en temps réel.
TODO futur : ajout login 

# 04/11/18 21:35

-`TODO(rapide)` Inté pour page une seule catégorie, une seule marque et un seul type `dynamique` avec affichage de la catégorie / marque / type et des produits concernés *OK*
  => Reste inté Boutique (tous les types ?), toutes les marques (besoin de logo pour les marques), blog et contact.
- Ajouter Mentions Legales et Contact dans le footer (et enlever Contact de la nav)
  
- `TODO plus loin` : 
- Il faudrait que je trouve le moyen que les produits soient ajouté sans redirection. Soit en blocant la façon "normale" de fonctionner d'un form POST soit en utilisant JS ?
- Le panier est fonctionnel. Mais je ne peux pas gérer les quantités à la main ni au moment de l'ajout ni dans le panier lui même. 
- Le mini panier n'est pas à jour en temps réel.


- `TODO futur` : ajout login, rendre barre de recherche utilisable, mettre en place le changement de monnaie avec actualisation.