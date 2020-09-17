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
            <h3 class="title-name">Отзывы</h3>
            <hr class="title-name">
            <div id="show-form" style="padding: 10px 0px 25px; display: inline-block;"><a class="btn">Добавить отзыв</a></div>
            
            <style>
            
        </style>
        <div class="row">
            <?php if(isset($errors['feedback'])) echo $errors['feedback']; ?>

            <div class="sub-feedback <?php if(!isset($errors['feedback'])) echo 'hide'; ?>">

                <form id="add-feedback" method="POST">
                    <input type="text" class="in-feedback" placeholder="Имя" name="author" value="<?php if(isset($_SESSION['userName'])) echo $_SESSION['userName'];?>">
                    <textarea class="in-feedback" cols="40" rows="10" placeholder="Текст сообщения" name="message"><?php if(isset($_POST['message'])) echo $_POST['message'];?></textarea>
                    <div class="form-group text-right">
                        <input id="cancel" type="reset" value="Отмена" class="btn btn-default" />   
                        <input id="enter" type="submit" name="add-feedback" value="Отправить" class="btn btn-success" />
                    </div>
                </form>
            </div>
        </div>


        <div id="feedback" <?php if(isset($errors['feedback'])) echo 'class="hide"'; ?>>
            <?php foreach ($lastestfeedbacks as $feedback): ?>
                <div class="row" style="display: flex; border: 1px solid; padding: 25px; margin: 15px 0px;">
                    <div class="feedback-info">
                        <h4 class="title-name"><?php echo $feedback['author']; ?></h4>
                        <span class="date"><?php echo $feedback['date']; ?></span><br>
                    </div>
                    <div class="feedback-message">
                        <?php foreach ($feedback['message'] as $paragraph): ?>
                            <p><?php echo $paragraph; ?></p>
                        <?php endforeach; ?>
                    </div>
                    <?php if(Admin::checkUserRole()): ?>
                        <div style="margin: auto 0 0 auto;"><a class="btn delete-feedback" data-id="<?php echo $feedback['id']; ?>">Удалить</a></div>
                    <?php endif;?>
                </div>
            <?php endforeach;?>

        </div>
    </div>
</div>
</section>
<?php include ROOT . '/views/layouts/footer.php';?>