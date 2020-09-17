<?php 
	include_once ROOT.'/components/Cart.php';
	include_once ROOT.'/models/User.php'; 
	include_once ROOT.'/components/Db.php'; 
?>
<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 padding-right">
				<div align="center" class="signup-form" style="margin: 50px;"><!--sign up form-->
					<h2 >Загрузка накладной №<?php echo $invoice; ?></h2>
					<div ><a class="btn" href="../history">Назад</a><a href="/doc/<?php echo $invoice; ?>.docx" class="btn" download>Скачать</a></div>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>