<!DOCTYPE html>

<!--
Assignment 2, Nick Milanovic, 000292701
November, 2022
-->

<?php
// Code block that will attempt to connect to the server and connect to the database, and create a new
// PDO object if successful, if not it will provide an error message
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=sa000292701",
        "sa000292701",
        "Sa_19940711"
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}

?>
<html>

<head>
    <title>Discount Truck Parts</title>
    <style>
        /* Styling elements */
        header
        {
            background-color: beige;
            padding: 100px;
        }
        h1
        {
            text-align: center;
        }
        body
        {
            
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }
        #categories
        {
            justify: left;
            text-align: center;
            background-color: aqua;
        }
        #catalog
        {
            
            justify-content: center;
            text-align: center;
            background-color: lime;
        }
        #cart
        {
            justify: right;
            text-align: center;
            background-color: yellow;
        }

        #main
        {
            display: grid;
            grid-template-columns: 25% 50% 25%;
        }
        #catTable td
        {
            justify-content: center;
            align: center;
            padding: 10px;
        }
        #catTable
        {
            display: flex;
            justify-content: center;
            text-align: center;
        }
        table
        {
            display: flex;
            justify-content: center;
            text-align: center; 
        }
        #prodTable
        {
            display: flex;
            justify-content: center;
            text-align: center;
        }
        #cartTable
        {
            display: flex;
            justify-content: center;
            text-align: center;
        }
        #descTable
        {
            display: flex;
            justify-content: center;
            text-align: left;
        }
        td
        {
            border: solid black 1px;
            padding: 10px;
        }
        p
        {
            color: red;
        }
        footer
        {
            text-align: center;
            background-color: black;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Adding in the Javascript code in an external file: A2JS.js -->
    <script src='A2JS.js'></script>
</head>

<body>
    <header>
        <h1>Discount Truck Parts</h1>
    </header>
    <div id="main">
        <div id="categories">
                <h2>Categories</h2>

                <?php
                    // First difference from A1, using the database to populate the categories list
                    // Further explanation in the document: MODS, listed as MOD_1
                    session_start();
                    $sql = 'SELECT DISTINCT product_category FROM product_list';
                    foreach($dbh->query($sql) as $row)
                    {
                        $cata = $row['product_category'];
                        echo "<h3><a href='A2.php?category=$cata'>";
                        echo $row['product_category'] . "\n";
                        echo "</h3></a>";
                    }
                    echo "<h3><a href='A2.php?category=ALL'>ALL PRODUCTS</a></h3>";
                ?>
        </div>
        <div id="catalog">
            <h2>Catalog</h2>
            <?php
                // Using GET requests to determine where the user is in the page, on the list of products
                // within a category, or on the details of a specific product
                $category = isset($_GET{'category'})?$_GET['category']:"";
                $product = isset($_GET{'product'})?$_GET['product']:"";
                if($category)
                {
                    // Modifying our query depending on what is provided from the GET request
                    // Further explanation in the document: MODS, listed as MOD_2
                    if($category == "ALL")
                    {
                        $query_string = "SELECT * FROM product_list";
                    }
                    else
                    {
                        $query_string = "SELECT * FROM product_list WHERE
                                    product_category = '$category'";
                    }
                    $cursor = $dbh->query($query_string);
                    echo "<table id='catTable'><tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th></tr>";
                    // Check of whether or not the product is sold out by accessing the database
                    // Further explanation in the document: MODS, listed as MOD_3
                    while ($data = $cursor->fetchObject())
                    {
                        $prod = $data->product_name;
                        if($data->product_quantity === 0)
                        {
                            $quantity = "SOLD OUT";
                        }
                        else
                        {
                            $quantity = $data->product_quantity;
                        }
                        echo "<tr><td>$data->product_id</td><td><a href='A2.php?product=$prod'>$data->product_name</a></td>
                                <td>$data->product_price</td><td>$quantity</td></tr>";
                    }
                    echo "</table>";
                }
                if($product)
                {
                    // Creating a new query to the database on specific products that have been selected
                    // Further explanation of modifications on the document: MODS, listed as MOD_4
                    $new_query = "SELECT * FROM product_list WHERE
                                    product_name = '$product'";
                    $new_cursor = $dbh->query($new_query);
                    echo "<table id='prodTable'><tr><th>Product Name</th><th>Product Description</th><th>Price</th><th>Quantity</th></tr>";
                    while ($prodData = $new_cursor->fetchObject())
                    {
                        if($prodData->product_quantity === 0)
                        {
                            $quant = "SOLD OUT";
                        }
                        else
                        {
                            $quant = $prodData->product_quantity;
                        }
                        echo "<tr><td>$prodData->product_name</td><td>$prodData->product_description</td>
                                <td>$prodData->product_price</td><td id='quant'>$quant</td><td hidden id='id'>$prodData->product_id</td></tr>";
                        
                    }
                    echo "</table>";
                    echo "<input type='button' id='addButton' value='ADD TO CART'>";
                    echo "<input type='button' id='returnButton' value='RETURN' onclick='window.location=\"A2.php?category=ALL\"'>";
                }
            ?>
        </div>
        <div id="cart">
            <!-- Creating our table elements and total price elements that will be modified everytime a user clicks a specific button -->
            <h2>Shopping Cart</h2>
            <table id='cartTable'>
            </table>
            <h3 id='totalPrice'></h3>
        </div>
    </div>
    <footer>
        <p id="footerFont">&copy; Nick Milanovic, 000292701, Oct 2022, Mohawk College</p>                
    </footer> 
</body>

</html>