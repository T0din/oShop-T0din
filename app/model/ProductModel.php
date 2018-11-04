<?php
class ProductModel extends CoreModel
{
    private $name;
    private $description;
    private $picture;
    private $price;
    private $rate;
    private $status;
    private $footer_order;
    private $brand_id;
    private $category_id;
    private $type_id;
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
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
    /**
     * Get the value of picture
     */
    public function getPicture()
    {
        return $this->picture;
    }
    /**
     * Set the value of picture
     *
     * @return  self
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }
    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
    /**
     * Get the value of rate
     */
    public function getRate()
    {
        return $this->rate;
    }
    /**
     * Set the value of rate
     *
     * @return  self
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }
    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
    /**
     * Get the value of brand_id
     */ 
    public function getBrand_id()
    {
        return $this->brand_id;
    }
    /**
     * Set the value of brand_id
     *
     * @return  self
     */ 
    public function setBrand_id($brand_id)
    {
        $this->brand_id = $brand_id;
        return $this;
    }
    /**
     * Get the value of category_id
     */ 
    public function getCategory_id()
    {
        return $this->category_id;
    }
    /**
     * Set the value of category_id
     *
     * @return  self
     */ 
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;
        return $this;
    }
    /**
     * Get the value of type_id
     */ 
    public function getType_id()
    {
        return $this->type_id;
    }
    /**
     * Set the value of type_id
     *
     * @return  self
     */ 
    public function setType_id($type_id)
    {
        $this->type_id = $type_id;
        return $this;
    }
}