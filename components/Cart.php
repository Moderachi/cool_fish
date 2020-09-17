<?php

class Cart
{
    public static function delProduct($id)
    {
        $id = intval($id);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        // Если в корзине уже есть товары (они хранятся в сессии)
        if (isset($_SESSION['products'])) {
            // То заполним наш массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если товар есть в корзине, удалить товар из корзины
        if (array_key_exists($id, $productsInCart)) {
            unset($productsInCart[$id]);
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    public static function reduceProduct($id)
    {
        $id = intval($id);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        // Если в корзине уже есть товары (они хранятся в сессии)
        if (isset($_SESSION['products'])) {
            // То заполним наш массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если товар есть в корзине, уменьшим количество
        if (array_key_exists($id, $productsInCart)) {
            if($productsInCart[$id] <= 1)
                $productsInCart[$id] = 0;
            else
                $productsInCart[$id] --;
        } 

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    /**
     * Добавление товара в корзину (сессию)
     * @param int $id
     */
    public static function addProduct($id)
    {
        $id = intval($id);

        // Пустой массив для товаров в корзине
        $productsInCart = array();

        // Если в корзине уже есть товары (они хранятся в сессии)
        if (isset($_SESSION['products'])) {
            // То заполним наш массив товарами
            $productsInCart = $_SESSION['products'];
        }

        // Если товар есть в корзине, но был добавлен еще раз, увеличим количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++;
        } else {
            // Добавляем нового товара в корзину
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    /**
     * Подсчет количество товаров в корзине (в сессии)
     * @return int 
     */
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }

    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();

        $total = 0;
        
        if ($productsInCart) {            
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }

        return $total;
    }

    public static function checkout($name, $phone, $email, $comment, $productsInCart)
    {   
        //moderator-email = cool_shop_fish@mail.ru
        //password = qwer1234qwer
        if (isset($_SESSION['userId'])) $user_id = $_SESSION['userId'];
        else $user_id = 0;
        $table = '';
        
        // Получаем полную информацию о товарах для списка
        $productsIds = array_keys($productsInCart);
        $products = Product::getProdustsByIds($productsIds);

        // Получаем общую стоимость товаров
        $totalPrice = Cart::getTotalPrice($products);

        foreach ($products as $product){
            $table .= '<tr><td>'.$product['code'].'</td><td>'.$product['name'].'</td><td>'.$productsInCart[$product['id']].'</td><td>'.$product['price'].'</td><td>'.$productsInCart[$product['id']]*$product['price'].'</td></tr>';
        }
        
        $order_id = Cart::AddHistory($user_id, $email, $name, $phone, $productsInCart, $totalPrice);
        $date = date("d.m.Y", (time()+3600*24*15));
        $to      = $email;
        $subject = 'Заказ принят в интернет-магазин КЛЁВый';
        $message = '
                    <html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <title>Заказ принят в интернет-магазин www.coolshop.ru</title>
                        </head>
                        <body>'
                            .'Номер заказа: '.$order_id.'<br>'
                            .'Состав заказа:<br>'
                            .'<table><tr><th>Артикул</th><th>Наименование</th><th>Количество</th><th>Цена</th><th>Стоимость</th></tr>'
                            .$table
                            .'<tr><td></td><td></td><td></td><td>Итого:</td><td>'.$totalPrice.'</td></tr></table><br>'
                            .'Ожидаемая дата поступления заказа на пункт самовывоза: <b>'.$date.'</b><br>';
                            if($comment != '') $message .= 'Ваш комментарий: '.$comment.'<br>';
        $message .= '<br>Интернет-магазин КЛЁВый
                                </body>
                        </html>';
        // устанавливаем тип сообщения Content-type, если хотим
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=utf-8 \r\n";

        unset($_SESSION['products']);

        return mail($to, $subject, $message, $headers);
    }

    public static function AddHistory($user_id, $user_email, $user_name, $user_phone, $products, $totalPrice)
    {
        $products = json_encode($products);

        $db = Db::getConnection();

        $sql = 'INSERT INTO history (user_id, user_email, user_name, user_phone, products, total_price) '
        . 'VALUES (:user_id, :user_email, :user_name, :user_phone, :products, :total_price)';
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $user_id);
        $result->bindParam(':user_email', $user_email);
        $result->bindParam(':user_name', $user_name);
        $result->bindParam(':user_phone', $user_phone);
        $result->bindParam(':products', $products);
        $result->bindParam(':total_price', $totalPrice);

        $result->execute();

        return $db->lastInsertId();
    }
}
