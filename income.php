<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';


if (isset($_POST['InsertUserbtn'])) {
    $amount = $_POST['amount'];
    $date    = $_POST['date'];
    $note = $_POST['note'];
    $sql = "INSERT INTO `income`(`amount`,`date`,`note`) VALUES ('$amount','$date','$note')";
    $result = mysqli_query($con, $sql);
    if ($result) {

        header('Location:income.php');
    } else { ?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Something is worng.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


<?php

        //header('Location:catagory.php');
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
        <?php 
        if($menu="income");
        require_once 'include/sidebar.php'; ?>
        <!-- sidebar end here -->


        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Income</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="" class="btn btn btn-primary btn-rounded float-right insert"><i class="fa fa-plus"></i>Add Income</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="datatable table table-stripped ">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Note</th>
                                <th><a class="dropdown-item" href="#">Edit</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM income ORDER BY income_id DESC";
                            $data = mysqli_query($con, $query);
                            $serial_no = 1;
                            if (mysqli_num_rows($data) > 0) {
                                while ($row = mysqli_fetch_assoc($data)) {
                            ?>
                                    <tr>
                                        <td><?php echo $serial_no; ?></td>
                                        <td><?php echo $row["amount"]; ?></td>
                                        <td><?php echo $row["date"]; ?></td>
                                        <td><?php echo $row["note"]; ?></td>
                                        <td><a href="edit_income.php?incomeid=<?php echo $row["income_id"]; ?>" class="btn btn-dark btn-rounded"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>


                                    </tr>
                            <?php
                                    $serial_no++;
                                }
                            }
                            ?>

                        </tbody>
                    </table>





                    <!-- Insert  modal start here -->
                    <div class="modal" id="InsertModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Income</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST">
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control insert" name="amount">

                                        </div>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="date">Date</label>

                                            <input type="date" name="date" class="form-control">

                                        </div>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="Note">Note</label>
                                            <textarea class="form-control" name="note" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="modal-body">

                                        <button type="submit" name="InsertUserbtn" class="btn btn-primary">Add Customer</button>

                                    </div>

                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>


            <!-- Insert  modal end here -->
        </div>
    </div>
    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- JS include  here -->
    <?php require_once 'include/js.php'; ?>


    <!-- delete modal js code start here -->
    <script>
        $(document).ready(function() {
            $('.deletebtn').click(function(e) {
                e.preventDefault();
                var user_id = $(this).val();
                //console.log(user_id);
                $('.delete_user_id').val(user_id);
                $('#DeleteModal').modal('show');



            });
        });
    </script>
    <!-- delete modal js code end here -->

    <!-- Insert  modal JS Code start here -->



    <!-- Insert  modal JS Code End here -->
    <script>
        $(document).ready(function() {
            $('.insert').click(function(e) {
                e.preventDefault();
                //var user_id = $(this).val();
                //console.log(user_id);
                // $('.insert').val(user_id);
                $('#InsertModal').modal('show');



            });
        });
    </script>



    <!-- JS  end include  here -->

</body>

</html>