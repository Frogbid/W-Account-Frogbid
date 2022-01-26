<?php
//insert invoice items to invoice items table
require_once 'config/dbconfig.php';
require_once 'include/session.php';
$number = (int) count($_POST["invoceNo"]);
echo $number;
if ($number > 0) {
    for ($i = 0; $i < ($number - 1); $i++) {
       $sql = "INSERT INTO invoice_item_table(invoice_id,chalan_no,item_name,item_size,item_quantity,unit,selling_price,discount,total,finalTotal) VALUES('" . mysqli_real_escape_string($con, $_POST["invoceNo"][$number-1]) . "','" . mysqli_real_escape_string($con, $_POST["chalan_no"][$i]) . "','" . mysqli_real_escape_string($con, $_POST["item_name"][$i]) . "','" . mysqli_real_escape_string($con, $_POST["item_size"][$i]) . "','" . mysqli_real_escape_string($con, $_POST["item_quantity"][$i]) . "','" . mysqli_real_escape_string($con, $_POST["unit"][$i]) . "','" . mysqli_real_escape_string($con, $_POST["selling_price"][$i]) . "','" . mysqli_real_escape_string($con, $_POST["discount"][$i]) . "','" . mysqli_real_escape_string($con, $_POST["total"][$i]) . "','" . mysqli_real_escape_string($con, $_POST["final_total"][$i]) . "')";
        mysqli_query($con, $sql);
    }
    echo "Invoice item added!";
} else {
    echo "Invoice item inserted failed!!";
}
