    <section class="hero">
    <div class="container">
      <!-- Breadcrumbs -->
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="<?= $this->router->generate('home') ?>">Home</a></li>
        <li class="breadcrumb-item active"><?php echo $viewVars['brandsDetails']->getName() ?></li>
      </ol>
    </div>
  </section>

<div class="card-deck">
<?php foreach($viewVars['brandAllDetails'] as $product): ?>
        <div class=" card-product card">
            <img class="card-img-top" src="<?php echo $viewVars['baseURL'] ?>/<?php echo $product->getPicture(); ?>"
       alt="<?php echo $product->getName(); ?>" class="Card image cap">
            <div class="card-body">
            <a href="<?php echo $this->router->generate('catalog_product', ['id' => $product->getId()]) ?>"><h5 class="card-title"> <?php echo $product->getName(); ?> </h5></a>
            
            <div class="my-2">
            <div class="text-muted"><?php echo $product->getPrice() ?> €</span> TTC</div>
          </div>
          <div class="product-action-buttons">
            <form action="<?php echo $this->router->generate('cart_add') ?>" method="post">
              <input type="hidden" name="product_id" value="<?php echo $product->getId() ?>">
              <button class="btn btn-dark btn-buy"><i class="fa fa-shopping-cart"></i><span class="btn-buy-label ml-2">Ajouter au panier</span></button>
            </form>
          </div>

    
        </div>
        </div>
        <?php endforeach ?>
</div>

