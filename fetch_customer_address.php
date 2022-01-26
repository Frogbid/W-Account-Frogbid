<?php
//Fetch customer addtess by ajax
require_once 'config/dbconfig.php';
require_once 'include/session.php';

$cstmraddress = $_POST['fetchcustomerAddresspost'];

$query = "SELECT customer_address from`add_customer` where customer_id = '$cstmraddress'";
$result = mysqli_query($con, $query);

while ($rows = mysqli_fetch_array($result)) {
    echo $rows['customer_address'];
}
