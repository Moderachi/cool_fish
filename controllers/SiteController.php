<?php

include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';

class SiteController
{

    public function actionIndex()
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(8);

        $titlePage = "Самый КЛЁВый магазин";
        require_once ROOT . '/views/site/index.php';

        return true;
    }

    public function actionAbout()
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $titlePage = "О нас";
        require_once ROOT . '/views/site/about.php';

        return true;
    }

    

    public function actionContacts()
    {
        $categories = array();
        $categories = Category::getCategoriesList();


        $titlePage = "Контакты";
        require_once ROOT . '/views/site/contacts.php';

        return true;
    }

}
