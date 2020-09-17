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
            <h3 class="title-name">О нас</h3>
            <hr class="title-name">
            <h2 align="center">Магазин "КЛЁВый" открылся в Августе 2015 года.</h2>
            <p class="text-content">Не смотря на столь молодой возраст, в наших магазинах Вы можете приобрести товары для всех известных видов ловли на любое время года.</p>
            <p class="text-content">Все наши покупатели довольны качеством обслуживания, ценовой политикой и предлагаемым ассортиментом.</p>
            <p class="text-content">Одним словом "душевный магазин", где каждый покупатель подберёт для себя именно то, что поможет ему поймать "РЫБУ МЕЧТЫ" !!!</p>
            <p class="text-content">Магазин находится по адресу: <a href="contacts">Красноярский край Богучанский р-н ул. Октябрьская, 81</a></p>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php';?>