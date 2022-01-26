<?php
//fetch product name with ajax
require_once 'config/dbconfig.php';
require_once 'include/session.php';
$productid = $_POST['productpost'];

$query = "SELECT * from product where unique_id = '$productid'";

$result = mysqli_query($con, $query);

while ($rows = mysqli_fetch_array($result)) {
    echo $rows['product_name'];
}
