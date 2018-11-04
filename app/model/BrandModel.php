<?php
/**
 * Ces classes de modèles vont nous permettre
 * - de créer de nouveaux objets à stocker en BDD (écriture)
 * - de créer des objets qui viennent de la BDD depuis les requêtes (lecture)
 * une classe de Model représente un enregistrement de la table correspondante
 */
class BrandModel extends CoreModel
{
    private $name;
    private $footer_order;
    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get the value of footer_order
     */ 
    public function getFooter_order()
    {
        return $this->footer_order;
    }
    /**
     * Set the value of footer_order
     *
     * @return  self
     */ 
    public function setFooter_order($footer_order)
    {
        $this->footer_order = $footer_order;
        return $this;
    }
}