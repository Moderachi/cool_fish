<?php

class Admin
{

    public static function checkUserRole()
    {
        if (isset($_SESSION['userRole']))
            if ($_SESSION['userRole'] == 'admin')
                return true;

        return false;
    }
    public static function m2t($millimeters){
        return floor($millimeters*56.7); //1 твип равен 1/567 сантиметра
    }
    public static function getInvoice($orderId)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);
        $sectionStyle = array(
                'marginTop' => Admin::m2t(20),
                'marginLeft' => Admin::m2t(30),
                'marginRight' => Admin::m2t(15),
                'marginBottom' => Admin::m2t(20),
                'borderTopColor' => 'C0C0C0'
         );
        // Adding an empty Section to the document...
        $section = $phpWord->addSection($sectionStyle);
        // Adding Text element to the Section having font styled by default...
        $section->addText(
            '«____» _____________20__г.','', array('align'=>'right')
        );
        $section->addText(
            'Организация: ИП Деникина Е.В.','', array('align'=>'left')
        );
        $section->addText();
        $section->addText(
            'НАКЛАДНАЯ №'.$orderId.'', $fontStyle = array('size'=>14, 'bold'=>TRUE, 'underline'=>\PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE), $paragraphStyle = array('align'=>'center')
        );
        $section->addText(
            'От кого _____________________________________________________________', $fontStyle = array('size'=>12, 'bold'=>false)
        );
        $section->addText(
            'Кому     _____________________________________________________________'
        );

        $tableStyle = array(
            'borderColor' => '000000',
            'borderSize'  => 6,
            'cellMargin'  => 50
        );
        $table = $section->addTable($tableStyle);
        $table->addRow();
        $table->addCell(Admin::m2t(10))->addText('№ П/П', '', array('align'=>'center'));
        $table->addCell(Admin::m2t(100))->addText('Наименование товара', '', array('align'=>'center'));
        $table->addCell(Admin::m2t(20))->addText('Ед. Изм.', '', array('align'=>'center'));
        $table->addCell(Admin::m2t(15))->addText('Количество', '', array('align'=>'center'));
        $table->addCell(Admin::m2t(15))->addText('Цена (руб.)', '', array('align'=>'center'));
        $table->addCell(Admin::m2t(20))->addText('Сумма (руб.)', '', array('align'=>'center'));

        include_once ROOT.'/models/Product.php'; 
        $order = Admin::getOrderById($orderId);
        $productsInCart = json_decode($order['products'], true);
        $productsIds = array_keys($productsInCart);
        $products = Product::getProdustsByIds($productsIds);
        $totalPrice = Product::getTotalPriceProducts($productsInCart);
        $i = 1;
        foreach ($products as $product){
            $table->addRow();
            $table->addCell(30)->addText($i, '', array('align'=>'center'));
            $table->addCell(80)->addText($product['name'], '', array('align'=>'center'));
            $table->addCell(30)->addText('шт.', '', array('align'=>'center'));
            $table->addCell(30)->addText($productsInCart[$product['id']], '', array('align'=>'center'));
            $table->addCell(30)->addText($product['price'], '', array('align'=>'center'));
            $table->addCell(30)->addText($productsInCart[$product['id']]*$product['price'], '', array('align'=>'center'));
            $i++;
        }
        $section->addText(
            'Итого: '.$totalPrice
        );
        $section->addText();
        $section->addText(
            'Сдал: __________________               Принял: ____________________'
        );
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('doc/'.$orderId.'.docx');
        //доработать стиль таблицы
        //строка "Итого" (объединение ячеек)
    }

    public static function getOrderById($orderId)
    {
        $id = intval($orderId);

        if ($id) {  
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM history '
                . 'WHERE order_id = '.$orderId);

            return $result->fetch();
        }    
    }
    
    public static function getOrderList()
    {
        $db = Db::getConnection();

        $orderList = array();

        $result = $db->query('SELECT * FROM history '
            . 'ORDER BY order_id DESC ');

        $i = 0;
        while ($row = $result->fetch()) {
            $orderList[$i]['order_id'] = $row['order_id'];
            $orderList[$i]['user_email'] = $row['user_email'];
            $orderList[$i]['user_name'] = $row['user_name'];
            $orderList[$i]['user_phone'] = $row['user_phone'];
            $orderList[$i]['products'] = $row['products'];
            $orderList[$i]['total_price'] = $row['total_price'];
            $orderList[$i]['date'] = $row['date'];
            $i++;
        }

        return $orderList;        
    }

    public static function goToAdmin()
    {
        header("Location: /admin");
    }

    public static function AddAdmin($userId)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE user SET role="admin" '
        . 'WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId);
        
        return $result->execute();
    }
    public static function DelAdmin($userId)
    {
        $db = Db::getConnection();
        
        $sql = 'UPDATE user SET role="" '
        . 'WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId);
        
        return $result->execute();
    }
    public static function addProduct($name, $category, $code, $price, $description, $filename)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO product (name, category_id, code, price, description, photo, availability, status) '
        . 'VALUES (:name, :category, :code, :price, :description, :photo, 1, 1)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':category', $category);
        $result->bindParam(':code', $code);
        $result->bindParam(':price', $price);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':photo', $filename, PDO::PARAM_STR);
        move_uploaded_file($_FILES['filename']['tmp_name'], substr($filename, 1));
        

        return $result->execute();
    }

    public static function editProduct($code, $name, $category, $brand, $price, $description, $filename)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE product SET name=:name, category_id=:category, brand=:brand, price=:price, description=:description, photo=:photo '
        . 'WHERE code=:code';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':code', $code);
        $result->bindParam(':category', $category);
        $result->bindParam(':brand', $brand);
        $result->bindParam(':price', $price);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':photo', $filename, PDO::PARAM_STR);
        move_uploaded_file($_FILES['filename']['tmp_name'], substr($filename, 1));
        
        return $result->execute();
    }

    public static function addCategory($name, $sort)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO category (name, sort_order, status) '
        . 'VALUES (:name, :sort, 1)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort', $sort);

        return $result->execute();
    }

    public static function editCategory($id, $name, $sort, $status)
    {
        $db = Db::getConnection();

        Product::hideOrShowProducts($id, $status);

        $sql = 'UPDATE category SET name=:name, sort_order=:sort, status=:status '
        . 'WHERE id=:id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort', $sort, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);

        return $result->execute();
    }
}