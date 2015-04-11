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
            // to be deleted
            echo "product_id = $product_id" ;

            $query_string = "select * from products where product_id = $product_id";
            $result = mysql_query($query_string);

            $num_rows = mysql_num_rows($result);
            if ($num_rows > 0 ) {
                print "<table border='0' cellspacing='0' cellpadding='5'>";
                while ( $a_row = mysql_fetch_assoc($result) ) {
                     print "<tr>\n";
                     print "<td>"Product Name: "</td>";
                     print "<td>".$a_row['product_name']."</td>";
                     print "</tr>";
                     print "<tr>\n";
                     print "<td>"Unit Price: "</td>";
                     print "<td>".$a_row['unit_price']."</td>";
                     print "</tr>";
                     print "<tr>\n";
                     print "<td>"Unit Quantity: "</td>";
                     print "<td>".$a_row['unit_quantity']."</td>";
                     print "</tr>";
                     print "<tr>\n";
                     print "<td>"In Stock: "</td>";
                     print "<td>".$a_row['in_stock']."</td>";
                     print "</tr>";
                     print "<tr>\n";
                }
                print "</table>";
            }
            mysql_close($link);
            ?>

            <?php

            if (isset($_POST['submit']))
            {
            $result=$_POST['num1']*$_POST['num2'];
            }
            ?>

            <form action="#" method="post">
                Amount: <input type="number" name="amount">
                <input type="submit" name="Add">
                </form>
    </div>
<div class="body">

</div>
</div>
</body>
</html>
