<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';


?>


<!DOCTYPE html>
<html lang="en">


<head>
    <!-- css section start  here -->
    <?php require_once 'include/css.php'; ?>
    <!-- css section end here -->
    <?php
    $page = '';

    $expense_id = $_GET['expense_id'];
    $sql = "SELECT * FROM expenses,categories_table,sub_categories WHERE expenses.categori_id = categories_table.categori_id AND expenses.subcategori_id = sub_categories.subcategori_id AND expenses.expense_id = '$expense_id'";
    $result =  mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    if (isset($_POST['update'])) {

        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $categori_id = $_POST['categori_id'];
        $subcategori_id = $_POST['subcategori_id'];
        $expense_amount = $_POST['expense_amount'];
        $expense_date = $_POST['expense_date'];
        $expense_note = $_POST['expense_note'];
        $entry_date = $dt->format('Y-m-d');

        $update_sql = "UPDATE expenses SET `categori_id`='$categori_id',`subcategori_id`='$subcategori_id',`expense_amount`='$expense_amount',`expense_date`='$expense_date',`expense_note`='$expense_note' WHERE expense_id = '$expense_id'";

      

        $update_result = mysqli_query($con, $update_sql);
    }
    ?>
    <!---cdn css files area end-->


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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Update cost information.</h4>
                    </div>

                </div>
                <div class="card-header bg-dark">
                    <div class="row">
                        <div class="col-md-6 col-12 text-left">
                            <h4 class="mb-0 text-white">Update cost information</h4>
                        </div>
                        <div class="col-md-6 col-12 text-right">
                            <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> List Of Cost <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>Main Category(*)</label>
                                    <select name="categori_id" class="select2" style="width:100%;" onchange="categoryName(this.value);">
                                        <option disabled="disabled" selected="selected" value="">Select Main Category*</option>
                                        <?php
                                        $fetch = "SELECT * from categories_table";
                                        $result = mysqli_query($con, $fetch);
                                        while ($rows = mysqli_fetch_array($result)) {
                                        ?>
                                            <option value="<?php echo $rows['categori_id']; ?>" <?php if ($rows['categori_id'] == $row['categori_id']) {
                                                                                                    echo "selected";
                                                                                                } else {
                                                                                                    echo "";
                                                                                                } ?>><?php echo $rows['categori_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Details of expenses<b class="text-danger">(*)</b></label>
                                    <select class="select2" style="width:100%;" name="subcategori_id" id="subcategory" required>
                                        <option class="text-dark" selected="selected" value="<?php echo $row['subcategori_id ']; ?>"><?php echo $row['subcategori_name']; ?></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>প্রস্তা‌বিত/প‌রি‌শো‌ধিত বিল <strong class="text-danger">(অবশ্যই ইং‌রে‌জি হর‌ফে)</strong></label>
                                    <input type="text" name="expense_amount" value="<?php echo $row['expense_amount']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>তা‌রিখ(*)</label>
                                    <?php
                                    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                    ?>
                                    <input type="date" name="expense_date" value="<?php echo $row['expense_date']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>কেন খরচ হ‌য়ে‌ছে সেটা বর্ণনা করুন(*)</label>
                                    <textarea name="expense_note" rows="4" cols="50" class="form-control"><?php echo $row['expense_note']; ?></textarea>
                                </div>
                                <button type="submit" name="update" id="submit" class="btn btn-dark btn-block btn-rounded">Save Changes</button>
                            </form>
                        </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- JS include  here -->
    <?php require_once 'include/js.php'; ?>
    <?php

    $subcat = $_POST['thissubcategory'];

    $q = "SELECT * FROM sub_categories WHERE categori_id  = '$subcat' ";

    $result = mysqli_query($con, $q);

    while ($rows = mysqli_fetch_array($result)) {
    ?>
        <option value="<?php echo $rows['subcategori_id']; ?>"><?php echo $rows['subcategori_name']; ?></option>
    <?php
    }
    ?>

    <!-- JS  end include  here -->

</body>

</html>