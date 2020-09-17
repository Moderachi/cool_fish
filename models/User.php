<?php

class User
{
    public static function delUser($userId)
    {
        $db = Db::getConnection();

        $sql = 'DELETE FROM user  WHERE id = :userId';

        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId);

        return $result->execute();
    }

    public static function changePassword($userId, $new)
    {
        $db = Db::getConnection();

        $sql = 'UPDATE user SET password = :new WHERE id = :userId';

        $result = $db->prepare($sql);
        $result->bindParam(':new', $new);
        $result->bindParam(':userId', $userId);

        return $result->execute();
    }


    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $email
     * @param string $password
     * @return mixed : ingeger user id or false
     */
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user;
        }

        return false;
    }

    public static function auth($user)
    {
        $_SESSION['userId'] = $user['id'];
        $_SESSION['userName'] = $user['name'];
        $_SESSION['userEmail'] = $user['email'];
        $_SESSION['userPassword'] = $user['password'];
        $_SESSION['userRole'] = $user['role'];
    }

    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['userId'])) {
            return $_SESSION['userId'];
        }

        header("Location: /user/login");
    }

    public static function isGuest()
    {
        if (isset($_SESSION['userId'])) {
            return false;
        }
        return true;
    }
    
    public static function getUserList()
    {
        $db = Db::getConnection();

        $userList = array();

        $result = $db->query('SELECT * FROM user '
            . 'ORDER BY id ASC ');

        $i = 0;
        while ($row = $result->fetch()) {
            $userList[$i]['id'] = $row['id'];
            $userList[$i]['name'] = $row['name'];
            $userList[$i]['email'] = $row['email'];
            $userList[$i]['password'] = $row['password'];
            $userList[$i]['role'] = $row['role'];
            $i++;
        }

        return $userList;
        
    }

     public static function getOrderList($userId)
    {
        $db = Db::getConnection();

        $orderList = array();

        $result = $db->query('SELECT * FROM history '
            . 'WHERE user_id = '.$userId.' '
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

    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();


            return $result->fetch();
        }
    }

    public static function register($name, $email, $password) {

        $db = Db::getConnection();
        
        $sql = 'INSERT INTO user (name, email, password) '
        . 'VALUES (:name, :email, :password)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result->execute();
    }
    
    /**
     * Returns an array of products
     */
    public static function getLatestFeedBack($count = self::SHOW_BY_DEFAULT, $page = 1)
    {
        $count = intval($count);
        $page = intval($page);
        $offset = ($page - 1) * $count;

        $db = Db::getConnection();
        $feedbackList = array();

        $result = $db->query('SELECT * FROM feedback '
            . 'ORDER BY id DESC ');

        $i = 0;
        while ($row = $result->fetch()) {
            $feedbackList[$i]['id'] = $row['id'];
            $feedbackList[$i]['author'] = $row['author'];
            $feedbackList[$i]['message'] = mb_split("\r\n", $row['message']);
            $feedbackList[$i]['date'] = $row['date'];
            $i++;
        }

        return $feedbackList;
    }

    public static function addFeedBack($author, $message) {
        $data = date("d.m.Y");
        $db = Db::getConnection();

        $sql = 'INSERT INTO feedback (author, message, date) '
        . 'VALUES (:author, :message, :data)';

        $result = $db->prepare($sql);
        $result->bindParam(':author', $author, PDO::PARAM_STR);
        $result->bindParam(':message', $message, PDO::PARAM_STR);
        $result->bindParam(':data', $data, PDO::PARAM_STR);

        return $result->execute();
    }
    
    public static function delFeedBack($id) {
        $db = Db::getConnection();

        $sql = 'DELETE FROM feedback WHERE id=:idf';
     
        $result = $db->prepare($sql);
        $result->bindParam(':idf', $id);
    
        return $result->execute();
    }
    /**
     * Проверяет имя: не меньше, чем 2 символа
     */
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет сообщение: 
     */
    public static function checkMessage($message) {
        if (strlen($message) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     */
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет email
     */
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public static function checkPhone($phone) {
        //$user_phone = '+7 (999) 999-99-99'; // Номер телефона

        // регулярка проверки номера телефона
        $reg_exp = '/\+7\s\(\d{3}\)\s\d{3}\-\d{2}-\d{2}\b/';

        $result = filter_var($phone, FILTER_VALIDATE_REGEXP, array(
            'options' => array(
                'regexp' => $reg_exp,
            ),
        ));

        return $result;        
        
    }

    public static function checkEmailExists($email) {

        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }
}