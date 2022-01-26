<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';

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
        if ($menu = "report");
        require_once 'include/sidebar.php'; ?>
        <!-- sidebar end here -->

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Blank Page</h4>
                    </div>
                </div>
                <form action="category_wise_report.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Select Catagory:</label>
                            <select class="select" name="categori_id" required>
                                <option value="" selected="true" disabled>Select Catagory</option>
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
                        <div class="form-group">
                            <label for="From Date">From Date</label>
                            <input type="date" class="form-control insert" name="fromdate" required>
                        </div>
                        <div class="form-group">
                            <label for="To Date">To Date</label>
                            <input type="date" class="form-control insert" name="todate" required>
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="InsertUserbtn" class="btn btn-primary">submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- JS include  here -->
    <?php require_once 'include/js.php'; ?>
    <!-- JS  end include  here -->

</body>

</html>