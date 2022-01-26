<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';



$id = $_GET['categoryid'];
$sql = "SELECT `categori_name` FROM `categories_table` WHERE categori_id = '$id'";
$result = mysqli_query($con, $sql);
$category =  mysqli_fetch_array($result);
/* update code start  here*/

if (isset($_POST['update'])) {
    $categori_name = $_POST['categori_name'];
    $sql = "UPDATE `categories_table` SET `categori_name`='$categori_name' WHERE categori_id = '$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo $successMsg = 'New record updated successfully';
        header('Location: catagory.php');
        
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
                        <h4 class="page-title">Edit Category</h4>
                        <form action="#" method="POST">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Catagory Name</label>
                                <div class="col-md-10">
                                    <input type="text" name="categori_name" class="form-control" value="<?php echo $category['categori_name']; ?>">
                                    <button type="submit" name="update" class="btn btn-success mt-2">Submit</button>
                                </div>
                            </div>
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