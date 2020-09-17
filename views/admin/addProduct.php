<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 padding-right">
				<div class="form" align="center" ><!--sign up form-->
					<h2 >Добавить товар</h2>
					<div class="row">
						<?php if ($result): ?>
							<p>Товар добавлен!</p>
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
									<input type="text" class="in-product" placeholder="Имя" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>"/>
									<select name="category" id="category" >
										<option selected disabled>Выберите категорию</option>
										<?php foreach ($categories as $categoryItem): ?>
											<option value="<?php echo $categoryItem['id']; ?>" <?php if (isset($_POST['category']) && $_POST['category'] == $categoryItem['id']) echo 'selected'; ?> >
												<?php echo $categoryItem['name']; ?>
											</option>
										<?php endforeach;?>
									</select><br><br>	
									<input type="number" class="in-product" placeholder="Код" name="code" value="<?php if(isset($_POST['code'])) echo $_POST['code'];?>"/>
									<input type="number" class="in-product" placeholder="Цена" name="price" value="<?php if(isset($_POST['price'])) echo $_POST['price'];?>"/>
									<textarea class="in-product" cols="40" rows="10" placeholder="Описание товара" name="description"><?php if(isset($_POST['description'])) echo $_POST['description'];?></textarea>
									<input id="image_file" accept="image/*,image/jpeg" type="file" name="filename" />

									<br><br>
									<div class="form-group text-right" style="display: inline-block;">
										<input id="admin-cancel" type="reset" value="Назад" class="btn btn-default" />
										<input type="submit" name="add-product" value="Добавить" class="btn btn-success" />
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