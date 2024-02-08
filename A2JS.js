// Assignment 2
// Nick Milanovic
// 000292701
// November 2022

window.addEventListener("load", function() 
{

    // The success function is called everytime a request to the server is made.
    // Function is responsible for painting/removing our cart quantities from the cart table
    // depending on which button is clicked 
    // Further explanation of our modification from A1 will be in the document: MODS, listed as MOD_6
    function success(text) {
        let cartElement = document.getElementById("cartTable");
        let subTotal = document.getElementById("totalPrice");
        let total = 0.0;
        const cart = JSON.parse(text);
        let tableContents = "<tr><td>Product Name</td><td>Price</td><td>Quantity</td></tr>";
        cart.forEach(cartFunction);
        
        // The cartFunction will iterate through our cart object and paint the correct amount of items
        // that are in the cart. If no items are added to the cart, nothing is painted. Also modifies our
        // subtotal as things get added or removed
        // Further explanation of our modification from A1 will be in the document: MODS, listed as MOD_7
        function cartFunction(item, index, arr)
        {
            console.log(item[3]);
            tableContents = tableContents + `<tr><td>${item[0]}</td><td id='price'>${item[1]}</td><td>${item[2]}</td>
                            <td><input type='button' id='${item[3]}' class='removeButton' value='REMOVE'></td></tr>`;
            total = total + (parseFloat(item[1]) * parseFloat(item[2]));
        }
        cartElement.innerHTML = tableContents;
        subTotal.innerHTML = "Subtotal: $" + total;
        
        // The way I structured my remove item buttons was creating a class (removeButton) and within those classes,
        // giving a unique id which is directly relational to the product id being added. This is the reason the correct
        // price will be added/removed to the subtotal, as well as the correct quantity
        // Further explanation of our modification from A1 will be in the document: MODS, listed as MOD_8
        document.querySelectorAll('.removeButton').forEach(function(elem)
            {
                elem.addEventListener("click", function() {
                    let id = elem.getAttribute('id');
                    fetch("AP12.php?product_id="+id, {
                            method: 'POST'
                        })
                        .then(response => response.text())
                        .then(success)
                        let quantity = document.getElementById("quant");
                        let intQuant = parseInt(quantity.innerHTML);
                        quantity.innerHTML = intQuant + 1;
                });
            });
    }

    // This fetch is responsible for fetching all of the items that are in the cart, if there are none, nothing gets fetched
    // nor drawn into our cart. Further explanation of our modification from A1 will be in the document: MODS, listed as MOD_9
    fetch("API.php", {
        method: 'GET'
    })
    .then(response => response.text())
    .then(success)
    .then(function()
    {
        // Event handler for the add button, which fetches the data from our database using the POST request we have
        // modified in the API.php file. Further explanation of our modification from A1 will be in the document: MODS,
        // listed as MOD_10
        let button = document.getElementById("addButton");
            button.addEventListener("click", function() {
            let id = document.getElementById("id");
            fetch("API.php?product_id="+id.innerHTML, {
                    method: 'POST'
                })
                .then(response => response.text())
                .then(success)
                let quantity = document.getElementById("quant");
                let intQuant = parseInt(quantity.innerHTML);
                if(intQuant > 1)
                {
                    quantity.innerHTML = intQuant - 1;
                }
                else
                {
                    quantity.innerHTML = "SOLD OUT";
                    document.querySelector('#addButton').disabled = true;
                }
            });
            
    });
});
