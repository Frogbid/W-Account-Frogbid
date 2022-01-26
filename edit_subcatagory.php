<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';



$id = $_GET['subcategoryid'];

$sql = "SELECT * FROM `sub_categories`,`categories_table` WHERE  categories_table.categori_id = sub_categories.categori_id AND sub_categories.subcategori_id = $id";
$result = mysqli_query($con, $sql);
$subcategory =  mysqli_fetch_array($result);

/* update code start  here*/

if (isset($_POST['update'])) {
    $subcategori_name = $_POST['subcategori_name'];
    $categori_id = $_POST['categori_id'];
    $sql = "UPDATE `sub_categories` SET `categori_id`='$categori_id',`subcategori_name` = '$subcategori_name' WHERE subcategori_id = '$id'";
    
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('Location:subcatagory.php');
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
                        <h4 class="page-title">Edit Sub Category</h4>
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label>Select Catagory:</label>
                                <select class="select" name="categori_id">
                                    <option value="<?php echo $subcategory['categori_id'];?>" selected="true"><?php echo $subcategory['categori_name']; ?></option>
                                    <?php
                                    $query = "SELECT * FROM categories_table";
                                    $result1 = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_array($result1)) {
                                    ?>
                                        <option value="<?php echo $row['categori_id']; ?>"><?php echo $row['categori_name']; ?></option>

                                    <?php
                                    }
                                    ?>


                                </select>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2"> Sub Catagory Name</label>
                                <div class="col-md-10">
                                    <input type="text" name="subcategori_name" class="form-control" value="<?php echo $subcategory['subcategori_name']; ?>">
                                    <input type="text" hidden name="subcategori_id" class="form-control" value="<?php echo $subcategory['subcategori_id']; ?>">
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