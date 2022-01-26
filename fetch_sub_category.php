<?php

require_once 'config/dbconfig.php';
require_once 'include/session.php';

$subcat = $_POST['thissubcategory'];

$q = "SELECT * FROM sub_categories WHERE categori_id = '$subcat' ";

$result = mysqli_query($con, $q);

while ($rows = mysqli_fetch_array($result)) {
?>
    <option value="<?php echo $rows['subcategori_id']; ?>"><?php echo $rows['subcategori_name']; ?></option>
<?php
}
?>



