<?php
require_once 'config/dbconfig.php';
require_once 'include/session.php';
if (isset($_POST['saveInvoice'])) {
    $invoice_id = $_POST['invoice_id'];

    $invoice_date = $_POST['invoice_date'];

    $work_order_number = $_POST['work_order_number'];

    $pi_number = $_POST['pi_number'];

    $customer_id = $_POST['customer_id'];

    $customer_contact_no = $_POST['customer_contact_no'];

    $customer_address = $_POST['customer_address'];

    $totalafitem = $_POST['totalafitem'];

    $ovralldiscnt = $_POST['ovralldiscnt'];

    $ttlrecvammnt = $_POST['ttlrecvammnt'];

    $invPaidAmount = $_POST['InvPaidAmount'];

    $invDueAmount = $_POST['invDueAmount'];

    $payment_method = $_POST['payment_method'];

    $bank_name = $_POST['bank_name'];

    $cheque_no = $_POST['cheque_no'];

    $payment_status = $_POST['payment_status'];

    $instruction = $_POST['instruction'];

    $invoice_type = $_POST['invoice_type'];

    $vat = $_POST['vat'];

    $invoice_add_query = "INSERT INTO `invoice_table`(`invoice_id`,`invoice_type`,`pi_number`,`work_order_number`,`invoice_date`, `customer_id`, `customer_contact_no`,`customer_address`,`total_amount`, `overall_discount`, `total_recv_amount`, `paid_amount`, `due_amount`, `payment_status`, `instruction`, `vat`) VALUES ('$invoice_id','$invoice_type','$pi_number','$work_order_number','$invoice_date','$customer_id','$customer_contact_no','$customer_address','$totalafitem','$ovralldiscnt','$ttlrecvammnt','$invPaidAmount','$invDueAmount','$payment_status','$instruction','$vat')";

    $inv_sql = mysqli_query($con, $invoice_add_query);
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
        if($menu="invoice");
        require_once 'include/sidebar.php'; ?>
        <!-- sidebar end here -->

        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Blank Page</h4>
                    </div>
                </div>
                <form method="POST" id="invoice_add">
                    <!---Invoice And Customer Part--->
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Bill no(*)</label>
                                <input type="text" name="invoice_id" id="invoice_id" class="input form-control" placeholder="Bill no" onkeyup="checkInvoice(this.value);" onkeydown="checkInvoice(this.value);" required />
                                <div class="d-flex justify-content-center bg-danger text-white" id="chckInvoiceNo"></div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Select Invoice Type(*)</label>
                                <input type="text" list="invoice_type" name="invoice_type" class="form-control" placeholder="Invoice Type" required>
                                <datalist id="invoice_type">
                                    <option value="Development">Development</option>
                                    <option value="DomainHosting">DomainHosting</option>
                                </datalist>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Date of invoice(*)</label>
                                <?php
                                $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
                                ?>
                                <input type="date" name="invoice_date" id="invoiceDate" value="<?php echo $dt->format('Y-m-d'); ?>" class="form-control" required />
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 p-2">
                            <div class="form-group">
                                <label class="form-label">Customer Name<b class="text-danger">(*)</b></label>
                                <select name="customer_id" class="select2" style="width: 100%;" onchange="customerNumber(this.value);customeAddress(this.value)" required>
                                    <option class="text-dark" disabled="disabled" selected="selected">Choose Customer Name</option>
                                    <?php
                                    $q = "SELECT * FROM add_customer ORDER BY customer_name ASC";
                                    $result = mysqli_query($con, $q);
                                    while ($rows = mysqli_fetch_array($result)) {
                                    ?>
                                        <option value="<?php echo $rows['customer_id']; ?>"><?php echo $rows['customer_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                            <div class="form-group">
                                <input type="hidden" value="1" name="pi_number" class="input form-control" placeholder="PI number" />
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                            <div class="form-group">
                                <input type="hidden" value="1" name="work_order_number" class="input form-control" placeholder="work order number" />
                            </div>
                        </div>
                        <input type="hidden" name="customer_address" id="fetchcustomeraddress" class="form-control" placeholder="enter customer address">
                        <input type="hidden" name="customer_contact_no" id="fetchcustomernumber" class="form-control" placeholder="enter customer contact number">
                    </div>
                    <!---Invoice And Customer Part--->

                    <!---Product Add part start--->
                    <div style="border: 1px solid #000000;">
                        <div class="row p-2">
                            <input type="hidden" name="invoceNo[]" id="invoceNo" class="input form-control" required readonly />
                            <input type="hidden" id="productName" class="form-control" />

                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Item/Product Name(*)</label>
                                    <!-- <select name="item_name[]" id="itemNameCtoID" class="select2" style="width: 100%;" onchange="ProductName(this.value)" required>
                                        <option class="text-dark" disabled="disabled" selected="selected">Choose item Name</option>
                                        <?php
                                        $q = "SELECT * FROM product order by product_name ASC";
                                        $result = mysqli_query($con, $q);
                                        while ($rows = mysqli_fetch_array($result)) {
                                        ?>
                                            <option value="<?php echo $rows['unique_id']; ?>"><?php echo $rows['product_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select> -->
                                    <input type="text" name="item_name[]" id="itemNameCtoID" style="width: 100%;" onkeyup="ProductName(this.value)" onkeydown="ProductName(this.value)" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="hidden" name="chalan_no[]" id="chalanNo" style="width: 100%;" value="1" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="hidden" value="1" name="item_size[]" id="itemSize" placeholder="item size" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="hidden" value="1" name="unit[]" id="Unit" placeholder="unit" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Quantity(*)</label>
                                    <input type="text" name="item_quantity[]" id="item_quantity" placeholder="enter quantity" class="input form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Unit Price(*)</label>
                                    <input type="text" name="selling_price[]" id="selling_price" placeholder="enter price" class="input form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" name="total[]" id="total" placeholder="total*" class="input form-control" required readonly>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Discount(%)</label>
                                    <input type="text" name="discount[]" id="discount" placeholder="give discount(%)" value="0" class="input form-control">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Final Bill Amount</label>
                                    <input type="text" name="final_total[]" id="final_total" placeholder="final price*" class="input form-control" readonly required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Add Product To List</label>
                                    <button type="button" name="add_item" id="add_item" class="btn btn-dark btn-block">Add Product</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Product Add part end--->

                    <!---Product Append To List part Start--->
                    <div style="border: 1px solid #000000;">
                        <h2 class="text-center text-dark">Products List</h2>
                    </div>
                    <div class="row p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-center" id="item_field" style="font-size: small;">
                                <thead class="bg-dark">
                                    <tr>
                                        <td class="text-white">Chalan No</td>
                                        <td class="text-white">Item/Product</td>
                                        <td class="text-white">Size</td>
                                        <td class="text-white">Unit</td>
                                        <td class="text-white">Quantity</td>
                                        <td class="text-white">Unit Price</td>
                                        <td class="text-white">Final Total</td>
                                        <td class="text-white"><i class="fa fa-trash" aria-hidden="true"></i></i></td>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end" style="font-size: 14px;">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-12 pt-2 font-weight-bold">
                                            Total amount
                                        </div>
                                        <div class="col-lg-8 col-md-6 col-12">
                                            <input type="text" name="totalafitem" id="totalafitem" value="0" class="input form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" style="font-size: 14px;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 pt-1 font-weight-bold" style="font-size: 12px;">
                                        Overall discount
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12">
                                        <input type="text" name="ovralldiscnt" id="ovralldiscnt" value="0" class="input form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-end" style="font-size: 14px;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 pt-1 font-weight-bold" style="font-size: 12px;">
                                        Vat/Tax (%)
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12">
                                        <input type="text" name="vat" id="vat" value="0" class="input form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-end" style="font-size: 14px;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 pt-1 font-weight-bold" style="font-size: 12px;">
                                        Paid Amount
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12">
                                        <input type="text" name="InvPaidAmount" id="InvPaidAmount" value="0" class="input form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-end" style="font-size: 14px;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 pt-1 font-weight-bold" style="font-size: 12px;">
                                        Total recievable amount
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12">
                                        <input type="text" name="ttlrecvammnt" id="ttlrecvammnt" class="input form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-end" style="font-size: 14px;">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12 pt-1 font-weight-bold" style="font-size: 12px;">
                                        Due amount
                                    </div>
                                    <div class="col-lg-8 col-md-6 col-12">
                                        <input type="text" name="invDueAmount" id="InvDueAmount" class="input form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Product Append To List part end--->

                    <!-- Payment And Status Checked of Invoice -->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Payment method(*)</label>
                                <select name="payment_method" class="select2" style="width: 100%;">
                                    <option value="">Select payment method*</option>
                                    <option value="Cash on delivery">Cash on delivery</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Bank Name(*)</label>
                                <input type="text" name="bank_name" placeholder="bank name" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Cheque Number(*)</label>
                                <input type="text" name="cheque_no" placeholder="cheque number" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Payment staus(*)</label>
                                <select name="payment_status" class="select2" style="width: 100%;" required>
                                    <option value="Due">Due</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <label>Instruction*</label>
                            <textarea name="instruction" id="instruction" class="form-control"></textarea>
                        </div>
                    </div>
                    <!-- Payment And Status Checked of Invoice -->
                    <div class="p-3">
                        <center>
                            <input type="submit" name="saveInvoice" id="submit" class="btn btn-dark btn-rounded btn-block" value="Save Invoice">
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>

    <!-- JS include  here -->
    <?php require_once 'include/js.php'; ?>
    <!-- JS  end include  here -->

    <script>
        $(document).ready(function() {
            $('#invoice_add').parsley();
        });
    </script>

    <script type="text/javascript">
        function customeAddress(customerAddressdatavalue) {
            $.ajax({

                url: 'fetch_customer_address.php',
                type: 'POST',
                data: {
                    fetchcustomerAddresspost: customerAddressdatavalue
                },
                success: function(result) {
                    $('#fetchcustomeraddress').val(result);
                }
            });
        }
    </script>
    <!---Auto fetch customernumber info--->
    <script type="text/javascript">
        function customerNumber(customerNumberdatavalue) {
            $.ajax({

                url: 'fetch_customer_number.php',
                type: 'POST',
                data: {
                    fetchcustomerNumberpost: customerNumberdatavalue
                },
                success: function(result) {
                    $('#fetchcustomernumber').val(result);
                }
            });
        }
    </script>
    <!---Auto fetch customernumber info--->

    <script>
        document.getElementById('invoceNo').value = document.getElementById('invoice_id').value
    </script>

    <script>
        function checkInvoice(value) {
            $.ajax({
                url: 'fetch_invoice_id.php',
                type: 'POST',
                data: {
                    value: value
                },
                success: function(result) {
                    if (result == value && value != "") {
                        $('#chckInvoiceNo').html("Invoice no. already exist!");
                        $('#invoceNo').val(value);
                        document.getElementById("submit").disabled = true;
                        document.getElementById("add_item").disabled = true;
                    } else {
                        $('#chckInvoiceNo').html("");
                        $('#invoceNo').val(value);
                        document.getElementById("submit").disabled = false;
                        document.getElementById("add_item").disabled = false;
                    }
                }

            });
        }
    </script>

    <script type="text/javascript">
        function ProductName(productnamedatavalue) {
           /* $.ajax({

                url: 'fetch_product_name.php',
                type: 'POST',
                data: {
                    productpost: productnamedatavalue
                },
                success: function(result) {
                    $('#productName').val(result);
                }
            });*/
            $('#productName').val(productnamedatavalue);
        }
    </script>


    <script type="text/javascript">
        $(".input").on('input', function() {
            var qntty = document.getElementById('item_quantity').value;
            qntty = parseFloat(qntty);

            var sprice = document.getElementById('selling_price').value;
            sprice = parseFloat(sprice);


            if (Number.isNaN(sprice))
                sprice = 0;
            else if (Number.isNaN(qntty))
                qntty = 0;

            var Total = document.getElementById('total').value = ((qntty) * (sprice));

            var dcount = document.getElementById('discount').value;
            dcount = parseFloat(dcount);

            if (Number.isNaN(dcount))
                dcount = 0;

            document.getElementById('final_total').value = ((Total) - ((dcount / 100) * (Total)));
        });
    </script>


    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add_item').click(function() {
                var itemNamecId = document.getElementById('itemNameCtoID').value;
                var itemsize = document.getElementById('itemSize').value;
                var itmQntty = document.getElementById('item_quantity').value;
                var unit = document.getElementById('Unit').value;
                var itmSellprice = document.getElementById('selling_price').value;
                var itmDiscount = document.getElementById('discount').value;
                var itmTotal = document.getElementById('total').value;
                var itmFinaltotal = document.getElementById('final_total').value;
                var chalanno = document.getElementById('chalanNo').value;
                var invoceNo = document.getElementById('invoceNo').value;
                var pName = document.getElementById('productName').value;
                if (chalanno == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'chalan no is required!'
                    });
                } else if (itemNamecId == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'item name is required!'
                    });
                } else if (itmQntty == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'quantity is required!'
                    });
                } else if (itmQntty == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'quantity is required!'
                    });
                } else if (itmSellprice == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'selling price is required!'
                    });
                } else {
                    i++;
                    $('#item_field').append('<tr id="row' + i + '" class="text-center"><input type=hidden class=form-control readonly name="invoceNo[]" id=invoceNo' + i + ' value=' + invoceNo + '><td><input type=text name="chalan_no[]"class=form-control readonly value=' + chalanno + '><td>' + pName + '</td><input type=hidden name="item_name[]" class=form-control readonly value="' + itemNamecId + '"><td><input type="text" class=form-control name="item_size[]" readonly value=' + itemsize + '></td><td><input type=text class=form-control name="unit[]" readonly value=' + unit + '></td><td><input type=text class=form-control name="item_quantity[]" value=' + itmQntty + ' readonly></td><input type=hidden class=form-control name="selling_price[]" value=' + itmSellprice + ' readonly><input type=hidden class=form-control name="discount[]" value=' + itmDiscount + ' readonly><td><input type=text class=form-control name="total[]" value=' + itmTotal + ' readonly></td><td><input type=text class=form-control name="final_total[]" id=finalTotal' + i + ' value=' + itmFinaltotal + ' readonly></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove btn-rounded"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');

                    var fTotal = document.getElementById('finalTotal' + i).value;
                    fTotal = parseFloat(fTotal);

                    if (Number.isNaN(fTotal))
                        fTotal = 0;

                    var subTotal = document.getElementById('totalafitem').value = parseFloat(document.getElementById('totalafitem').value) + (fTotal);

                    var ttlrecAmmount = document.getElementById('ttlrecvammnt').value = parseFloat(document.getElementById('totalafitem').value);

                    $(".input").on('input', function() {

                        var vat = document.getElementById('vat').value;
                        vat = parseFloat(vat);

                        if (Number.isNaN(vat))
                            vat = 0;

                        var ttlrecAmmount = document.getElementById('ttlrecvammnt').value = parseFloat(document.getElementById('totalafitem').value);


                        var totalaftervat = ((ttlrecAmmount) + ((vat / 100) * ttlrecAmmount));

                        var Ovdiscount = document.getElementById('ovralldiscnt').value;
                        Ovdiscount = parseFloat(Ovdiscount);

                        if (Number.isNaN(Ovdiscount))
                            Ovdiscount = 0;

                        var TotalRecieableAmount = document.getElementById('ttlrecvammnt').value = ((totalaftervat) - ((Ovdiscount / 100) * (totalaftervat)));
                    });



                    $(".input").on('input', function() {
                        var INVDUEamount = document.getElementById('InvDueAmount').value = document.getElementById('ttlrecvammnt').value;

                        var INVPAIDamount = document.getElementById('InvPaidAmount').value;

                        if (Number.isNaN(INVPAIDamount))
                            INVPAIDamount = 0;

                        document.getElementById('InvDueAmount').value = parseFloat(INVDUEamount - INVPAIDamount);
                    });
                }
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                var final_total_id = document.getElementById('finalTotal' + button_id).value;
                var subTotal = document.getElementById('totalafitem').value = parseFloat(document.getElementById('totalafitem').value) - (final_total_id);
                var ttlrecAmmount = document.getElementById('ttlrecvammnt').value = parseFloat(document.getElementById('totalafitem').value);
                $('#row' + button_id + '').remove();
                var INVDUEamount = document.getElementById('InvDueAmount').value = document.getElementById('ttlrecvammnt').value;
                var arDueAmount = document.getElementById('InvDueAmount').value = parseFloat(INVDUEamount + INVPAIDamount);
                var INVPAIDamount = document.getElementById('InvPaidAmount').value = '0';
                var vat = document.getElementById('vat').value = '0';
                var ovralldiscnt = document.getElementById('ovralldiscnt').value = '0';
            });

            $('#submit').click(function() {


                //alert('Hellow');
                $.ajax({
                    url: "invoice_items_insert.php",
                    method: "POST",
                    data: $('#invoice_add').serialize(),
                    success: function(data) {
                        alert('Invoice added successfully');
                        console.log(data);
                        $('#invoice_add')[0].reset();
                    }
                });

            });
        });
    </script>
    <script>
        $(selector).keydown(function(e) {

        });
        onke
    </script>

</body>

</html>