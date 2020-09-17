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
            <h2>Контактная информация</h2>
            <hr class="title-name">
            
            <div class="map">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aa911ae71dfccd4ea9054c4742113a12e6f905ce04c7dbca22c174b28d0750890&amp;width=80%&amp;height=350&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
            <div class="contacts" style="font-size: 16px;" >

                <div class="contacts-section">
                    <div title="Адрес">
                        <dt>Адрес
                            <hr>
                        </dt>
                        <dd>
                            <div class="icon-location" title="Адрес"><a href="/contacts"><span>Красноярский край Богучанский р-н ул. Октябрьская, 81</span></a></div>
                        </dd>
                    </div>
                    <div title="Название компании">
                        <dt>Название компании
                            <hr>
                        </dt>
                        <dd>
                            <span class="icon-users"><span>ИП Деникина</span></span>
                        </dd>
                    </div>
                    <div title="Контактное лицо">
                        <dt>Контактное лицо
                            <hr>
                        </dt>
                        <dd>
                            <div class="icon-user" title="Контактное лицо"><span>Менеджер</span></div>
                        </dd>
                    </div>
                </div>
                <div class="contacts-section" title="Контакты">
                    <dl>
                        <dt>Контакты
                            <hr>
                        </dt>
                        <dd>
                            <div class="icon-phone"><span>+7(999)999-99-99</span></div>
                        </dd>
                        <dd>
                            <a class="icon-envelop" href=""><span>cool_shop_fish@mail.ru</span></a>
                        </dd>
                    </dl>
                </div>
                <div class="contacts-section" title="График работы">
                    <dt>График работы
                        <hr>
                    </dt>
                    <table>
                        <tr>
                            <td>Понедельник</td>
                            <td>10:00-20:00</td>
                        </tr>
                        <tr>
                            <td>Вторник</td>
                            <td>10:00-20:00</td>
                        </tr>
                        <tr>
                            <td>Среда</td>
                            <td>10:00-20:00</td>
                        </tr>
                        <tr>
                            <td>Четверг</td>
                            <td>10:00-20:00</td>
                        </tr>
                        <tr>
                            <td>Пятница</td>
                            <td>10:00-20:00</td>
                        </tr>
                        <tr>
                            <td>Суббота</td>
                            <td>10:00-18:00</td>
                        </tr>
                        <tr>
                            <td>Воскресенье</td>
                            <td>10:00-18:00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php';?>