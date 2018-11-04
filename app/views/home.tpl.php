<section class="home-carousel">
    <div class="owl-carousel owl-theme">
      <div class="item">
        <img src="<?= $baseURL ?>/assets/img/slider-1.jpg" alt="">
        <div class="container-fluid h-100 py-5">
          <div class="row align-items-center h-100">
            <div class="col-lg-8 col-xl-6 mx-auto text-white text-center">
              <h5 class="text-uppercase text-white font-weight-light mb-4 letter-spacing-5">Nouveau</h5>
              <h1 class="mb-5 display-2 font-weight-bold text-serif">Blue lagoon</h1>
              <p class="lead mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.</p>
              <p> <a href="#" class="btn btn-light">Voir la collection</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="<?= $baseURL ?>/assets/img/slider-2.jpg" alt="">
        <div class="container-fluid h-100 py-5">
          <div class="row align-items-center h-100">
            <div class="col-lg-8 col-xl-6 mx-auto text-white text-center">
              <h5 class="text-uppercase text-white font-weight-light mb-4 letter-spacing-5">Meilleure vente</h5>
              <h1 class="mb-5 display-2 font-weight-bold text-serif">Tennis jogger</h1>
              <p class="lead mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.</p>
              <p> <a href="#" class="btn btn-light">Voir les modèles</a></p>
            </div>
          </div>
        </div>
      </div>
      <div class="item">
        <img src="<?= $baseURL ?>/assets/img/slider-3.jpg" alt="">
        <div class="container-fluid h-100 py-5">
          <div class="row align-items-center h-100">
            <div class="col-lg-8 col-xl-6 mx-auto text-white text-center">
              <h5 class="text-uppercase text-white font-weight-light mb-4 letter-spacing-5">Classique</h5>
              <h1 class="mb-5 display-2 font-weight-bold text-serif">Relax slippers</h1>
              <p class="lead mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.</p>
              <p> <a href="#" class="btn btn-light">Découvrir</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="container-fluid">
      <div class="row mx-0">
        <div class="col-md-6">
          <div class="card border-0 text-white text-center"><img src="<?php echo $viewVars['baseURL'] ?>/<?php echo $viewVars['categories'][0]->getPicture(); ?>"
              alt="<?php echo $viewVars['categories'][0]->getName(); ?>" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100 py-3">
                <h2 class="display-3 font-weight-bold mb-4"><?php echo $viewVars['categories'][0]->getName(); ?></h2>
               
                <a href="<?php echo $this->router->generate('catalog_category', ['id' => $viewVars['categories'][0]->getId()]); ?>" class="btn btn-light">
                <?php echo $viewVars['categories'][0]->getSubtitle(); ?></a>
           

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card border-0 text-white text-center"><img src="<?php echo $viewVars['baseURL'] ?>/<?php echo $viewVars['categories'][1]->getPicture(); ?>"
              alt="<?php echo $viewVars['categories'][1]->getName(); ?>" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100 py-3">
                <h2 class="display-3 font-weight-bold mb-4"><?php echo $viewVars['categories'][1]->getName(); ?></h2><a href="<?php echo $this->router->generate('catalog_category', ['id' => $viewVars['categories'][1]->getId()]); ?>" class="btn btn-light"><?php echo $viewVars['categories'][1]->getSubtitle(); ?></a>
              </div>
            </div>
          </div>
        </div>
      <div class="row mx-0">
          
        <div class="col-lg-4">
          <div class="card border-0 text-center text-white"><img src="<?php echo $viewVars['baseURL'] ?>/<?php echo $viewVars['categories'][2]->getPicture(); ?>"
              alt="<?php echo $viewVars['categories'][2]->getName(); ?>" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100">
                <h2 class="display-4 mb-4"><?php echo $viewVars['categories'][2]->getName(); ?></h2>
                <a href="<?php echo $this->router->generate('catalog_category', ['id' => $viewVars['categories'][2]->getId()]); ?>" class="btn btn-link text-white"><?php echo $viewVars['categories'][2]->getSubtitle(); ?>
                  <i class="fa-arrow-right fa ml-2"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border-0 text-center text-white"><img src="<?php echo $viewVars['baseURL'] ?>/<?php echo $viewVars['categories'][3]->getPicture(); ?>"
              alt="<?php echo $viewVars['categories'][3]->getName(); ?>" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100">
                <h2 class="display-4 mb-4"><?php echo $viewVars['categories'][3]->getName(); ?></h2><a href="<?php echo $this->router->generate('catalog_category', ['id' => $viewVars['categories'][3]->getId()]); ?>" class="btn btn-link text-dark"><?php echo $viewVars['categories'][3]->getSubtitle(); ?>
                  <i class="fa-arrow-right fa ml-2"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card border-0 text-center text-white"><img src="<?php echo $viewVars['baseURL'] ?>/<?php echo $viewVars['categories'][4]->getPicture(); ?>"
              alt="<?php echo $viewVars['categories'][4]->getName(); ?>" class="card-img">
            <div class="card-img-overlay d-flex align-items-center">
              <div class="w-100">
                <h2 class="display-4 mb-4"><?php echo $viewVars['categories'][4]->getName(); ?></h2><a href="<?php echo $this->router->generate('catalog_category', ['id' => $viewVars['categories'][4]->getId()]); ?>" class="btn btn-link text-white"><?php echo $viewVars['categories'][4]->getSubtitle(); ?>
                  <i class="fa-arrow-right fa ml-2"></i></a>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>




  </section>