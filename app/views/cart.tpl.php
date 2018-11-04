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
            <td><a href="<?php echo $this->router->generate('catalog_product', ['id' => $product->getId()]) ?>">
            <?php echo $product->getName() ?></a></td>
            <td><?php echo $product->getPrice() ?> &euro;</a></td>
            <td><?php echo $cartLine['qty'] ?></td>
            <td><?php echo $cartLine['qty'] * $product->getPrice() ?> &euro;</td>
            <td><a href="<?php echo $this->router->generate('cart_delete', ['id' => $product->getId()]) ?>"><i class="fa fa-trash"></i></a></td>
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