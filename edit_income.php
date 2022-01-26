<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';



$id = $_GET['incomeid'];
$sql = "SELECT * FROM `income` WHERE income_id = '$id'";

$result = mysqli_query($con, $sql);
$income =  mysqli_fetch_array($result);
/* update code start  here*/

if (isset($_POST['update'])) {
    $amount = $_POST['amount'];
    $date    = $_POST['date'];
    $note = $_POST['note'];

    $sql = "UPDATE `income` SET`amount`='$amount',`date`='$date',`note`='$note' WHERE income_id = '$id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo $successMsg = 'New record updated successfully';
        header('Location:income.php');
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
                        <h4 class="page-title">Edit Income Info</h4>
                        <form action="#" method="POST">
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Amount : </label>
                                <div class="col-md-10">
                                    <input type="text" name="amount" class="form-control" value="<?php echo $income['amount']; ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-2">Date : </label>
                                <div class="col-md-10">
                                    <input type="date" name="date" class="form-control" value="<?php echo $income['date']; ?>">

                                </div>
                            </div>
                            <div class="form-group row">
                             <label class="col-form-label col-md-2"> Note : </label> 
                                
                                <div class="col-md-10">

                                    <input class="form-control" name="note" rows="5" value="<?php echo $income['note']; ?>">

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