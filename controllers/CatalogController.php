<?php

class CatalogController
{

    public function actionIndex($page = 1)
    {

        $categories = array();
        $categories = Category::getCategoriesList();

        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(Product::SHOW_BY_DEFAULT, $page);

        $total = Product::getTotalProducts();

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');



        $titlePage = "Каталог";
        require_once(ROOT . '/views/site/index.php');

        return true;
    }

    public function actionCategory($categoryId, $page = 1)
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $categoryProducts = array();
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        $total = Product::getTotalProductsInCategory($categoryId);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, 4, 'page-');
        

        $titlePage = Category::getCategoryById($categoryId);
        $titlePage = $titlePage['name'];
        require_once(ROOT . '/views/catalog/category.php');

        return true;
    }

}
