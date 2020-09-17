<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 padding-right">
				<div class="form" align="center" ><!--sign up form-->
					<h2 >История заказов</h2>
					<div class="row">
						<div>
							<?php if(!empty($orderList)): ?>
							<ul id="categories">
								<?php foreach ($orderList as $orderItem): ?>
									<li style=" margin: 30px;">
										<span class="history-item" style="display: table-row;">
											<div class="tbl-slide-info"><div>Номер заказа</div><?php echo $orderItem['order_id']; ?></div>
											<div class="tbl-slide-info"><div>Электронная почта</div><?php echo $orderItem['user_email']; ?></div>
											<div class="tbl-slide-info"><div>Имя заказчика</div><?php echo $orderItem['user_name']; ?></div>
											<div class="tbl-slide-info"><div>Номер телефона</div><?php echo $orderItem['user_phone']; ?></div>
											<div class="tbl-slide-info"><div>Дата заказа</div><?php echo $orderItem['date']; ?></div>
										</span>
										<ul>
											<?php 
											$productsInCart = json_decode($orderItem['products'], true);
											$productsIds = array_keys($productsInCart);
											$products = Product::getProdustsByIds($productsIds);
											$totalPrice = Product::getTotalPriceProducts($productsInCart);
											?>
											<div align="center" style="margin: 30px;">Общая стоимость заказа: <?php echo $totalPrice; ?>$</div>
											<div class="product-items"><!--features_items-->
												<?php foreach ($products as $product): ?>
													<div class="product-item">
														<div class="single-products">
															<div class="productinfo text-center" align="center">
																
																<a href="/product/<?php echo $product['id']; ?>"><img src="<?php if($product['photo'] != '') echo $product['photo']; else echo 'https://www.monsterfishgroup.com/upload/iblock/dbb/dbbb015406b2bed27759e1d6be2b4a61.jpg'; ?>" alt="" /> </a>

																<p>
																	<a href="/product/<?php echo $product['id']; ?>">
																		Название: <?php echo $product['name']; ?>
																	</a>
																</p>
																<p>Цена: <?php echo $product['price']; ?>$</p>
																<p>Количество: <?php echo $productsInCart[$product['id']]; ?></p>
															</div>
														</div>
													</div>

												<?php endforeach; ?>
											</div>
											
										</ul>
									</li>
								<?php endforeach; ?>
							</ul>
							<?php else: ?>
								<p>Ваш список заказов пуст</p>
							<?php endif; ?>
						</div>
					</div><br><br>
					<a href="/cabinet" class="btn btn-default">Назад</a>

				</div><!--/sign up form-->
				<br><br>
			</div>
		</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>