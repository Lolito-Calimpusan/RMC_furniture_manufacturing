<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<!-- modal for adding products -->
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

            <div class="form-group">
                <label> Product Name </label>
                <input type="text" name="pname" class="form-control" placeholder="Enter Product name">
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <input type="text" name="pdesc" class="form-control" placeholder="Enter Product Description">
            </div>
            <div class="form-group">
                <label>Product Price</label>
                <input type="number" name="pprice" class="form-control" placeholder="Enter Product Price">
            </div>
            <div class="form-group">
                <label>Product Code</label>
                <input type="text" name="pcode" class="form-control" placeholder="Enter Product Code">
            </div>
            <div class="form-group">
                <label>Product Image</label>
                <input type="file" name="image" class="form-control" placeholder="Upload Image " >
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-control">
                    <option value="others">None</option>
                    <option value="living">Living</option>
                    <option value="dinning">Dinning</option>
                    <option value="bed">Bed</option>
                </select>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addProductBtn" class="btn btn-primary">Submit</button>
        </div>
      </form>

    </div>
  </div>
</div>


<!-- table for products-->


<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-dark">Products
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="float: right;">
                Add Products
              </button>
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
          $stmt = $conn->prepare("SELECT * FROM product");
          $stmt->execute();
          $result = $stmt->get_result();
          $total = $result->num_rows;
        

          if($total > 0){
            $row = $result->fetch_assoc();?>

            <?php do{ ?>
            <tr class="hover-tr">
              <td>
                <a href="products/<?php echo $row['product_image'];?>">
                <img src="products/<?php echo $row['product_image'];?>" alt="image" width="40px" height="40px">
                </a>
              </td>
              
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
            <?php } while($row = $result->fetch_assoc());

          }else{
            echo '<td colspan="8">No products</td>';
          }

          
            ?>
    
    </tbody>
  </table>

  </div>
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>