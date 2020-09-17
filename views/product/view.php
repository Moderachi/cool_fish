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
    </div>
    
    <div class="content">
        <div class="product-details">
            <div style="display: flex;"><!--product-details-->
                <div class="row">
                    <div class="view-product">
                        <img src="<?php if($product['photo'] != '') echo $product['photo']; else echo 'https://www.monsterfishgroup.com/upload/iblock/dbb/dbbb015406b2bed27759e1d6be2b4a61.jpg'; ?>" alt="" />
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="product-information"><!--/product-information-->
                        <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                        <div>
                            <h2 class="title-name"><?php echo $product['name'];?></h2>
                            <hr class="title-name">
                        </div>
                        <p><b>Наличие:</b> На складе</p>
                        <p><b>Код товара:</b> <?php echo $product['code'];?></p>
                        <br><br>
                        <div style="display: flex; margin-top: 25px;">
                            <span class="product-price"><b>Цена: </b><?php echo $product['price'];?> руб.</span><br>
                            <div><a href="/cart/add/<?php echo $product['id']; ?>" class="btn  cart">Купить</a></div>
                            <br><br>
                            <span id="hint-<?php echo $product['id']; ?>" class="real-hint">Товар добавлен</span>
                        </div>

                    </div><!--/product-information-->
                    <div style="display: flex; margin: 20px;">
                        <a href="../contacts" class="show-info">График работы</a>
                        <a href="../contacts" class="show-info">Адрес и контакты</a>
                    </div>
                </div><!--/product-details-->

            </div>
            <div class="row">                                
                <div class="col-sm-12">
                    <h5>Описание товара</h5>
                    <div>
                        <p><?php echo $product['description'];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>