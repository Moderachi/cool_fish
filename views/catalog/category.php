<?php include ROOT . '/views/layouts/header.php';?>

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
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 padding-right">
                        <h2 class="title text-center"><?php $item = Category::getCategoryById($categoryId); echo $item['name'];?></h2>
                        <div class="product-items"><!--features_items-->

                            <?php foreach ($categoryProducts as $product): ?>
                                
                                <div class="product-item">
                                    <div class="single-products">
                                        <div class="productinfo text-center" align="center">
                                            <a href="/product/<?php echo $product['id']; ?>"><img src="<?php if($product['photo'] != '') echo $product['photo']; else echo 'https://www.monsterfishgroup.com/upload/iblock/dbb/dbbb015406b2bed27759e1d6be2b4a61.jpg'; ?>" alt="" /></a>
                                            
                                            <p>
                                                <a href="/product/<?php echo $product['id']; ?>">
                                                    <?php echo $product['name']; ?>
                                                </a>
                                            </p>
                                            <p><?php echo $product['price']; ?> руб.</p>
                                            <a href="#" data-id="<?php echo $product['id']; ?>" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart icon-cart"></i>
                                                В корзину
                                            </a>
                                            <br><br>
                                            <span id="hint-<?php echo $product['id']; ?>" class="real-hint">Товар добавлен</span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <?php echo $pagination->get(); ?>
            </div>
        </div>
    </section>

    <?php include ROOT . '/views/layouts/footer.php';?>