<?php
    #connecter til databasen
include_once 'dbconn.php';

    #får besked fra javascript funktionen om at den skal slette produktet vha. produkt_id'et

$delete_products = "DELETE FROM products WHERE products_id='".$_GET['delete_id']."'";

    #produktet bliver slettet fra både 'products' og 'products_description' i databasen
$delete_desc = "DELETE FROM products_description WHERE products_id='".$_GET['delete_id']."'";
$prod_query = mysqli_query($conn, $delete_products);
$desc_query = mysqli_query($conn, $delete_desc);

    #re-router tilbage til index.php siden
header ("Location: index.php");