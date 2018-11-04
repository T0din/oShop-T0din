<?php
use SocialLinks\Page;

class CatalogController extends MainController{
   

    public function category($urlParams) {
        // $dbData = new DBData();
        $products = $this->dbData -> getCategoryProducts($urlParams['id']);
        $category = $this->dbData->getCategoryDetails($urlParams['id']);
        //TODO ya un truc à faire ici et dans DBdata pour faire fonctionner category.tpl.php comme dans la correction
        $categoryId = $urlParams['id'];
        $this->show('category', [
            // 'categoryId' => $categoryId,
            'products' => $products,
            'category' => $category
        ]);
    }
    
    
    public function type($urlParams) {
        $typeId = $urlParams['id'];
        $types = $this->dbData->getProductTypeDetails($urlParams);
        $typesAllProducts = $this->dbData->getProductDetailsJoinedType($urlParams['id']);
        $this->show('type', [
            'typeId' => $typeId,
            'typesDetails' => $types,
            'typeAllDetails' => $typesAllProducts
        ]);
    }
    public function brand($urlParams) {
      
        $brandId = $urlParams['id'];
        $brands = $this->dbData-> getBrandDetails($urlParams);
        $brandAllProducts = $this->dbData->getProductDetailsJoinedBrand($urlParams['id']);

        $this->show('brand', [
            'brandId' => $brandId,
            'brandsDetails' => $brands,
            'brandAllDetails' => $brandAllProducts
        ]);
    }

    public function product($urlParams) {
        // $dbData = new DBData();
        $product = $this->dbData->getProductDetailsJoinedCategoryAndBrand($urlParams['id']);
    
        $productId = $urlParams['id'];
        $this->show('product', [
            'productId' => $productId,
            'product' => $product
        ]);
    }

}