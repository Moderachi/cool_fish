<?php

$db = Db::getConnection();

$sql = 'UPDATE product SET name=:name, category=:category, brand=:brand, price=:price, description=:description, photo=:photo '
. 'WHERE code=:code';

$result = $db->prepare($sql);
$result->bindParam(':name', $name, PDO::PARAM_STR);
$result->bindParam(':code', $code);
$result->bindParam(':category', $category);
$result->bindParam(':brand', $brand);
$result->bindParam(':price', $price);
$result->bindParam(':description', $description, PDO::PARAM_STR);
$result->bindParam(':photo', $filename, PDO::PARAM_STR);
move_uploaded_file($_FILES['filename']['tmp_name'], substr($filename, 1));


echo $result->execute();
?>