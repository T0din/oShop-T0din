  <section class="hero">
    <div class="container">
      <!-- Breadcrumbs -->
      <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><?php echo $viewVars['product']->category_name ?></li>
      </ol>
    </div>
  </section>

  <section class="products-grid">
    <div class="container-fluid">

      <div class="row">
        <!-- product-->
        <div class="col-lg-6 col-sm-12">
          <div class="product-image">
            <a href="#" class="product-hover-overlay-link">
              <img src="<?= $viewVars['baseURL'] .'/'. $product->getPicture()  ?>" alt="product" class="img-fluid">
            </a>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12">
          <div class="mb-3">
            <h3 class="h3 text-uppercase mb-1"><?php echo $viewVars['product']->getName() ?></h3>
            <div class="text-muted">by <em><?php echo $viewVars['product']->brand_name ?></em></div>
            <div>
                <!-- Pour toute valeur entre 1 et 5 inclus -->
                <?php for ($i = 1; $i <= 5; $i++) {
                  if ($viewVars['product']->getRate() >= $i) {
                    // Si la note du produit est supérieure ou égale à la valeur
                    // On affiche une étoile pleine
                    echo '<i class="fa fa-star"></i>';
                  } else {
                    // Sinon on affiche une étoile vide
                    echo '<i class="fa fa-star-o"></i>';
                  }
                } ?>
            </div>
          </div>
          <div class="my-2">
            <div class="text-muted"><?php echo $viewVars['product']->getPrice() ?> €</span> TTC</div>
          </div>
          <div class="product-action-buttons">
            <form action="<?php echo $this->router->generate('cart_add') ?>" method="post">
              <input type="hidden" name="product_id" value="<?php echo $viewVars['product']->getId() ?>">
              <button class="btn btn-dark btn-buy"><i class="fa fa-shopping-cart"></i><span class="btn-buy-label ml-2">Ajouter au panier</span></button>
            </form>
          </div>
          <div class="mt-5">
            <p>
              L<?php echo $viewVars['product']->getDescription() ?>
            </p>
          </div>
        </div>
        <!-- /product-->
      </div>
      
    </div>
  </section>
