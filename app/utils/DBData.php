<?php
/**
 * Classe permettant de retourner des données stockées dans la base de données
 */
class DBData {
	/** @var PDO */
	private $dbh;
    /**
     * Constructeur se connectant à la base de données à partir des informations du fichier de configuration
     */
    public function __construct() {
        // Récupération des données du fichier de config
        //   la fonction parse_ini_file parse le fichier et retourne un array associatif
        // Attention, "config.conf" ne doit pas être versionné,
        //   on versionnera plutôt un fichier d'exemple "config.dist.conf" ne contenant aucune valeur
        $configData = parse_ini_file(__DIR__.'/../config.conf');
        
        try {
            $this->dbh = new PDO(
                "mysql:host={$configData['DB_HOST']};dbname={$configData['DB_NAME']};charset=utf8",
                $configData['DB_USERNAME'],
                $configData['DB_PASSWORD'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING) // Affiche les erreurs SQL à l'écran
            );
        }
        catch(\Exception $exception) {
            echo 'Erreur de connexion...<br>';
            echo $exception->getMessage().'<br>';
            echo '<pre>';
            echo $exception->getTraceAsString();
            echo '</pre>';
            exit;
        }
    }
  /**
     * Méthode permettant de retourner les données sur un produit donné
     *
     * @param int $productId
     * @return Product
     */
    public function getProductDetails($productId) {
        // TODO
        $sql = "SELECT * FROM product WHERE id='{$productId}'";
        $stmt = $this->dbh->query($sql);

        $product = $stmt->fetchObject('ProductModel');

        return $product;
    }

    public function getAllProducts()
    {
        $sql = "SELECT * FROM product";
        $stmt = $this->dbh->query($sql);

        $products = $stmt->fetchAll(PDO::FETCH_CLASS,'ProductModel');

        return $products;
    }
       /**
     * Méthode permettant de récupérer les produits d'une catégorie
     */

    public function getCategoryProducts($categoryId)
    {
        //  //TODO ya un truc à faire ici et dans CatalogController pour faire fonctionner category.tpl.php comme dans la correction

        $sql = 'SELECT product.id, product.name, price, picture, type.name AS type_name FROM `product`INNER JOIN type ON product.type_id = type.id WHERE category_id = ' . $categoryId;

        $stmt = $this->dbh->query($sql);

        $categoryProducts = $stmt->fetchAll(PDO::FETCH_CLASS, 'ProductModel');

        return $categoryProducts;
    }

    
    /**
     * Méthode permettant de retourner les données sur une catégorie donnée
     *
     * @param int $categoryId
     * @return Category
     */
    public function getCategoryDetails($categoryId) {
        $sql =  "SELECT * FROM category WHERE id='{$categoryId}'";
        $stmt = $this->dbh->query($sql);
        // $category = $stmt->fetchAll(PDO::FETCH_CLASS, 'CategoryModel');
        $category = $stmt->fetchObject('CategoryModel');
        return $category;
    }

    

        /**
     * Méthode permettant de retourner les données sur un produit donné
     * Ainsi que la catégorie et la marque liées
     *
     * @param int $productId
     * @return Product
     */
    public function getProductDetailsJoinedCategoryAndBrand($productId) {
        // TODO
        $sql = "SELECT p.*, b.name AS brand_name, c.name AS category_name FROM product AS p
        INNER JOIN brand AS b ON p.brand_id=b.id
        INNER JOIN category AS c ON p.category_id=c.id
        WHERE p.id='{$productId}'";

        $stmt = $this->dbh->query($sql);
        // Ici récupère un objet unique via
        // http://php.net/manual/fr/pdostatement.fetchobject.php
        $product = $stmt->fetchObject('ProductModel');

        return $product;
    }

    public function getProductDetailsJoinedType($typeId)
    {
        $sql = "SELECT p.*, t.name AS `type_name`
        FROM product AS p
        INNER JOIN `type` AS t ON p.type_id=t.id
        WHERE t.id='{$typeId}'";
        $stmt = $this->dbh->query($sql);
        // Ici récupère un objet unique via
        // http://php.net/manual/fr/pdostatement.fetchobject.php
        $product = $stmt->fetchAll(PDO::FETCH_CLASS,'ProductModel');
        return $product;
    }

    public function getProductDetailsJoinedBrand($brandId)
    {
        $sql = "SELECT p.*, b.name AS `brand_name`
        FROM product AS p
        INNER JOIN `brand` AS b ON p.type_id=b.id
        WHERE b.id='{$brandId}'";
        $stmt = $this->dbh->query($sql);
        // Ici récupère un objet unique via
        // http://php.net/manual/fr/pdostatement.fetchobject.php
        $product = $stmt->fetchAll(PDO::FETCH_CLASS,'ProductModel');
        return $product;
    }
    
    /**
     * Méthode permettant de retourner les données sur une marque donnée
     *
     * @param int $brandId
     * @return Brand
     */
    public function getBrandDetails($brandId) {
        $sql = "SELECT * FROM brand WHERE id='{$brandId['id']}'";
        $stmt = $this->dbh->query($sql);
        // $brand = $stmt->fetchAll(PDO::FETCH_CLASS, 'BrandModel');
        $brand = $stmt->fetchObject('BrandModel');
        return $brand;
    }
    
    
    /**
     * Méthode permettant de retourner les données sur un type de produit donné
     *
     * @param int $typeId
     * @return ProductType
     */
    public function getProductTypeDetails($typeId) {

        $sql = "SELECT * FROM type WHERE id='{$typeId['id']}'";
        $stmt = $this->dbh->query($sql);
        $type = $stmt->fetchAll(PDO::FETCH_CLASS, 'TypeModel');
        // $type = $stmt->fetchObject('TypeModel');
        return $type;
    }
    
    /**
     * Méthode permettant de retourner les 5 catégories sur la page d'accueil
     *
     * @return Category[]
     */
    public function getHomeCategories() {
        
        $sql = 'SELECT * FROM category WHERE home_order > 0 ORDER BY home_order ASC LIMIT 5';
        $stmt = $this->dbh->query($sql);
        
        $categories = $stmt->fetchAll(PDO::FETCH_CLASS, 'CategoryModel');
        return $categories;
    }
    
    /**
     * Méthode permettant de retourner les 5 marques en bas de page
     *
     * @return Brand[]
     */
    public function getFooterBrands() {

        $sql = 'SELECT *
        FROM brand
        WHERE footer_order > 0
        AND footer_order <= 5
        ORDER BY footer_order ASC
        LIMIT 5';

        $stmt = $this->dbh->query($sql);

        $brands = $stmt->fetchAll(PDO::FETCH_CLASS, 'BrandModel');
        return $brands;
    }
    
    /**
     * Méthode permettant de retourner les 5 types de produit en bas de page
     *
     * @return ProductType[]
     */
    public function getFooterProductTypes() {
        $sql ='SELECT *
        FROM `type`
        WHERE footer_order > 0
        AND footer_order <= 5
        ORDER BY footer_order ASC
        LIMIT 5';

        $stmt = $this->dbh->query($sql);

        $types = $stmt->fetchAll(PDO::FETCH_CLASS, 'TypeModel');
        return $types;
    }
}