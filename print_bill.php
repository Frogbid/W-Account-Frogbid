<?php
require_once 'config/dbconfig.php';

function fetch_data()
{
  $output = '';
  require('config/dbconfig.php');
  $invoice = $_GET['printid'];
  $serial_no = 1;
  $sql = "SELECT * FROM invoice_table,invoice_item_table WHERE invoice_table.invoice_id = invoice_item_table.invoice_id AND invoice_table.invoice_id = '$invoice' ORDER BY invoice_item_table.selling_price DESC";
  $result = mysqli_query($con, $sql);

  while ($row = mysqli_fetch_array($result)) {
    $output .= '<tr>  
                        <td>' . $serial_no . '</td> 
                        <td align="left">' . $row["item_name"] . '<br>' . $row["product_description"] . ' </td> 
                        <td align="center">' . preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($row["selling_price"],2)) . '</td> 
                        <td align="center">' . $row["item_quantity"] . '</td>     
                        <td align="center"> ' . preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($row["finalTotal"],2)) . '</td>    
                     </tr>  
                          ';
    $serial_no++;
  }
  return $output;
}
$invoice = $_GET['printid'];
$query = "SELECT * FROM invoice_table,invoice_item_table,add_customer WHERE invoice_table.invoice_id = invoice_item_table.invoice_id AND invoice_table.customer_id = add_customer.customer_id AND invoice_table.invoice_id = '$invoice' ORDER BY invoice_item_table.selling_price DESC";
$data = mysqli_query($con, $query);
$total = mysqli_num_rows($data);
$invoice_id = "";
$invoice_date = "";
$customer_id = "";
$customer_contact_no = "";
$customer_address = "";
$total_amount = "";
$paid_amount = "";
$total_recv_amount = "";
$due_amount = "";
$item_quantity = "";
$customer_name = "";
$vat = "";
$overall_discount = "";
$totalQuantity = 0;
if ($total != 0) {
  while ($result = mysqli_fetch_assoc($data)) {
    $invoice_id = $result['invoice_id'];
    $invoice_date = $result['invoice_date'];
    $customer_id = $result['customer_id'];
    $customer_name = $result['customer_name'];
    $customer_contact_no = $result['customer_phone'];
    $customer_email = $result['customer_email'];
    $total_recv_amount = $result['total_recv_amount'];
    $customer_address = $result['customer_address'];
    $item_quantity = $result['item_quantity'];
    $total_amount = $result["total_amount"];
    $paid_amount = $result['paid_amount'];
    $due_amount = $result["due_amount"];
    $vat = $result["vat"];
    $overall_discount = $result["overall_discount"];
    $totalQuantity = $totalQuantity + $item_quantity;
    $convertAmount = round($result["total_recv_amount"]);
  }
} else {
  "No Records Found!!!";
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript">
    function print_page() {
      var ButtonControl = document.getElementById("btnprint");
      ButtonControl.style.visibility = "hidden";
      window.print();
    }
  </script>
</head>

<body>

  <div class="page-header" style="text-align: center">
    <div class="table-responsive">
      <table class="table table-borderless">
        <tr>
          <th rowspan="3" class="billing_property"><small class="bill_T0_Font_Size">Bill To</small><br>
            <small class="customer_Name"><?php echo $customer_name; ?></small><br>
            <small class="phn_Font-Size">PHN:<?php echo $customer_contact_no; ?></small><br>
            <small class="gmail_Font-Size">Gmail:<?php echo  $customer_email; ?></small><br>
            <small class="address_Font_Size"><?php echo $customer_address; ?></small>

          </th>
          <th rowspan="3" class="invoice_space"></th>
          <th colspan="3"><i> <span class="invoice_Color">&nbsp;I N &nbsp;</span> <span class="voice_Font_Size"> V O I C E</span></i></th>

        </tr>
        <tr>
          <td class="invoice_Font_Size"> Invoice No:</br> <?php echo $invoice_id; ?> </td>
          <td class="customer_Number_Font_Size">Customer No:</br><?php echo $customer_id; ?></td>
          <td class="Due_Font_Size"> DUE Date:<br><?php echo date_format(date_create_from_format('Y-m-d', $invoice_date), 'd-m-Y'); ?> </td>
        </tr>
        <tr>
          <td colspan="3" class="total_Due">Total Due: BDT <?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round(($total_recv_amount - $paid_amount),2)) ?></td>
        </tr>
      </table>
      <!-- <button class="btn btn-success" type="button" onClick="window.print()">Print Invoice!</button> -->
      <input type="button" id="btnprint" value="Print this Page" onclick="print_page()" />
    </div>
  </div>

  <div class="page-footer" style="height:150px;">
    <img src="assets/img/invoice.png" width=100% height=95% alt="No Image">
  </div>

  <table class="table">

    <thead>
      <tr>
        <td>
          <!--place holder for the fixed-position header-->
          <div class="page-header-space"></div>
        </td>
      </tr>
    </thead>

    <tbody>
      <!--** CONTENT GOES HERE **-->
      <div class="page" style="line-height: 3;">
        <!--** BODY GOES HERE **-->
        <thead class="thead_border_Color">
          <tr>
            <th scope="col" class="text-center" width="10%">S.No</th>
            <th scope="col" class="text-left" width="30%">Item Description</th>
            <th scope="col" class="text-center" width="20%">Unit Price</th>
            <th scope="col" class="text-center" width="10%">QTY</th>
            <th scope="col" class="text-center" colspan="20" width="30%">Amount</th>
          </tr>
        </thead>
    <tbody>
      <?php echo fetch_data(); ?>
      <tr>
        <td colspan="2">
          <p class="payment_Method">Payment Method</p>
          <i class="fa fa-bank"></i> <small class="Bank"><span class="paypal_Color">Bank</span>:Deposit to Bank/Cheque</small><br>
          <i class="fa fa-credit-card"></i> <small class="card_Payment">Card Payment:Visa,Master Card</small><br>
          <i class="fa fa-check"></i> <small class="we_Accept">We Accept:Bkash</small>
        </td>
        <td colspan="2">
          <?php
          $dis = ($total_amount * ($overall_discount / 100));
          $vat_cal_am = $total_amount - $dis;
          $vat_am = ($vat_cal_am * ($vat / 100));

          ?>
          <p class="tax_Vat">Tax/Vat (<?php echo $vat ?>%)<span> &emsp;BDT <?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($vat_am,2)) ?></span></p>
          <hr class="horizontal_Line_Color">
          <p class="discount_Color">Discount(<?php $overall_discount;
                                              ?>%)<span> &emsp; BDT <?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($dis,2)) ?></span></p>
          <hr class="horizontal_Line_Color">

          <p class="tax_Vat">Paid<span> &emsp; BDT <?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($paid_amount,2)) ?></span></p>
          <hr class="horizontal_Line_Color">
          <br>
          <br>
          <br>
          <hr class="horizontal_Line_Color">
          <span>Company Signature</span>
        </td>
        <td colspan="2">
          <p class="tax_Vat">SUB TOTAL<span> &emsp;BDT <?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($total_amount,2)) ?></span></p>
          <hr class="horizontal_Line_Color">
          <p class="discount">GRAND TOTAL<span> &emsp; BDT <?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round($total_recv_amount,2)) ?></span></p>
          <hr class="horizontal_Line_Color">

          <p class="discount_Color">Due<span> &emsp; BDT <?php echo preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", round(($total_recv_amount - $paid_amount),2)) ?></span></p>
          <hr class="horizontal_Line_Color">
          <br>
          <br>
          <br>
          <hr class="horizontal_Line_Color">
          <span>Client Signature</span>
        </td>
      </tr>




      <tr>
        <td colspan="4">
          <h3 class="terms_And_Condition">Terms & Notes</h3>
          <small class="example">We mainly prefer cash payment. If you provide the payment in some other methods have to send us the prove. For mobile banking you must have to pay the additional charges.</small>
        </td>
        <td colspan="2">
          <br>
          <p class="thank_You font-weight-bold" ><i>T h a n k &nbsp; y o u!</i></p>

        </td>
      </tr>
    </tbody>
    <!--** BODY GOES HERE **-->
    </div>
    </tbody>

    <tfoot>
      <tr>
        <!--place holder for the fixed-position footer-->
        <div class="page-footer-space"></div>
      </tr>
    </tfoot>

  </table>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>