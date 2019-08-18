<?php
#connecter til databasen
include_once 'dbconn.php';
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script>
    //sletter produkt via produkt id'et
function delete_id(id) {
    if (confirm("Er du sikker på du vil slette dette produkt?")) {
        window.location.href = 'delete.php?delete_id=' + id + '';
    }
}
</script>
<div class="w3-container">
  <h2>Prøve opgave</h2>

  <table class="w3-table-all">
  
    <tr>
      <th>Varenavn</th>
      <th>Pris</th>
      <th>Varenummer</th>
    </tr>
        <?php
                #får produkter fra databasen og looper dem ud
            $products = "SELECT * FROM `products` ORDER BY `products_id`;";
            $results = mysqli_query($conn, $products);
            $fetch = mysqli_fetch_assoc($results);
            $a = 1;
            foreach($results AS $product) {  
                #hvis produkt id'et ikke længere eksistere, bliver det sprunget over
            while(!$a = $product['products_id']) {
                $a++;
            }   
        ?>
        <tr>
        <form action="edit.php?product_id=<?php echo $a?>" method="post">
        <td><?php
                    #produkt navnet bliver hentet fra databasen
                $name = "SELECT * FROM products_description WHERE products_id = $a ;";
                $result = mysqli_query($conn, $name);
                $fetching = mysqli_fetch_assoc($result);
                echo utf8_encode($fetching['products_description_name']);
            ?></td>
            <td><?php
                    #produkt prisen bliver hentet fra databasen
                 $price = "SELECT * FROM products WHERE products_id = $a;";
                 $result = mysqli_query($conn, $price);
                 $fetching = mysqli_fetch_assoc($result);
                 echo utf8_encode($fetching['products_price']);
            ?></td>
            <td><?php
                    #produkt nummer (referencen) bliver hentet fra databasen
                $number = "SELECT * FROM products WHERE products_id = $a;";
                $result = mysqli_query($conn, $number);
                $fetching = mysqli_fetch_assoc($result);
                echo utf8_encode($fetching['products_reference']);
            ?>
            <input type="button" style="float:right" onclick="delete_id(<?php echo $product['products_id']?>)" name="Slet" value="Slet">
            <input type="submit" style="float:right" value="Rediger"></form>
            </td>
        </tr>
        <?php   
                $a++;
            } ?>
    <tr>
      <td></td>
      <td></td>
      <td><form action="create.php" method="GET"><input type="submit" style="float:right"value="Opret produkt"></form></td>
    </tr>
  </table>
</div>