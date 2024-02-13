<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<?php 
    require('../config.php');
    if(isset($_POST['edit_btn'])){
        $id = $_POST['edit_id'];

        $stmt = $conn->prepare("SELECT * FROM product WHERE `id` = ? ");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->num_rows;

        if($total > 0){
            $row = $result->fetch_assoc();
        }
        else{
            echo "Records does not found";
        }
    
    
    }
?>
<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3" style="background-color: rgb(3, 3, 43);">
    <h6 class="m-0 font-weight-bold text-white">
        Edit Product Items     
    </h6>
  </div>
<div class="card-body px-5">

    <form action="code.php" method="post">
        <div class="row mb-3">
            <div class="col-6">
                <label for="">Product Name</label>
                <input type="hidden" name="edit_id" class="form-control" value="<?= $row['id']?>">
                <input type="text" name="pname" class="form-control" value="<?= $row['product_name']?>">
            </div>
            <div class="col-6">
                <label for="">Product Description</label>
                <input type="text" name="pdesc" class="form-control" value="<?= $row['product_desc']?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <label for="">Product Price</label>
                <input type="number" name="pprice" class="form-control" value="<?= $row['product_price']?>">
            </div>
            <div class="col-6">
                <label for="">Product Code</label>
                <input type="text" name="pcode" class="form-control" value="<?= $row['product_code']?>">
            </div>
        </div>

        <input type="submit" value="Update"  name="edit_product" class="btn btn-success form-control">
    </form>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>