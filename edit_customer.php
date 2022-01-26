<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';



$id = $_GET['customerid'];
$sql = "SELECT * FROM `add_customer`  WHERE customer_id  = '$id'";

$result = mysqli_query($con, $sql);
$customer =  mysqli_fetch_array($result);
/* update code start  here*/

if (isset($_POST['update'])) {
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];
    $customer_phone = $_POST['customer_phone'];

    $sql = "UPDATE `add_customer` SET `customer_name`='$customer_name',`customer_email`=' $customer_email',`customer_address`=' $customer_address',`customer_phone`='$customer_phone' WHERE 	customer_id = '$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo $successMsg = 'New record updated successfully';
        header('Location:add_customer.php');
    } else {
        echo $successMsg = 'New record updated failed';
    }
}


?>
<!-- database conection end here  -->





<!DOCTYPE html>
<html lang="en">


<head>
    <!-- css section start  here -->
    <?php require_once 'include/css.php'; ?>
    <!-- css section end here -->

</head>

<body>
    <div class="main-wrapper">


        <!-- heder section start  here -->
        <?php require_once 'include/topbar.php'; ?>
        <!-- heder section end here -->


        <!-- sidebar will include here -->
        <?php require_once 'include/sidebar.php'; ?>
        <!-- sidebar end here -->


        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="page-title">Edit Customer Info</h4>
                        <form action="#" method="POST">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Customer Name: </label>
                                <div class="col-md-10">
                                    <input type="text" name="customer_name" class="form-control" value="<?php echo $customer ['customer_name']; ?>">
                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Customer Email: </label>
                                <div class="col-md-10">
                                    <input type="email" name="customer_email" class="form-control" value="<?php echo $customer ['customer_email']; ?>">
                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Customer Address: </label>
                                <div class="col-md-10">
                                    <input type="text" name="customer_address" class="form-control" value="<?php echo $customer ['customer_address']; ?>">
                                
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Customer Phone Number: </label>
                                <div class="col-md-10">
                                    <input type="text" name="customer_phone" class="form-control" value="<?php echo $customer ['customer_phone']; ?>">
                                
                                </div>
                            </div>
                            
                            <button type="submit" name="update" class="btn btn-success mt-2">update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- JS include  here -->
    <?php require_once 'include/js.php'; ?>
    <!-- JS  end include  here -->

</body>

</html>