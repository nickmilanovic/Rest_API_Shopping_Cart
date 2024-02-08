<?php
// Assignment 2
// Nick Milanovic
// 000292701
// November 2022

// This file is used to handle the different types of requests that will come from the javascript file
// First we want to create a new PDO object by connecting to our database on the local server
session_start();
    try {
        $dbh = new PDO(
            "mysql:host=localhost;dbname=sa000292701",
            "sa000292701",
            "Sa_19940711"
        );
    } catch (Exception $e) {
        die("ERROR: Couldn't connect. {$e->getMessage()}");
    }
    
    // Using a switch case method, we check to see which 3 different types of requests we will be using throughout the 
    // assignment, this will be listed in further detail on the document: MODS, listed as MOD_5
    switch($_SERVER["REQUEST_METHOD"])
    {
        // First request type will be a "GET", which simply provides us all of the data for each product required that is in the cart
        case 'GET':
            $cart = $dbh->query('SELECT product_name, product_price, product_cart_quantity, product_id FROM product_list WHERE product_cart_quantity > 0');
            $cart = $cart->fetchAll();
            echo json_encode($cart);
            break;
        
        // Second request type will be a "POST", which will modify the server by subtracting the quantity of products and adding it to the 
        // quantity of products in the cart. This request will be made everytime the ADD TO CART button is clicked
        case 'POST':
            $addingItem = $_GET["product_id"];
            $cart = $dbh->prepare('UPDATE product_list SET product_cart_quantity = product_cart_quantity + 1, product_quantity = product_quantity -1 WHERE product_id =' . $addingItem)->execute();
            $cart = $dbh->query('SELECT product_name, product_price, product_cart_quantity, product_id FROM product_list WHERE product_cart_quantity > 0');
            $cart = $cart->fetchAll();
            echo json_encode($cart);    
            break;
    }

?>