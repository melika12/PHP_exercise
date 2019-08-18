<?php
#connecter til databasen
include_once 'dbconn.php';
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta charset="utf-8">
<script src="ckeditor.js"></script>
<form action="update.php?product_id=<?php echo $_REQUEST['product_id']?>" method="post">

<div class="w3-row-padding" style="border: 1px solid #aaa; margin: 2vh; padding-bottom: 4vh; padding: 2vh; display:inline-block; background-color: #f5f5f5">
<p>Varenummer </p><input type="text" name="number" placeholder="
<?php
    #viser dataen som er der i forvejen
$prodnum = "SELECT * FROM products WHERE products_id = $_REQUEST[product_id];";
$resultnum = mysqli_query($conn, $prodnum);
$fetch = mysqli_fetch_assoc($resultnum);
echo utf8_encode($fetch['products_reference']);
?>"><br>
<p>Pris </p><input type="text" name="price" placeholder="
<?php
#viser dataen som er der i forvejen
$prodprice = "SELECT * FROM products WHERE products_id = $_REQUEST[product_id];";
$resultprice = mysqli_query($conn, $prodprice);
$fetch = mysqli_fetch_assoc($resultprice);
echo utf8_encode($fetch['products_price']);
?>"></div>
<div class="w3-row-padding">

<?php #looper igennem sprog i databasen for at få alle med
        $language = "SELECT * FROM `languages`;";
        $result = mysqli_query($conn, $language);
        $a = 1;
        foreach($result AS $products) {
            #giver hvert et unikt navn med language_id som det sidste i navnet 
        $name = 'name';
        $shdesc = 'shortdesc';
        $lodesc = 'desc';
        $prod_name = $name . $a;
        $prod_shdesc = $shdesc . $a;
        $prod_desc = $lodesc . $a;
?>
    <div class="w3-col s4">   
  
    <div class="w3-row-padding" style="border: 1px solid #aaa; padding: 2vh; margin-bottom:2vh; display:inline-block; background-color: #f5f5f5"> 
    
<h3 ><?php 
    #viser hvilket sprog man rediger i
    echo utf8_encode($products['languages_name']);
?></h3>
<p style="border: 1px solid black"></p>
<div class="card" >

    <p>Varenavn: </p><input type="text" name="<?php echo $prod_name?>" placeholder="<?php
     #henter indholdet fra databasen og viser i 'shadow'
    $productname = "SELECT * FROM products_description WHERE products_id = $_REQUEST[product_id] AND languages_id = $a;";
    $results = mysqli_query($conn, $productname);
    $fetch = mysqli_fetch_assoc($results);
    echo utf8_encode($fetch['products_description_name']);
    ?>">
    <p>Kort tekst</p>
    <textarea name="<?php echo $prod_shdesc?>" id="<?php echo $prod_shdesc?>" cols="50" placeholder="<?php
    #henter indholdet fra databasen og viser i 'shadow' 
    $productshdesc = "SELECT * FROM products_description WHERE products_id = $_REQUEST[product_id] AND languages_id = $a;";
    $results = mysqli_query($conn, $productshdesc);
    $fetch = mysqli_fetch_assoc($results);
    echo utf8_encode($fetch['products_description_short_description']);
    ?>"></textarea>
    <script>
        ckeditor.replace('<?php echo $prod_shdesc?>');
    </script>
    <br>
    <p>Lang tekst</p>
    <textarea name="<?php echo $prod_desc?>" id="<?php echo $prod_desc?>" rows="4" cols="50" placeholder="<?php 
    #henter indholdet fra databasen og viser i 'shadow'
    $productdesc = "SELECT * FROM products_description WHERE products_id = $_REQUEST[product_id] AND languages_id = $a;";
    $results = mysqli_query($conn, $productdesc);
    $fetch = mysqli_fetch_assoc($results);
    echo utf8_encode($fetch['products_description_description']);
    ?>"></textarea>
    <script>
        ckeditor.replace('<?php echo $prod_desc?>');
    </script>
</div>
</div>
</div>
   
<?php $a++; 
} ?>
<input style="font-size:2vh; display:block" type="submit" name="Opdater" value="Opdater produkt"></form>
</div>
<form action="index.php" method="post"><input style="font-size:2vh; margin-left:0.75vh" type="submit" value="Forside"></form>
