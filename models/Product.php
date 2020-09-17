<?php

class Product
{

    const SHOW_BY_DEFAULT = 8;
    
    public static function hideOrShowProducts($categoryId, $status)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE product SET status=:status '
        . 'WHERE category_id=:categoryId';

        $result = $db->prepare($sql);
        $result->bindParam(':status', $status);
        $result->bindParam(':categoryId', $categoryId);
        
        return $result->execute();
    }

    /**
     * Returns an array of products
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page = 1)
    {
        $count = intval($count);
        $page = intval($page);
        $offset = ($page - 1) * $count;
        
        $db = Db::getConnection();
        $productsList = array();

        $result = $db->query('SELECT * FROM product '
            . 'WHERE status = "1"'
            . 'ORDER BY id DESC '                
            . 'LIMIT ' . $count
            . ' OFFSET '. $offset);

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['category_id'] = $row['category_id'];
            $productsList[$i]['description'] = $row['description'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['brand'] = $row['brand'];
            if($row['photo'] == '') 
                $productsList[$i]['photo'] = '/template/images/product-details/example.jpg';
            else
                $productsList[$i]['photo'] = $row['photo'];
            $i++;
        }

        return $productsList;
    }
    
    /**
     * Returns an array of products
     */
    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {

            $page = intval($page);            
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();            
            $products = array();
            $result = $db->query("SELECT * FROM product "
                . "WHERE status = '1' AND category_id = '$categoryId' "
                . "ORDER BY id ASC "                
                . "LIMIT ".self::SHOW_BY_DEFAULT
                . ' OFFSET '. $offset);

            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['photo'] = $row['photo'];
                $i++;
            }

            return $products;       
        }
    }
    
    
    /**
     * Returns product item by id
     * @param integer $id
     */
    public static function getProductById($id)
    {
        $id = intval($id);

        if ($id) {                        
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM product WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            return $result->fetch();
        }
    }

    public static function getTotalPriceProducts($productsInCart)
    {
        $totalPrice = 0;
        $productsIds = array_keys($productsInCart);
        $products = Product::getProdustsByIds($productsIds);
        foreach ($products as $product) {
            $totalPrice += $product['price']*$productsInCart[$product['id']];
        }

        return $totalPrice;
    }
    /**
     * Returns products
     */
    public static function getProdustsByIds($idsArray)
    {
        $products = array();
        
        $db = Db::getConnection();
        
        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['brand'] = $row['brand'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['photo'] = $row['photo'];
            $i++;
        }

        return $products;
    }

    /**
     * Returns total products
     */
    public static function getTotalProducts()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
            . 'WHERE status="1"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    /**
     * Returns total products in category
     */
    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
            . 'WHERE status="1" AND category_id ="'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }
    
    
    /**
     * Returns an array of recommended products
     */
    public static function getRecommendedProducts()
    {
        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
            . 'WHERE status = "1" AND is_recommended = "1"'
            . 'ORDER BY id DESC ');

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;
    }

    public static function delProduct($id) {
        $db = Db::getConnection();

        $sql = 'DELETE FROM product WHERE id=:id';
     
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
    
        return $result->execute();
    }

}