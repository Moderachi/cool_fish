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
                    <div class="col-sm-4 col-sm-offset-4 padding-right">
                        <style>

                    </style>
                    <div class="signup-form"><!--sign up form-->
                        <h2>Корзина</h2>
                        <?php if ($productsInCart): ?>
                            <table cellpadding="10px">
                                <tr>
                                    <th>Код товара</th>
                                    <th>Название</th>
                                    <th>Количество, шт.</th>
                                    <th>Цена за шт, руб.</th>
                                    <th></th>
                                </tr>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?php echo $product['code']; ?></td>
                                        <td><?php echo $product['name']; ?></td>
                                        <td style="min-width: 150px;">
                                            <a href="/cart/reduce/<?php echo $product['id'];?>" class="btn">-</a>
                                            <input disabled style="width: 50px; height: 35px; text-align: center; padding: 0; font-size: 17px;" type="text" value="<?php echo $productsInCart[$product['id']];?>">
                                            <a href="/cart/add/<?php echo $product['id'];?>" class="btn">+</a>
                                        </td>
                                        <td><?php echo $product['price'];?></td>
                                        <td><a href="/cart/del/<?php echo $product['id'];?>" class="btn">Удалить</a></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3">Общая стоимость:</td>
                                    <td><?php echo $totalPrice;?></td>
                                </tr>
                            </table>
                            <br>
                            <a href="/cart/checkout" class="btn">Оформить заказ</a>
                        <?php else: ?>
                            <p>Корзина пуста</p>
                        <?php endif; ?>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>