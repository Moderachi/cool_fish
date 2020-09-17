<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 padding-right">
				<div class="signup-form" ><!--sign up form-->
					<h2 align="center">Добро пожаловать, <?php echo $_SESSION['userName']; ?></h2>
					<ul class="adminUL">
						<li><a href="/admin/history">Просмотр истории</a></li>
						<li><a href="/feedback">Просмотр отзывов</a></li>
					</ul>
					<hr>	
					<ul class="adminUL">
						<li><a href="/admin/addProduct">Добавить товар</a></li>
						<li><a href="/admin/editProduct">Редактировать или удалить товар</a></li>
						<li><a href="/admin/addCategory">Добавить категорию</a></li>
						<li><a href="/admin/editCategory">Редактировать или удалить категорию</a></li>
					</ul>
					<hr>	
					<ul class="adminUL">
						<li><a href="/admin/changePassword">Сменить пароль</a></li>
						<li><a href="/admin/addAdmin">Добавить модератора</a></li>
						<li><a href="/admin/delAdmin">Удилить модератора</a></li>
					</ul>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>