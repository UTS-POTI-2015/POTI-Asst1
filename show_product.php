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
                print "<table border='1' cellspacing='0' cellpadding='5'>";
                while ( $a_row = mysql_fetch_assoc($result) ) {
                     print "<tr>\n";
                     print "<td>".$a_row['product_name']."</td>";
                     print "<td>".$a_row['unit_price']."</td>";
                     print "<td>".$a_row['unit_quantity']."</td>";
                     print "<td>".$a_row['in_stock']."</td>";
                     print "</tr>";
                }
                print "</table>";
            }
            mysql_close($link);
            ?>
    </div>
<div class="body">

</div>
</div>
</body>
</html>
