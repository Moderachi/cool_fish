
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/template/css/main.css">
    <link rel="stylesheet" href="/template/css/product.css">
    <link rel="stylesheet" href="/template/css/icomoon.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Source+Sans+Pro" rel="stylesheet">
    <title><?php if(isset($titlePage)) echo $titlePage; else echo trim($_SERVER['REQUEST_URI'], '/'); ?></title>
</head>

<body>
    <div class="header">
        <div class="header-1">
            <div class="icon-phone"><span>+7(999)999-99-99</span></div>
            <div class="delivery">
                <a href="/feedback">Отзывы</a>
            </div>
            <div class="basket">
                <a href="/cart" class="icon-cart"><span>Корзина</span>(<span id="cart-count"><?php echo Cart::countItems();?></span>)</a>
            </div>
            <div class="user" style="position: absolute; right: 50px;">
                <?php if (User::isGuest()): ?> 
                    <a href="/user/register"><span>Регистрация</span></a>
                    <a href="/user/login" class="icon-user"><span>Вход</span></a>
                <?php else: ?>
                    <?php if(Admin::checkUserRole()): ?>
                        <a href="/cabinet/"><span>Панель администратора</span></a>
                    <?php else: ?>
                        <a href="/cabinet/"><span>Аккаунт</span></a>
                    <?php endif; ?>
                    <a href="/user/logout/"><span>Выход</span></a>
                <?php endif; ?>
            </div>
        </div>
        <div class="header-2" style="height: 50px;">
            
        </div>
        <div class="clearfix"></div>
        <div class="header-3">
            <div class="top-menu-wrapper">
                <a class="top-menu__link" href="/">Главная</a>
                <a class="top-menu__link" href="/catalog">Каталог</a>
                <a class="top-menu__link" href="/about_us">О нас</a>
                <a class="top-menu__link" href="/contacts">Контакты</a>
            </div>
        </div>


    </div>
