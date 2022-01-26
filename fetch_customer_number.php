<?php
//fetch customer number with ajax
require_once 'config/dbconfig.php';
require_once 'include/session.php';

$cstmrnumber = $_POST['fetchcustomerNumberpost'];

$query = "SELECT  `customer_phone` from add_customer where customer_id = '$cstmrnumber'";

$result = mysqli_query($con, $query);

while ($rows = mysqli_fetch_array($result)) {
    echo $rows['customer_phone'];
}
