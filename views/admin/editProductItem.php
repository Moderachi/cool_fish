<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 padding-right">
				<div class="form" ><!--sign up form-->
					<h2  align="center">Редактирование</h2>
					<div class="row" align="center">
						<?php if ($result): ?>
							<p>Товар обновлен!</p>
							<a href="/admin" class="btn btn-default">Назад</a>
							<?php else: ?>
								<?php if (isset($errors) && is_array($errors)): ?>
								<ul>
									<?php foreach ($errors as $error): ?>
										<li><?php echo $error; ?></li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							<div id="product" >
								<form data-id="<?php echo $product['id']; ?>" enctype="multipart/form-data" method="post">
									<div class="row" style="display: flex; flex-direction: column; border: 1px solid; padding: 25px; margin: 15px 0px;">
										<div class="row" style="display: flex; padding: 25px; margin: 15px 0px;">
											<div class="view-product">
												Код товара: <a class="date" data-id="<?php echo $product['id']; ?>"><?php echo $product['code']; ?></a><br>
												<input class="hide" name="code" value="<?php echo $product['code']; ?>">
												<div style="margin: 50px auto; border: 1px dashed; padding: 100px 50px;">
													<input id="image_file" data-id="<?php echo $product['id']; ?>" accept="image/*,image/jpeg" type="file" name="filename">
												</div>
											</div>
											<div class="product-info" style="margin: 50px;">
												<h3 class="title-name" >Название товара*: <br>
													<input style="width: 100%" type="text" data-id="<?php echo $product['id']; ?>" placeholder="Название товара" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']; else echo $product['name'];?>">
												</h3>
												<h4 class="">Цена*: 
													<input type="number" data-id="<?php echo $product['id']; ?>" placeholder="Цена" name="price" value="<?php if(isset($_POST['price'])) echo $_POST['price']; else echo $product['price'];?>"> руб.
												</h4>
												Категория*: 
												<select data-id="<?php echo $product['id']; ?>" name="category" id="category" >
													<option selected disabled>Выберите категорию</option>
													<?php foreach ($categories as $categoryItem): ?>
														<option value="<?php echo $categoryItem['id']; ?>" <?php if (isset($_POST['category']) && $_POST['category'] == $categoryItem['id']) echo 'selected'; elseif ($categoryItem['id'] == $product['category_id']) echo 'selected'; ?> >
															<?php echo $categoryItem['name']; ?>
														</option>
													<?php endforeach;?>
												</select><br><br>	
												Фирма: <input type="text" data-id="<?php echo $product['id']; ?>" placeholder="Фирма" name="brand" value="<?php if(isset($_POST['brand'])) echo $_POST['brand']; else echo $product['brand'];?>">
											</div>
											<div class="product-desc">
												<p>Описание товара: 
													<textarea data-id="<?php echo $product['id']; ?>" cols="75" rows="12" style="font-size: 16px; resize: none; width: 90%;" placeholder="Описание товара" name="description">
														<?php if(isset($_POST['description'])) echo trim($_POST['description'], " "); else echo trim($product['description'], " "); ?>
													</textarea>
												</p>
											</div>
										</div>
										<div class="product-btns">
												<a href="/admin/editProduct" class="btn cancel-product">Отмена</a>
												<input type="submit" class="btn" style="border: none; height: 40px; padding-bottom: 8px;" name="edit-product" data-id="<?php echo $product['id']; ?>" value="Применить изменения">
												<a class="btn delete-product" data-id="<?php echo $product['id']; ?>">Удалить</a>
											</div>
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