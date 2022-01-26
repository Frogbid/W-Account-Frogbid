<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';

$id = $_GET['productid'];
$sql = "SELECT * FROM `product` WHERE unique_id = '$id'";
$result = mysqli_query($con, $sql);
$product =  mysqli_fetch_array($result);


/* update code start  here*/

if (isset($_POST['update'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $sql = "UPDATE `product` SET `product_name`='$product_name',`product_description`='$product_description' WHERE unique_id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo $successMsg = 'New record updated successfully';
        header('Location:product.php');
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
                        <h4 class="page-title">Edit Product</h4>
                        <form action="#" method="POST">
                            <div class="form-group row">

                                <label class="col-form-label col-md-2">Product Name</label>
                                <div class="col-md-10">
                                    <input type="text" name="product_name" class="form-control" value="<?php echo $product['product_name']; ?>">

                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Product Description</label>
                                <div class="col-md-10">
                                    <input type="text" name="product_description" class="form-control" value="<?php echo $product['product_description']; ?>">

                                </div>

                            </div>
                            <button type="submit" name="update" class="btn btn-success mt-2">Submit</button>
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