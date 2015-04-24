<?php
    session_start();
?>
<html>
<head>
<title>Products Page</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<div class="content">
    <div class="header">
        <h1>Product Detail</h1>
            <?php
            $link = mysql_connect("rerun","potiro","pcXZb(kL");
            if (!$link)
               die("Could not connect to Server");
            mysql_select_db("poti",$link);

            $product_id = $_REQUEST['product_id'];

            $query_string = "select * from products where product_id = $product_id";
            $result = mysql_query($query_string);

            $num_rows = mysql_num_rows($result);
            if ($num_rows > 0 ) {
                print "<form name='product' action='cart.php' target='bottom_right' onsubmit='return isQuantityValid();' >";
                print "<table>";
                print "<tr>\n<th>Product Name</th><th>Unit Quantity</th><th>Unit Price</th><th>In Stock</th><th>Quantity to Purchase</th></tr>";
                if ( $a_row = mysql_fetch_assoc($result) ) {
                     print "<input type='hidden' name='product_id' value=$product_id >";
                     print "<input type='hidden' name='product_name' value=\"" . $a_row['product_name'] . "\">";
                     print "<input type='hidden' name='unit_quantity' value=\"" . $a_row['unit_quantity'] . "\">";
                     print "<input type='hidden' name='unit_price' value=" . $a_row['unit_price'] . ">";
                     print "<tr>\n";
                     print "<td class='productForm'>".$a_row['product_name']."</td>";
                     print "<td class='productForm'>".$a_row['unit_quantity']."</td>";
                     print "<td class='productForm'>$ ".$a_row['unit_price']."</td>";
                     print "<td class='productForm' id='in_stock'>".$a_row['in_stock']."</td>";
                    if(isset($_SESSION['checkout'])) {
                        print "<td class='productForm'>"."No more items to be added when checkout."."</td>"."</tr>";
                    }
                    else {
                        print "<td class='button'>"."<input type='text' name='quantity_to_purchase' value=0>"."</td>"."</tr>";                                                    
                        print "<tr><td colspan='4' class='button'></td><td style='padding-left: 65px;'><input type='submit' class='leftButton' name='action' value='Add'></td></tr>";
                    }        
                }
                print "</table>";
                print "</form>";
            }
            mysql_close($link);
            ?>
    </div>
<div class="body">

<script type="text/javascript">
function isQuantityValid(){
    var quantity = document.product.quantity_to_purchase.value;
    var orderLimit = 30;
    // var in_stock_node = document.getElementById("in_stock");
    // var in_stock = parseFloat(in_stock_node.textContent);
    if (quantity.length === 0) {
        alert("PLEASE ENTER SOME DATA IN QUANTITY FIELD!");
        return false;
    };
    if (isNaN(quantity) || parseFloat(quantity) <= 0) {
        alert("PLEASE ENTER A POSITIVE NUMBER IN QUANTITY FIELD!");
        return false;
    };

    quantity = parseFloat(quantity);
    if (quantity > orderLimit) {
        alert("PLEASE ENTER A POSITIVE NUMBER LESS THEN 30 IN QUANTITY FIELD!");
        return false;
    };
    return true;
}
</script>
</div>
</div>
</body>
</html>