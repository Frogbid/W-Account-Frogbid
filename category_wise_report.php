<!DOCTYPE html>
<html lang="en" data-kit-theme="default">

<head>
    <!---cdn css files area start-->
    <?php $page = '';
    require_once 'config/dbconfig.php';
    require_once 'include/session.php';

    ?>
    <?php require_once 'include/css.php'; ?>
    <!---cdn css files area end-->
    <!---print button css area--->
    <style>
        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
    <!---print button css area end--->
</head>

<body class="air__menu--gray air__layout--contentNoMaxWidth">
    <!---preloader area start-->

    <!---preloader area end-->
    <div class="air__layout air__layout--hasSider">

        <!---mobile menu area start-->
        <div class="air__menuLeft__backdrop air__menuLeft__mobileActionToggle"></div>
        <!---mobile menu area end-->

        <div class="air__layout">
            <!---main page content write here-->
            <div class="air__layout__content">
                <div class="air__utils__content">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header">
                                <div class="mt-2 text-center">
                                    <?php
                                    $f = date_create($_POST['fromdate']);
                                    $t = date_create($_POST['todate']);
                                    ?>
                                    <?php
                                    $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                    ?>
                                    <h6><b>Printing Date: <?php echo $dt->format('d-m-Y'); ?>&nbsp;| <?php echo $dt->format('h:i a'); ?></b></h6>
                                    <hr>
                                    <h4>
                                        <?php
                                        $categoryid = $_POST['categori_id'];
                                        $fdate = $_POST['fromdate'];
                                        $tdate = $_POST['todate'];
                                        ?>
                                        <b> Report </b><br>
                                        <b>From <?php echo date_format($f,"d-m-Y"); ?> To <?php echo date_format($t,"d-m-Y"); ?></b>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            
                            $query = "SELECT * FROM expenses,categories_table,sub_categories WHERE expenses.categori_id = categories_table.categori_id AND expenses.subcategori_id = sub_categories.subcategori_id AND expenses.categori_id='$categoryid' AND (expenses.expense_date BETWEEN '$fdate' AND '$tdate') GROUP BY expenses.categori_id";
                            $data = mysqli_query($con, $query);
                            if (mysqli_num_rows($data) > 0) {
                                while ($row = mysqli_fetch_assoc($data)) {
                            ?>
                                    <div class="table-responsive p-2">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <td colspan="5">
                                                        <h4><?php echo $row['categori_name']; ?></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>SL No </th>
                                                    <th>Sub Category Name</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Note</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $query1 = "SELECT * FROM expenses,categories_table,sub_categories WHERE expenses.categori_id = categories_table.categori_id AND expenses.subcategori_id = sub_categories.subcategori_id AND expenses.categori_id = '$categoryid' AND (expenses.expense_date BETWEEN '$fdate' AND '$tdate')";
                                            $result = mysqli_query($con, $query1);
                                            $serial_no = 1;
                                            $ea = 0;
                                            $totalea = 0;
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $serial_no; ?></td>
                                                        <td><?php echo $row["subcategori_name"]; ?></td>
                                                        <td><?php echo $row["expense_date"]; ?></td>
                                                        <td><?php echo number_format($row["expense_amount"], 2); ?></td>
                                                        <td><?php echo $row["expense_note"]; ?></td>

                                                        <?php $ea = $row["expense_amount"]; ?>
                                                    </tr>
                                                </tbody>
                                            <?php
                                                $serial_no++;

                                                $totalea += $ea;
                                            }
                                            ?>
                                            <tfoot>
                                                <tr>
                                                    <td class="font-weight-bold"></td>
                                                    <td class="font-weight-bold" colspan="2">Total</td>

                                                    <td class="font-weight-bold"colspan="2"><?php echo number_format($totalea, 2); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <div class="m-2">
                                <button id="printPageButton" onclick="window.print()" class="btn btn-rounded btn-block btn-dark"><i class="fa fa-print" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>