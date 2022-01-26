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
        if($menu="dashboard");
         require_once 'include/sidebar.php'; ?>
        <!-- sidebar end here -->

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg1"><i class="fa fa-money" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                $month = $dt->format('m');
                                $sql = "SELECT SUM(total_recv_amount) AS monthlyincome,invoice_date FROM invoice_table WHERE MONTH(invoice_date)='$month'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $monthlyincome = $row["monthlyincome"];
                                    }
                                }
                                ?>
                                <h3><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($monthlyincome)); ?></h3>
                                <span class="widget-title1">Monty Income<i class="fa fa-money" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-arrows-alt"></i></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                $month = $dt->format('m');
                                $sql = "SELECT SUM(expense_amount) AS monthlyexpense,expense_date FROM expenses WHERE MONTH(expense_date)='$month'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $monthlyexpense = $row["monthlyexpense"];
                                    }
                                }
                                ?>
                                <h3><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($monthlyexpense)); ?></h3>
                                <span class="widget-title2">Monty Expense <i class="fa fa-money" aria-hidden="true"></i></span>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                $year = $dt->format('Y');
                                $sql = "SELECT SUM(total_recv_amount) AS yearlyincome,invoice_date FROM invoice_table WHERE YEAR(invoice_date)='$year'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $yearlyincome = $row["yearlyincome"];
                                    }
                                }
                                ?>
                                <h3><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($yearlyincome)); ?></h3>
                                <span class="widget-title3">Yearly Income <i class="fa fa-money" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-credit-card-alt"></i></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                $year = $dt->format('Y');
                                $sql = "SELECT SUM(expense_amount) AS yearly_expense,expense_date FROM expenses WHERE YEAR(expense_date)='$year'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $yearly_expense = $row["yearly_expense"];
                                    }
                                }
                                ?>
                                <h3><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($yearly_expense)); ?></h3>
                                <span class="widget-title2">Yearly Expense <i class="fa fa-money" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg1"><i class="fa fa-money" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <?php


                                $sql = "SELECT COUNT(invoice_no) AS no_of_invoice FROM invoice_table";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $no_of_invoice = $row["no_of_invoice"];
                                    }
                                }
                                ?>

                                <h3><?php echo  $no_of_invoice ?></h3>
                                <span class="widget-title1">No. of Invoice<i class="fa fa-money" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-arrows-alt"></i></span>
                            <div class="dash-widget-info text-right">
                                <?php


                                $sql = "SELECT COUNT(categori_id) AS no_of_cat FROM categories_table";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $no_of_cat = $row["no_of_cat"];
                                    }
                                }
                                ?>
                                <h3><?php echo  $no_of_cat ?></h3>

                                <span class="widget-title2">No. of Catagories <i class="fa fa-money" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-bar-chart" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <?php


                                $sql = "SELECT COUNT(subcategori_id) AS no_of_subcat FROM sub_categories";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $no_of_subcat = $row["no_of_subcat"];
                                    }
                                }
                                ?>
                                <h3><?php echo  $no_of_subcat ?></h3>

                                <span class="widget-title3">No. of Sub-Catagories <i class="fa fa-money" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-credit-card-alt"></i></span>
                            <div class="dash-widget-info text-right">
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                $today = $dt->format('Y-m-d');
                                $sql = "SELECT SUM(expense_amount) AS todayexpense,expense_date FROM expenses WHERE expense_date='$today'";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $todayexpense = $row["todayexpense"];
                                    }
                                }
                                ?>
                                <h3><?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($todayexpense)); ?></h3>
                                <span class="widget-title2">Today Expense <i class="fa fa-money" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4>Patient Total</h4>
                                    <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span>
                                </div>
                                <canvas id="linegraph"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="chart-title">
                                    <h4>Patients In</h4>
                                    <div class="float-right">
                                        <ul class="chat-user-total">
                                            <li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
                                            <li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li>
                                        </ul>
                                    </div>
                                </div>
                                <canvas id="bargraph"></canvas>
                            </div>
                        </div>
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