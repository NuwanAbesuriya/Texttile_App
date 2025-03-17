<?php

require_once("../common/dbConnection.php");

class Product
{
    private $conn;
    private $table = "products";
    private $table_img = "product_image";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getProduct_ByProductId($productId)
    {
        $sql = "SELECT * FROM $this->table WHERE product_id = $productId";
        $result = $this->conn->query($sql);
        return $result;
    }
    protected function getNewMaleProducts()
    {
        $sql = "SELECT * FROM $this->table WHERE collection_collectionId = 1 ORDER BY product_id DESC LIMIT 4";
        $result = $this->conn->query($sql);
        return $result;
    }

    protected function getNewFemaleProducts()
    {
        $sql = "SELECT * FROM $this->table WHERE collection_collectionId = 2 ORDER BY product_id DESC LIMIT 4";
        $result = $this->conn->query($sql);
        return $result;
    }

    protected function getImages_ByProductId($productId)
    {
        $sql = "SELECT * FROM $this->table_img WHERE product_productId = $productId";
        $result = $this->conn->query($sql);
        return $result;
    }

    /////////////////// Filter Products //////////////////////
    protected function getAll_BrandsByCollId($collId)
    {
        $sql = "SELECT * FROM $this->table p, brands b WHERE " .
            "p.brand_brandId = b.brand_id AND p.collection_collectionId = $collId GROUP BY b.brand_id";

        $result = $this->conn->query($sql);
        return $result;
    }

    protected function getAll_CategoriesByCollId($collId)
    {
        $sql = "SELECT * FROM $this->table p, categories c WHERE " .
            "p.category_categoryId = c.category_id AND p.collection_collectionId = $collId GROUP BY c.category_id";

        $result = $this->conn->query($sql);
        return $result;
    }

    protected function getAll_CollTypesByCollId($collId)
    {
        $sql = "SELECT * FROM $this->table p, collection_types ct WHERE " .
            "p.collection_type_collectionTypeId = ct.collection_type_id AND p.collection_collectionId = $collId GROUP BY ct.collection_type_id";

        $result = $this->conn->query($sql);
        return $result;
    }

    protected function filterProducts($brandId, $collTypeId, $categoryId, $collId)
    {
        $sql = "SELECT * FROM $this->table WHERE " .
            "brand_brandId = $brandId AND collection_type_collectionTypeId = $collTypeId AND " .
            "category_categoryId = $categoryId AND collection_collectionId = $collId";

        $result = $this->conn->query($sql) or die($this->conn->error);
        return $result;
    }

    protected function getAllDetails_ByProductId($productId)
    {
        $sql = "SELECT * FROM $this->table p " .
            "INNER JOIN categories c ON p.category_categoryId = c.category_id " .
            "INNER JOIN brands b ON p.brand_brandId = b.brand_id " .
            "INNER JOIN collections cl ON p.collection_collectionId = cl.collection_id " .
            "INNER JOIN collection_types ct ON p.collection_type_collectionTypeId " .
            "AND p.product_id = $productId";

        $result = $this->conn->query($sql);
        return $result;
    }

    ///////////////////////////// Public Accesses ////////////////////////////////
    public function giveNewMaleProducts()
    {
        $result = $this->getNewMaleProducts();
        return $result;
    }

    public function giveNewFemaleProducts()
    {
        $result = $this->getNewFemaleProducts();
        return $result;
    }

    public function giveImages_ByProductId($productId)
    {
        $result = $this->getImages_ByProductId($productId);
        return $result;
    }

    public function giveAll_BrandsByCollId($collId)
    {
        $result = $this->getAll_BrandsByCollId($collId);
        return $result;
    }
    public function giveAll_CategoriesByCollId($collId)
    {
        $result = $this->getAll_CategoriesByCollId($collId);
        return $result;
    }
    public function giveAll_CollTypesByCollId($collId)
    {
        $result = $this->getAll_CollTypesByCollId($collId);
        return $result;
    }

    public function giveAllDetails_ByProductId($productId)
    {
        $result = $this->getAllDetails_ByProductId($productId);
        return $result;
    }

    public function giveProduct_ByProductId($productId)
    {
        $result = $this->getProduct_ByProductId($productId);
        return $result;
    }
}
