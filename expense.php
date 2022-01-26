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

    <!---cdn css files area start-->
    <?php $page = '';

    if (isset($_POST['addexpense'])) {
        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
        $categori_id = $_POST['categori_id'];
        $subcategori_id = $_POST['subcategori_id'];
        $expense_amount = $_POST['expense_amount'];
        $expense_date = $_POST['expense_date'];
        $expense_note = $_POST['expense_note'];
        $entry_date = $dt->format('Y-m-d');

        $sql = "INSERT INTO `expenses`(`categori_id`, `subcategori_id`, `expense_amount`, `expense_date`, `expense_note`, `entry_date`) VALUES (' $categori_id','$subcategori_id',' $expense_amount','$expense_date','$expense_note',' $entry_date')";
        $result = mysqli_query($con, $sql);
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
        <?php
        if($menu="expense"); 
        require_once 'include/sidebar.php'; ?>
        <!-- sidebar end here -->


        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title"> Cost information.</h4>
                    </div>

                </div>
                <div class="card-header bg-dark">
                    <div class="row">
                        <div class="col-md-6 col-12 text-left">
                            <h4 class="mb-0 text-white">List Of Cost</h4>
                        </div>
                        <div class="col-md-6 col-12 text-right">
                            <button class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> List Of Cost <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="datatable table table-stripped ">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>DATE</th>
                                <th>Main Category</th>
                                <th>Sub Category</th>
                                <th>Details of expenses</th>
                                <th>Bill filed</th>
                                <th><i class="fa fa-pencil-square-o" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM expenses,categories_table,sub_categories WHERE expenses.categori_id = categories_table.categori_id AND expenses.subcategori_id = sub_categories.subcategori_id ORDER BY expenses.expense_id DESC";
                            $data = mysqli_query($con, $query);
                            $serial_no = 1;
                            $ea = 0;
                            $totalea = 0;
                            if (mysqli_num_rows($data) > 0) {
                                while ($row = mysqli_fetch_assoc($data)) {
                            ?>
                                    <tr>
                                        <td><?php echo $serial_no; ?></td>
                                        <td><?php echo date_format(date_create_from_format('Y-m-d', $row["expense_date"]), 'd-m-Y'); ?></td>
                                        <td><?php echo $row["categori_name"]; ?></td>
                                        <td><?php echo $row["subcategori_name"]; ?></td>
                                        <td><?php echo $row["expense_note"]; ?></td>
                                        <td><?php echo number_format($row["expense_amount"], 2); ?></td>
                                        <?php $ea = $row["expense_amount"]; ?>
                                        <td><a href="expense_edit.php?expense_id=<?php echo $row["expense_id"]; ?>" class="btn btn-success btn-rounded"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                    </tr>
                            <?php
                                    $serial_no++;
                                    $totalea += $ea;
                                }
                            }
                            ?>
                        </tbody>

                    </table>


                    <!-- Data Insert Modal -->
                    <div class="modal fade bd-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Add costs</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="validate_form" class="p-3" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>প্রধান খাত(*)</label>
                                            <select name="categori_id" class="select2" style="width:100%;" onchange="categoryName(this.value);">
                                                <option disabled="disabled" selected="selected" value="">প্রধান খাত নির্বাচন করুন*</option>
                                                <?php
                                                $fetch = "SELECT * from categories_table";
                                                $result = mysqli_query($con, $fetch);
                                                while ($rows = mysqli_fetch_array($result)) {
                                                ?>
                                                    <option value="<?php echo $rows['categori_id']; ?>"><?php echo $rows['categori_name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>খর‌চের বিবরণ<b class="text-danger">(*)</b></label>
                                            <select class="select2" style="width:100%;" name="subcategori_id" id="subcategory" required>
                                                <option class="text-dark" disabled="disabled" selected="selected">খর‌চের বিবরণ নির্বাচন করুন</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Bill  Amount</label>
                                            <input type="text" name="expense_amount" placeholder="Billed Bil" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Date<b class="text-danger">(*)</b></label>
                                            <?php
                                            $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                            ?>
                                            <input type="date" name="expense_date" value="<?php echo $dt->format('Y-m-d'); ?>" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Explain why the cost was incurred(*)</label>
                                            <textarea name="expense_note" rows="4" cols="50" class="form-control" placeholder="enter necessary details"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light btn-rounded" data-dismiss="modal">Close</button>
                                        <button type="submit" name="addexpense" class="btn btn-primary btn-rounded">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Data Insert Modal -->
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- JS include  here -->
    <?php require_once 'include/js.php'; ?>
    <!---Scripts area start-->
    
    <!---Scripts area end-->
    <!---additional scripts area start-->


    <script type="text/javascript">
        function categoryName(subcatvalue) {
            $.ajax({

                url: 'fetch_sub_category.php',
                type: 'POST',
                data: {
                    thissubcategory: subcatvalue
                },
                success: function(result) {
                    $('#subcategory').html(result);
                }
            });
        }
    </script>
    <!---additional scripts area end-->

    <!-- JS  end include  here -->

</body>

</html>