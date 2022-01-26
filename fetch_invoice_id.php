<?php
//fetch Invoice Id for uniqueness with ajax
require_once 'config/dbconfig.php';
require_once 'include/session.php';
$value = $_POST['value'];
$query = "SELECT invoice_id from invoice_table where invoice_id = '$value'";

$result = mysqli_query($con, $query);

while ($rows = mysqli_fetch_array($result)) {
    echo $rows['invoice_id'];
}
