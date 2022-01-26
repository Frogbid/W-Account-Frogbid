<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';

?>
<!-- database conection end here  -->

<link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

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
        if($menu="view_invoice"); 
        require_once 'include/sidebar.php'; ?>
        <!-- sidebar end here -->

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Blank Page</h4>
                    </div>
                </div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Invoice Number</th>
                            <th>Customer Name</th>
                            <th>Total Amount</th>
                            <th>Paid amount</th>
                            <th>Due Amount</th>
                            <th>Print BDT</th>
                            <th>Print Dollar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select * FROM invoice_table,add_customer WHERE invoice_table.customer_id = add_customer.customer_id";
                        $result1 = mysqli_query($con, $sql);
                        $serial_no = 1;
                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                        ?>
                                <tr>
                                    <td><?php echo $serial_no; ?></td>
                                    <td><?php echo $row['invoice_no']; ?></td>
                                    <td><?php echo $row['customer_name']; ?></td>
                                    <td><?php echo $row['total_recv_amount']; ?></td>
                                    <td><?php echo $row['paid_amount']; ?></td>
                                    <td><?php echo $row['due_amount']; ?></td>
                                    <td><a href="print_bill.php?printid=<?php echo $row["invoice_id"]; ?>" class="btn btn-dark btn-rounded"><i class="fa fa-print" aria-hidden="true"></i></a></td>
                                    <td><a href="print_bill_dollar.php?printid=<?php echo $row["invoice_id"]; ?>" class="btn btn-dark btn-rounded"><i class="fa fa-print" aria-hidden="true"></i></a></td>
                            <?php
                                $serial_no++;
                            }
                        }
                            ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- JS include  here -->
    <?php require_once 'include/js.php'; ?>

    <!-- JS  end include  here -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script src="cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

</body>

</html>