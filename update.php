<?php 
    #connecter til databasen
include_once 'dbconn.php';
    #får faste værdier
$number = utf8_decode(($_POST["number"]));
$price = ($_POST["price"]);
$id = $_REQUEST['product_id'];

    #checker om feltet er tomt, hvis ikke, bliver dataen opdateret og sendt til databasen
if(!empty($_POST["number"])) {
    $updatenum = "UPDATE `products` SET `products_reference` = '$number' WHERE `products_id` = '$id';";
    mysqli_query($conn, $updatenum);
}

if(!empty($_POST["price"])) {
    $updateprice = "UPDATE `products` SET `products_price` = '$price' WHERE `products_id` = '$id';";
    mysqli_query($conn, $updateprice);
}
    #looper igennem sprog i databasen for at få alt med
$languages = "SELECT * FROM `languages`;";
$result = mysqli_query($conn, $languages);
$a = 1;

foreach($result AS $language) {
        #får de unikke navne med language_id
    $name = 'name';
    $shdesc = 'shortdesc';
    $lodesc = 'desc';
    $prod_name = $name . $a;
    $prod_shdesc = $shdesc . $a;
    $prod_desc = $lodesc . $a;
    
        #checker om feltet er tomt, hvis ikke, bliver dataen opdateret og sendt til databasen
    if(!empty($_REQUEST["$prod_name"])) {
        $name = utf8_decode(trim($_REQUEST["$prod_name"]));
        $updatename = "UPDATE `products_description` SET `products_description_name` = '$name' WHERE `products_id` = '$id' AND `languages_id` = '$a';";
        mysqli_query($conn, $updatename);
    } 

    if(!empty($_REQUEST["$prod_shdesc"])) {
        $shortdesc = utf8_decode(trim($_REQUEST["$prod_shdesc"]));
        $updateshdesc = "UPDATE `products_description` SET `products_description_short_description` = '$shortdesc' WHERE `products_id` = '$id' AND `languages_id` = '$a';";
        mysqli_query($conn, $updateshdesc);
    } 

    if(!empty($_REQUEST["$prod_desc"])) {
        $desc = utf8_decode(trim($_REQUEST["$prod_desc"]));
        $updatedesc = "UPDATE `products_description` SET `products_description_description` = '$desc' WHERE `products_id` = '$id' AND `languages_id` = '$a';";
        mysqli_query($conn, $updatedesc);
    } 
    
    $a++;
}
    #re-router tilbage til index.php siden
header('Location: index.php');