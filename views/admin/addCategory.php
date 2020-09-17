<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 padding-right">
				<div class="form" align="center" ><!--sign up form-->
					<h2 >Добавить категорию</h2>
					<div class="row">
						<?php if ($result): ?>
							<p>Категория добавлена!</p>
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
								<form method="POST">
									<input type="text" class="in-product" placeholder="Имя" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'];?>"/>
									<select name="sort" >
										<option selected disabled>Задать приоритет категории</option>
										<?php for ($i=1; $i<=10; $i++): ?>
											<option value="<?php echo $i; ?>">
												<?php echo $i; ?>
											</option>
										<?php endfor;?>
									</select><br><br>	
									<br><br>
									<div class="form-group text-right" style="display: inline-block;">
										<input id="admin-cancel" type="reset" value="Назад" class="btn btn-default" />
										<input type="submit" name="add-category" value="Добавить" class="btn btn-success" />
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