<?php
#connecter til databasen
include_once 'dbconn.php';
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<meta charset="utf-8">
<script src="ckeditor.js"></script>
<form action="save.php" method="post">

<div class="w3-row-padding" style="border: 1px solid #aaa; margin: 2vh; padding-bottom: 4vh; padding: 2vh; display:inline-block; background-color: #f5f5f5">
<p>Varenummer </p><input type="text" name="number"><br>
<p>Pris </p><input type="text" name="price"></div>
<div class="w3-row-padding">
<?php 
    #looper igennem sprog i databasen for at få alle med
        $languages = "SELECT * FROM `languages`;";
        $result = mysqli_query($conn, $languages);
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
    #viser hvilket sprog der bliver skrevet ved
    echo utf8_encode($products['languages_name']);
?></h3>
<div class="card" >

    <p>Varenavn: </p><input type="text" name="<?php echo $prod_name?>">
    <p>Kort tekst</p>
    <textarea name="<?php echo $prod_shdesc?>" id="<?php echo $prod_shdesc?>" rows="4" cols="50"></textarea>
    <script>
        ckeditor.replace('<?php echo $prod_shdesc?>');
    </script>
    <br>
    <p>Lang tekst</p>
    <textarea name="<?php echo $prod_desc?>" id="<?php echo $prod_desc?>" rows="4" cols="50"></textarea>
    <script>
        ckeditor.replace('<?php echo $prod_desc?>');
    </script>
</div>
</div>
</div>
<?php $a++; 
} ?>

<input style="font-size:2vh" type="submit" name="Tilføj" value="Tilføj produkt" ></form> 
</div>
<form action="index.php" method="post"><input style="font-size:2vh; margin-left:0.75vh" type="submit" value="Forside"></form>