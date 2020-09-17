<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <div class="signup-form" ><!--sign up form-->
                    <h2 align="center">Добро пожаловать, <?php echo $titlePage; ?></h2>
                    <ul class="cabUL">
						<li><a href="/cabinet/history">История заказов</a></li>
						<li><a href="/feedback">Перейти к отзывам</a></li>
					</ul>
					<hr>		
					<ul class="cabUL">
						<li><a href="/cabinet/changePassword">Сменить пароль</a></li>
						<li><a href="#" id="delUser">Удилить аккаунт</a></li>
					</ul>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>