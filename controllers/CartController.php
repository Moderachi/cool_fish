<?php

class CartController
{

    public function actionAdd($id)
    {
        // Добавляем товар в корзину
        Cart::addProduct($id);

        // Возвращаем пользователя на страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    public function actionDelProductOutCart($id)
    {
        // Удаляем товар из корзины
        Cart::delProduct($id);
        // Возвращаем пользователя на страницу
        header("Location: /cart");
        
        return true;
    }

    public function actionReduceAjax($id)
    {
        Cart::reduceProduct($id);
            // Возвращаем пользователя на страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
        
        return true;
    }

    public function actionAddAjax($id)
    {
        // Добавляем товар в корзину
        echo Cart::addProduct($id);
        
        return true;
    }

    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $productsInCart = false;

        // Получим данные из корзины
        $productsInCart = Cart::getProducts();

        $titlePage = 'Корзина';

        if ($productsInCart) {
            // Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProdustsByIds($productsIds);
            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once(ROOT . '/views/cart/index.php');



        return true;
    }

    public function actionCheckout()
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $productsInCart = false;

        // Получим данные из корзины
        $productsInCart = Cart::getProducts();

        $titlePage = 'Корзина';

        if ($productsInCart) {
            // Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProdustsByIds($productsIds);

            // Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }

        $result = false;
        if(isset($_POST['submit'])){
            $name = '';
            $phone = '';
            $email = '';
            $comment = '';

            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            
            if (!User::checkEmail($email)) {
                $errors[] = 'Не корректный e-mail';
            }
            if (!User::checkPhone($phone)) {
                $errors[] = 'Не корректный номер телефона';
            }

            if ($errors == false) {
                $result = Cart::checkout($name, $phone, $email, $comment, $productsInCart);
            }


        }


        require_once(ROOT . '/views/cart/checkout.php');

        return true;
    }

}
