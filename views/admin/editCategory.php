<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 padding-right">
				<div class="form" align="center" ><!--sign up form-->
					<h2 >Редактировать категорию</h2>
					<div class="row">
						<?php if ($result): ?>
							<p>Редактирование прошло успешно!</p>
							<a href="/admin" class="btn btn-default">Назад</a>
							<?php else: ?>
								<?php if (isset($errors) && is_array($errors)): ?>
								<ul>
									<?php foreach ($errors as $error): ?>
										<li><?php echo $error; ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							<div>
								
								<form enctype="multipart/form-data" id="add-product" method="POST">
									<select name="category" id="category" >
										<option selected disabled>Выберите категорию</option>
										<?php foreach ($categories as $categoryItem): ?>
											<option value="<?php echo $categoryItem['id']; ?>" data-sort="<?php echo $categoryItem['sort_order']; ?>">
												<?php echo $categoryItem['name']; ?>
											</option>
										<?php endforeach;?>
									</select><br><br>

									<input type="text" id="catName" class="in-product" placeholder="Новое имя" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>"/><br>
									<select name="sort" id="sortCat">
										<option selected disabled>Задать приоритет категории</option>
										<?php for ($i=1; $i<=10; $i++): ?>
											<option value="<?php echo $i; ?>">
												<?php echo $i; ?>
											</option>
										<?php endfor;?>
									</select><br><br>
									<label><input type="checkbox" name="checkme">Включить/Выключить категорию</label>
										

									<br><br>


									<br><br>
									<div class="form-group text-right" style="display: inline-block;">
										<input id="admin-cancel" type="reset" value="Назад" class="btn btn-default" />
										<input type="submit" name="edit-category" value="Применить" class="btn btn-success" />
										<input type="button" value="Удалить" class="delete-category btn btn-default" />
									</div>
								</form>
							</div>
						<?php endif; ?>
					</div>
				</div><!--/sign up form-->
				<br><br>
			</div>
		</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>