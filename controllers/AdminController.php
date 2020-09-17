<?php

class AdminController
{
	public function actionIndex()
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        $titlePage = 'Панель Администратора';
        require_once(ROOT . '/views/admin/index.php');

        return true;
    }
    

    public function actionHistoryItem($invoice)
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        $orderList = array();
        $orderList = Admin::getOrderList();
        require_once ROOT .'/components/vendor/autoload.php';
        Admin::getInvoice($invoice);
            
        $titlePage = 'Накладная №'.$invoice;
        require_once(ROOT . '/views/admin/historyItem.php');
        return true;
    }

    public function actionHistory()
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        $orderList = array();
        $orderList = Admin::getOrderList();

        $titlePage = 'История заказов';
        require_once(ROOT . '/views/admin/history.php');
        return true;
    }
    
    //$name, $category, $price, $description, $code, $brand, $photo
    public function actionEditProductAjax($id)
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        $product = array();
        $product = Product::getProductById($id);

        $categories = array();
        $categories = Category::getCategoriesList(0);

        $name = '';
        $code = '';
        $price = '';
        $category = '';
        $brand = '';
        $description = '';
        $filename = '';

        $result = false;

        if(isset($_POST['edit-product'])){
            $name = $_POST['name'];
            $code = $_POST['code'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $brand = $_POST['brand'];
            
            $errors = false;
            if(isset($_POST['category']))
            {
                $category = $_POST['category'];
            }
            else
            {
                $errors[] = "Выберите категорию";
            }

            if ($_FILES && $_FILES['filename']['error'] == UPLOAD_ERR_OK)
            {
                $filename = '/template/images/product-details/'.$_FILES['filename']['name'];
            }



            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            
            if ($price == '') {
                $errors[] = 'Укажите цену';
            }

            if ($errors == false) {
                $result = Admin::editProduct($code, $name, $category, $brand, $price, $description, $filename);
            }

            // echo $errors.'<br>';
            // echo $name.'<br>';
            // echo $price.'<br>';
            // echo $code.'<br>';
            // echo $brand.'<br>';
            // echo $category.'<br>';
            // echo $description.'<br>';
            // echo $filename.'<br>';
        }

        $titlePage = 'Редактирование товара '.$product['name'];
        require_once(ROOT . '/views/admin/editProductItem.php');
        return true;
    }

    public function actionEditProduct()
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(Product::SHOW_BY_DEFAULT);

        $categories = array();
        $categories = Category::getCategoriesList(0);

        $titlePage = 'Редактирование товара';
        require_once(ROOT . '/views/admin/editProduct.php');
        return true;
    }

    public function actionAddProduct()
    {
        if(!Admin::checkUserRole())
            header("Location: /");
    	$categories = array();
        $categories = Category::getCategoriesList(0);

        $result = false;
        if(isset($_POST['add-product'])){

            $name = '';
            $code = '';
            $price = '';
            $category = '';
            $description = '';
            $filename = '';


            $name = $_POST['name'];
            $code = $_POST['code'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            
            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            
            if (strlen($description) <= 6) {
                $errors[] = 'Неправильное описание';
            }

            if(isset($_POST['category']))
            {
                $category = $_POST['category'];
            }
            else
            {
                $errors[] = "Выберите категорию";
            }


            if ($_FILES && $_FILES['filename']['error'] == UPLOAD_ERR_OK)
            {
                $filename = '/template/images/product-details/'.$_FILES['filename']['name'];

                if(!isset($errors)){
                    unset($_FILES['filename']);
                }
            }
            else
            {
                $errors[] = 'Файл не выбран';
            }
            if ($errors == false) {
                $result = Admin::addProduct($name, $category, $code, $price, $description, $filename);
            }
        }


        $titlePage = 'Добавление товара';
        require_once(ROOT . '/views/admin/addProduct.php');

        return true;
    }

    public function actionAddCategory()
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        $categories = array();
        $categories = Category::getCategoriesList(0);
        $result = false;
        if(isset($_POST['add-category']))
        {
            $name = '';
            $sort = '';

            $name = $_POST['name'];
            
            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }

            foreach ($categories as $categoryItem) {
                if($categoryItem['name'] == $name)
                    $errors[] = "Категория с таким названием уже существует";
            }

            if(isset($_POST['sort']))
            {
                 $sort = $_POST['sort'];
            }
            else
            {
                $errors[] = "Выберите приоритет для категории";
            }

            if ($errors == false) {
                $result = Admin::addCategory($name, $sort);
            }
        }


        $titlePage = 'Добавление категории';
        require_once(ROOT . '/views/admin/addCategory.php');

        return true;
    }

    public function actionEditCategory()
    {
        // echo '<pre>';
        // print_r(Category::getCategoryById(13));
        // echo '</pre>';
        if(!Admin::checkUserRole())
            header("Location: /");
        $categories = array();
        $categories = Category::getCategoriesList(0);
        $result = false;
        if(isset($_POST['edit-category']))
        { 
            $name = '';
            $sort = '';
            $categoryId = '';
            $check = '';
            if(isset($_POST['checkme']))
                $check = 1;
            else
                $check = 0;

            if(isset($_POST['category']))
            {
                 $categoryId = $_POST['category'];
            }
            else
            {
                $errors[] = "Выберите приоритет для категории";
            }

            $name = $_POST['name'];

            if(isset($_POST['sort']))
            {
                 $sort = $_POST['sort'];
            }
            else
            {
                $errors[] = "Выберите приоритет для категории";
            }

            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }

            foreach ($categories as $categoryItem) {
                if($categoryItem['name'] == $name && $categoryItem['sort_order'] == $sort && $categoryItem['id'] != $categoryId)
                    $errors[] = "Категория с таким названием уже существует";
            }

            if ($errors == false) {
                $result = Admin::editCategory($categoryId, $name, $sort, $check);
            }
        }


        $titlePage = 'Редактирование категории';
        require_once(ROOT . '/views/admin/editCategory.php');

        return true;
    }

    public function actionDelCategoryAjax($id)
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        return Category::delCategory($id);       
    }

    public function actionAddAdmin()
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        $userList = array();
        $userList = User::getUserList();

        $titlePage = 'Добавление модератора';
        require_once(ROOT . '/views/admin/addAdmin.php');
        return true;
    }
    public function actionDelAdmin()
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        $userList = array();
        $userList = User::getUserList();

        $titlePage = 'Удаление модератора';
        require_once(ROOT . '/views/admin/delAdmin.php');
        return true;
    }
    public function actionAddAdminAjax($userId)
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        return Admin::AddAdmin($userId);
    }
    public function actionDelAdminAjax($userId)
    {
        if(!Admin::checkUserRole())
            header("Location: /");
        return Admin::DelAdmin($userId);
    }
    public function actionChangePassword()
    {
        // $userList = array();
        // $userList = User::getUserById($_SESSION['userId']);
        if(!Admin::checkUserRole())
            header("Location: /");

        $result = false;
        if(isset($_POST['change-password']))
        {
            $user = User::getUserById($_SESSION['userId']);

            $pastPass = '';
            $newPass = '';
            $checkPass = '';
            
            $pastPass = $_POST['past'];
            $newPass = $_POST['new'];
            $checkPass = $_POST['check'];

            $errors = false;
            
            if ($pastPass != $user['password'])
                $errors[] = 'Неправильный старый пароль';

            if ($newPass != $checkPass)
                $errors[] = 'Пароли не совпадают';

            if (strlen($newPass) < 6) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($errors == false) {
                $result = User::changePassword($user['id'], $newPass);
            }
        }


        $titlePage = 'Сменить пароль';
        require_once(ROOT . '/views/admin/changePassword.php');

        return true;
    }
}