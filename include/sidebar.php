
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            
            <ul>
                <li class="menu-title">Main</li>
                <li class="<?php if($menu == "dashboard"){echo "active";}?>">
                    <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="<?php if($menu == "catagory"){echo "active";}?>">
                    <a href="catagory.php"><i class="fa fa-dashboard"></i> <span>Catagory</span></a>
                </li>
                <li class="<?php if($menu == "subcatagory"){echo "active";}?>">
                    <a href="subcatagory.php"><i class="fa fa-dashboard"></i> <span>SubCatagory</span></a>
                </li>
                <li class="<?php if($menu == "expense"){echo "active";}?>">
                    <a href="expense.php"><i class="fa fa-dashboard"></i> <span>Expense</span></a>
                </li>

                <li class="<?php if($menu == "add_customer"){echo "active";}?>"> 
                    <a href="add_customer.php"><i class="fa fa-dashboard"></i> <span>Add Customer</span></a>
                </li>

                <li class="<?php if($menu == "product"){echo "active";}?>">
                    <a href="product.php"><i class="fa fa-dashboard"></i> <span>Add Product</span></a>
                </li>

                <li class="<?php if($menu == "income"){echo "active";}?>">
                    <a href="income.php"><i class="fa fa-dashboard"></i> <span>Income</span></a>
                </li>
                <li class="<?php if($menu == "report"){echo "active";}?>">
                    <a href="report.php"><i class="fa fa-dashboard"></i> <span>Report</span></a>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fa fa-user"></i> <span>Invoice </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="<?php if($menu == "invoice"){echo "active";}?>"><a href="invoice.php">Make Invoice</a></li>
                        <li  class="<?php if($menu == "view_invoice"){echo "active";}?>"><a href="view_invoice.php">Print Invoice</a></li>

                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
