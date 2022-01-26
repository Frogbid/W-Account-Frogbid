<!-- database conection start here  -->
<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';

/* insert code start here */

if (isset($_POST['InsertUserbtn'])) {
    $Subcatagory_Name = $_POST['Subcatagory_Name'];
    $catagory = $_POST['catagory'];

    $sql = "INSERT INTO `sub_categories`(`categori_id`, `subcategori_name`) VALUES ('$catagory','$Subcatagory_Name')";
    $result = mysqli_query($con, $sql);

    /* insert code start here */

    /* insert  pop up text code start here */

    if ($result) {
?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Catagory Up has been successfully added.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php
        //header('Location:catagory.php');
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

/* insert  pop up text code end here */

/* delete code start from here */
if (isset($_POST['DeleteUserbtn'])) {
    $userid = $_POST['delete_id'];
    $sql = "DELETE FROM `sub_categories` WHERE subcategori_id = $userid ";
   
    $result = mysqli_query($con, $sql);

    if ($result) {
        header('Location:subcatagory.php');
    } else {
        echo "delete not success";
    }
}

/* delete code end here */






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
        if($menu="subcatagory");
        require_once 'include/sidebar.php'; ?>
        <!-- sidebar end here -->


        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title"> SUb Catagory</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="" class="btn btn btn-primary btn-rounded float-right insert"><i class="fa fa-plus"></i> Add Sub Catagory</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="datatable table table-stripped ">
                        <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Sub-Catagory Name</th>
                                <th>Catagory Name</th>
                                <th><a class="dropdown-item" href="#">Edit</a></th>
                                <th><a class="dropdown-item delete_user_id" href="#"></a>Delete</th>


                            </tr>
                        </thead>
                        <tbody>
                            <!-- select code start here -->
                            <?php
                            $query = "SELECT * FROM categories_table,sub_categories where categories_table.categori_id = sub_categories.categori_id";
                            $data = mysqli_query($con, $query);
                            $serial_no = 1;
                            if (mysqli_num_rows($data) > 0) {
                                while ($row = mysqli_fetch_assoc($data)) {
                            ?>
                                    <tr>
                                        <td><?php echo $serial_no; ?></td>
                                        <td><?php echo $row["subcategori_name"]; ?></td>
                                        <td><?php echo $row["categori_name"]; ?></td>
                                        <td><a href="edit_subcatagory.php?subcategoryid=<?php echo $row["subcategori_id"]; ?>" class="btn btn-dark btn-rounded"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                        <td> <button type="button" value="<?php echo $row["subcategori_id"]; ?>" class="btn btn-danger   btn-rounded deletebtn"><i class="fa fa-trash" aria-hidden="true"></i></button>




                                    </tr>
                            <?php
                                    $serial_no++;
                                }
                            }
                            ?>
                            <!-- select code end here -->



                        </tbody>
                    </table>
                </div>
                <!-- delete modal start here -->
                <div class="modal" id="DeleteModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="#" method="POST">
                                <div class="modal-body">
                                    <input type="text" name="delete_id" class="delete_user_id" hidden>
                                    <p>
                                        Are you sure.You want to delete this data?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                    <button type="submit" name="DeleteUserbtn" class="btn btn-danger">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- delete modal end here -->
                <!-- Insert   sub catagory  modal start here -->
                <div class="modal" id="InsertModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">INSERT Sub Catagory</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Select Catagory:</label>
                                        <select class="select" name="catagory">
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
                                        <label for="Catagory Name"> Sub Catagory Name</label>
                                        <input type="text" class="form-control insert" name="Subcatagory_Name" placeholder="Sub Catagory Name">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                    <button type="submit" name="InsertUserbtn" class="btn btn-primary">submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>


                <!-- Insert sub catagory   modal end here -->
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