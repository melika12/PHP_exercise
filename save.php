<?php 
    #connecter til databasen
include_once 'dbconn.php';

     #looper igennem sprog i databasen for at få alt med
$language = "SELECT * FROM `languages`;";
$result = mysqli_query($conn, $language);
$a = 1;

    #får de faste værdier og sender dem til databasen
$number = utf8_decode(($_POST["number"]));
$price = ($_POST["price"]);
$products = "INSERT INTO products (products.products_reference, products.products_price) VALUES('$number', '$price');"; 
mysqli_query($conn, $products);

    #får de unikke navne med language_id
foreach($result AS $languages) {
    $name = 'name';
    $shdesc = 'shortdesc';
    $lodesc = 'desc';
    $prod_name = $name . $a;
    $prod_shdesc = $shdesc . $a;
    $prod_desc = $lodesc . $a;
   

    #insætter dem hver især i en variable
$name = utf8_decode($_REQUEST["$prod_name"]);
$shortdesc = utf8_decode($_REQUEST["$prod_shdesc"]);
$desc = utf8_decode($_REQUEST["$prod_desc"]);

#finder produkt_id'et på produktet
$products_id = "SELECT * FROM `products` WHERE `products`.`products_reference` = '$number' AND `products`.`products_price` = '$price';";
$results = mysqli_query($conn, $products_id); 
$id = mysqli_fetch_assoc($results);

    #sender dataten til databasen
$products_desc = "INSERT INTO products_description (products_description.products_id, products_description.languages_id, products_description.products_description_name, products_description.products_description_short_description, products_description.products_description_description) VALUES('$id[products_id]', '$a', '$name','$shortdesc','$desc');";
mysqli_query($conn, $products_desc);

$a++;
}
    #re-router tilbage til index.php siden
header('Location: index.php');