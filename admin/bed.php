<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>




<!-- table for products-->


<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-dark">
        Bed Items  
      </h5>
    </div>
  <div class="card-body">


  <div class="table-responsive">

  <?php
        if(isset($_SESSION['success']) && $_SESSION['success'] !='')
        {
           echo '<div class="alert alert-success alert-dismissible mt-2">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>'.$_SESSION['success']. '</strong>
                 </div>';
            unset($_SESSION['success']);
        }
        else if(isset($_SESSION['status']) && $_SESSION['status'] !='')
        {
          echo '<div class="alert alert-danger alert-dismissible mt-2">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>'.$_SESSION['status']. '</strong>
                </div>';
            unset($_SESSION['status']);
        }
    ?>

  <table class="table table-bordered text-dark text-center" id="dataTable" width="100%" cellspacing="0" style="box-shadow: 0px 2px 2px rgba(0,0,0,0.3);">
    <thead>
      <tr style="background-color: rgb(3, 3, 43); color: white;">
        <th>Image</th>
        <th>Product Name</th>
        <th>Product Description</th>
        <th>Price</th>
        <th>Product Code</th>
        <th>Category</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>

      <?php
          require('../config.php');
          $stmt = $conn->prepare("SELECT * FROM product WHERE category = 'bed' ");
          $stmt->execute();
          $result = $stmt->get_result();
          $total = $result->num_rows;
        

          if($total > 0){
            $row = $result->fetch_assoc();
          }
          else{
            echo " Emmpty Records";
          }
      ?>
      <?php do{ ?>
      <tr class="hover-tr">
        <td><a href="products/<?= $row['product_image'];?>">
        <img src="products/<?= $row['product_image'];?>" width="40px" height="40px">
        </a></td>
        <td><?= $row['product_name'];?></td>
        <td><?= $row['product_desc'];?></td>
        <td>&#8369; <?= number_format($row['product_price'],2) ?></td>
        <td><?= $row['product_code'];?></td>
        <td><?= $row['category'];?></td>
      
      
        <td>
            <form action="edit_product.php" method="post">
                <input type="hidden" name="edit_id" value="<?= $row['id']; ?>">
                <button  type="submit" name="edit_btn" class="btn btn-success"> <i class="fas fa-edit"></i> </button>
            </form>
        </td>
        <td>
            <form action="code.php" method="post">
              <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
              <button type="submit" name="delete_btn" class="btn btn-danger"> <i class="fa fa-trash"></i> </button>
            </form>
        </td>
        </tr>
        <?php } while($row = $result->fetch_assoc()); ?>
    
    </tbody>
  </table>

  </div>
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>