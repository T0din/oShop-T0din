
// Bouts de code de home.tpl.php retiré car non dynamiques
//from Home
<!-- <a href="<?=// $this->router->generate('catalog_category', ['id' => 1]) ?>">Catégorie #1</a><br>
    <a href="<?= //$this->router->generate('catalog_category', ['id' => 4]) ?>">Catégorie #4</a><br>
    <a href="<?=//$this->router->generate('catalog_category', ['id' => 12]) ?>">Catégorie #12</a><br>
    <a href="<?= //$this->router->generate('catalog_type', ['id' => 2]) ?>">Type #2</a><br>
    <a href="<?= //$this->router->generate('catalog_product', ['id' => 6]) ?>">Produit #6</a><br>
    <a href="<?= //$this->router->generate('cart_cart') ?>">Mon panier</a><br>
    <a href="<?= //$this->router->generate('main_legal-mentions') ?>">Mentions légales</a><br> -->


// from Home (kevin en cours avec Ben)

     
     href=" --> <?= //$router->generate('catalog_type', ['id' => $firstCategory->getId()])
              


//from Home

<section>
<div class="container-fluid">
  <div class="row mx-0">
    <div class="col-md-6">
      <div class="card border-0 text-white text-center"><img src="<?= $baseURL ?>/<?= $firstCategory->getPicture() ?>"
          alt="Card image" class="card-img">
        <div class="card-img-overlay d-flex align-items-center">
          <div class="w-100 py-3">
            <h2 class="display-3 font-weight-bold mb-4"><?= $firstCategory->getName() ?></h2><a href="category.html" class="btn btn-light"><?= $firstCategory->getSubtitle() ?></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card border-0 text-white text-center"><img src="<?= $baseURL ?>/<?= $secondCategory->getPicture() ?>"
          alt="Card image" class="card-img">
        <div class="card-img-overlay d-flex align-items-center">
          <div class="w-100 py-3">
            <h2 class="display-3 font-weight-bold mb-4"><?= $secondCategory->getName() ?></h2><a href="category.html" class="btn btn-light"><?= $secondCategory->getSubtitle() ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mx-0">
      
    <div class="col-lg-4">
      <div class="card border-0 text-center text-white"><img src="<?= $baseURL ?>/<?= $thirdCategory->getPicture() ?>"
          alt="Card image" class="card-img">
        <div class="card-img-overlay d-flex align-items-center">
          <div class="w-100">
            <h2 class="display-4 mb-4"><?= $thirdCategory->getName() ?></h2><a href="category.html" class="btn btn-link text-white"><?= $thirdCategory->getSubtitle() ?>
              <i class="fa-arrow-right fa ml-2"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 text-center text-dark">
          <img src="<?= $baseURL ?>/<?= $fourthCategory->getPicture() ?>"
            alt="Card image" class="card-img">
          <div class="card-img-overlay d-flex align-items-center">
            <div class="w-100">
              <h2 class="display-4 mb-4"><?= $fourthCategory->getName() ?></h2>
              <a href="category.html" class="btn btn-link text-dark"><?= $fourthCategory->getSubtitle() ?>
                <i class="fa-arrow-right fa ml-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    <div class="col-lg-4">
      <div class="card border-0 text-center text-white"><img src="<?= $baseURL ?>/<?= $fifthCategory->getPicture() ?>"
          alt="Card image" class="card-img">
        <div class="card-img-overlay d-flex align-items-center">
          <div class="w-100">
            <h2 class="display-4 mb-4"><?= $fifthCategory->getName() ?></h2><a href="category.html" class="btn btn-link text-white"><?= $fifthCategory->getSubtitle() ?> <i class="fa-arrow-right fa ml-2"></i></a>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

// From product.tpl.php

<!-- <h1>Produit</h1>

<p>Je suis dans le produit #<?= // $viewVars['productId'] ?></p>

<a href="<?= // $viewVars['baseURL'] ?>/">retour vers l'accueil</a>
 -->

// from category.tpl.php
Correction

<h1>Produits de la catégorie <i><?php echo $viewVars['category']->getName() ?></i></h1>

<ul>
    <?php foreach($viewVars['products'] as $product): ?>
    <li><a href="<?php echo $this->router->generate('product', ['id' => $product->getId()]) ?>"><?php echo $product->getName() ?></a></li>
    <?php endforeach ?>
</ul>


// From cart.tpl.php (code Ben je crois)

<table>
<thead>
    <tr>
        <th>Tableau à créer</th>
    </tr>
</thead>
</table>
<br>

<form action="<?= $this->router->generate('cart_add') ?>" method="post">
    <button>Soumettre mon formulaire test pour ajouter panier</button>
</form>

<form action="<?= $this->router->generate('cart_update') ?>" method="post">
    <button>Soumettre mon formulaire test pour modifier le panier</button>
</form>
<br>


//from product-all.tpl.php

<ul>
    <?php foreach($viewVars['products'] as $product): ?>
    <li><a href="<?php echo $this->router->generate('catalog_product', ['id' => $product->getId()]) ?>"><?php echo $product->getName() ?></a></li>
    <?php endforeach ?>
</ul>