<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div style="display: flex;">
        <div>
            <div class="left-menu">
                <span class="title-name">Категории</span>
                <hr class="title-name">

                <?php foreach ($categories as $categoryItem): ?>
                    <div class="left-menu-item">
                        <a href="/category/<?php echo $categoryItem['id']; ?>" class="<?php if ($categoryId == $categoryItem['id']) echo 'active'; ?>">
                            <?php echo $categoryItem['name']; ?>
                        </a>
                    </div><hr>
                <?php endforeach;?>

            </div>
            <div class="left-menu">
                <span class="title-name">Контакты</span>
                <hr class="title-name">

            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-4 ">
                        <h2>Оформление заказа</h2>
                        <?php if ($result): ?>
                            <p>Заказ обрабатывается!</p>
                            <p>Проверте почту. Вы указали <?php if(isset($email)) echo $email; ?></p>
                            <a href="/" class="btn btn-default">Назад</a>
                            <?php else: ?>
                                <p style="padding: 10px;">Вы выбрали <?php echo Cart::countItems(); ?> товаров общей стоимостью <?php echo $totalPrice; ?> рублей.</p>
                                <?php if (isset($errors) && is_array($errors)): ?>
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li><?php echo $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            <form method="post">
                                <table class="tbl-cart">
                                    <tr>
                                        <td>Имя*</td>
                                        <td>
                                            <input type="text" name="name" placeholder="Имя" value="<?php if(isset($_SESSION['userName'])) echo $_SESSION['userName']; elseif(isset($name)) echo $name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Номер телефона*</td>
                                        <td><input type="text" id="phone" name="phone" placeholder="Номер телефона" value="<?php if(isset($phone)) echo $phone; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Электронная почта*</td>
                                        <td>
                                            <input type="text" name="email" placeholder="Электронная почта" value="<?php if(isset($_SESSION['userEmail'])) echo $_SESSION['userEmail']; elseif(isset($email)) echo $email; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Комментарий</td>
                                        <td>
                                            <textarea class="in-cart" name="comment" placeholder="Комментарий"><?php if(isset($comment)) echo $comment; ?></textarea>
                                        </td>
                                    </tr>

                                    <tr><td><input id="cart-cancel" style="width: 80px; float: right;" value="Назад" class="btn" /></td><td><input style="width: 150px;" class="btn" type="submit" name="submit" value="Отправить заказ"></td></tr>
                                </table>
                            </form>
                        <?php endif; ?>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>