<?php

class UserController
{
    public function actionFeedback()
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $lastestfeedbacks = array();
        $lastestfeedbacks = User::getLatestFeedBack(10);
        
        if(isset($_POST['add-feedback'])){

            $author=strip_tags($_POST['author']);
            $message = strip_tags($_POST['message']);


            if(User::checkName($author) && User::checkMessage($message) && User::addFeedBack($author, $message)){
                header('Location: /feedback');
                exit();
            }
            else{
                $errors['feedback'] = 'Введите корректные данные';
            }

        } 

        $titlePage = "Отзывы";
        require_once ROOT . '/views/user/feedback.php';

        return true;
    }

    public function actionDelFeedbackAjax($id)
    {
        return User::delFeedback($id);
    }

    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            
            if ($errors == false) {
                $result = User::register($name, $email, $password);
            }

        }


        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';
        $result = false;
        
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            // Валидация полей
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }            
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Проверяем существует ли пользователь
            $user = User::checkUserData($email, $password);

            if ($user['id'] == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($user);

                if($user['role'] == 'admin')
                    header("Location: /admin");
                else
                // Перенаправляем пользователя в закрытую часть - кабинет 
                    header("Location: /cabinet/"); 
            }
        }

        $titlePage = "Вход";
        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    public function actionCabinet()
    {
        if(Admin::checkUserRole())
            Admin::goToAdmin();


        User::checkLogged();

        
        $titlePage = $_SESSION['userName'];

        require_once(ROOT . '/views/user/cabinet.php');

        return true;    
    }

    public function actionHistory()
    {
        if(Admin::checkUserRole())
            // Admin::goToAdmin();


        User::checkLogged();

        $orderList = array();
        $orderList = User::getOrderList($_SESSION['userId']);

        $titlePage = 'История заказов пользователя: '.$_SESSION['userName'];

        require_once(ROOT . '/views/user/history.php');

        return true;    
    }
    public function actionChangePassword()
    {
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
        require_once(ROOT . '/views/user/changePassword.php');

        return true;
    }

    public function actionDelUser()
    {
        User::delUser($_SESSION['userId']);
        session_destroy();
        require_once(ROOT . '/views/user/changePassword.php');

        return true;
    }
    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        session_destroy();


        header("Location: /");
    }
}