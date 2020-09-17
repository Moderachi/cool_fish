<?php

class Category
{
    /**
     * Returns an array of categories
     */
    public static function getCategoriesList($all = 1)
    {

        $db = Db::getConnection();

        $categoryList = array();


        if($all == 1)
            $sql = 'SELECT * FROM category WHERE status = 1 ORDER BY sort_order ASC';
        else
            $sql = 'SELECT * FROM category ORDER BY sort_order ASC';
        
        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }

        return $categoryList;
    }

    public static function getCategoryById($categoryId)
    {
        $id = intval($categoryId);

        if ($id) {  
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM category '
                . 'WHERE id = '.$categoryId);

            return $result->fetch();
        }
    }

    public static function delCategory($id) {
        $db = Db::getConnection();

        $sql = 'DELETE FROM category WHERE id=:id; DELETE FROM product WHERE category_id=:id';
     
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
    
        return $result->execute();
    }

}