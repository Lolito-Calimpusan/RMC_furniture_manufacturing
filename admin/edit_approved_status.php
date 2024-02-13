<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<?php 
    require('../config.php');
    if(isset($_POST['edit_status'])){
        $id = $_POST['id'];

        $stmt = $conn->prepare("SELECT * FROM approved_orders WHERE `id` = ? ");
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
                <label for="">Status</label>
                <input type="hidden" name="edit_id" class="form-control" value="<?= $row['id']?>">

                <select name="status" class="form-control">
                    <option value="We're now processing your Order(s)" <?php echo ($row['status'] == "We're now processing your Order(s)")? 'selected' : '';?>>We're now processing your Order(s)</option>
                    <option value="On Delivery" <?php echo ($row['status'] == "On Delivery")? 'selected' : '';?>>On Delivery</option>
                    <option value="Arrived" <?php echo ($row['status'] == "Arrived")? 'selected' : '';?>>Arrived</option>
                </select>
            </div>
            <div class="col-6">
                <label for="">Message Info</label>
                <input type="text" name="message" class="form-control" value="<?= $row['message']?>">
            </div>
        </div>

        <input type="submit" value="Update"  name="edit_status" class="btn btn-success form-control">
    </form>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>