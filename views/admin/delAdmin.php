<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 padding-right">
				<div class="form" align="center" ><!--sign up form-->
					<h2 >Удалить модератора</h2>
					<div class="row">
						
							<div>
								<table cellpadding="25px">		
								<tr>
                                    <th>Имя пользователя</th>
                                    <th>E-mail</th>
                                    <th></th>
                                </tr>										
								<?php foreach ($userList as $userItem): ?>
									<?php if($userItem['role'] == "admin" && $userItem['id'] != $_SESSION['userId']): ?>
										<tr>
											<td><?php echo $userItem['name']; ?></td>
											<td><?php echo $userItem['email']; ?></td>
											<td><input type="submit" class="btn" onclick="delAdmin(<?php echo $userItem['id']; ?>)" value="Удалить"></td>
										</tr>
									<?php endif; ?>
								<?php endforeach; ?>
								</table>
							

							</div>
					</div><br><br>
				<a href="/admin" class="btn btn-default">Назад</a>

				</div><!--/sign up form-->
				<br><br>
			</div>
		</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>