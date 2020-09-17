<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 padding-right">
				<div class="form" align="center" ><!--sign up form-->
					<h2 >Сменить пароль</h2>
					<div class="row">
						<?php if ($result): ?>
							<p>Пароль изменен!</p>
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
									<input type="password" class="in-product" placeholder="Старый пароль" name="past"/>
									<input type="password" class="in-product" placeholder="Новый пароль" name="new" value="<?php if(isset($_POST['new'])) echo $_POST['new'];?>"/>
									<input type="password" class="in-product" placeholder="Подтвердите новый пароль" name="check"/>
									
									<br><br>
									<div class="form-group text-right" style="display: inline-block;">
										<input id="admin-cancel" type="reset" value="Назад" class="btn btn-default" />
										<input type="submit" name="change-password" value="Применить" class="btn btn-success" />
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