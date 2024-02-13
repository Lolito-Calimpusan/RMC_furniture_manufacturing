<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">
            <div class="form-group">
                <label> Firstname </label>
                <input type="text" name="fname" class="form-control" placeholder="Enter Firstname">
            </div>
            <div class="form-group">
                <label> Lastname </label>
                <input type="text" name="lname" class="form-control" placeholder="Enter Lastname">
            </div>
            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" class="form-control" placeholder="Enter Age">
            </div>
            <div class="form-group">
                <label>Gender</label>
                <input type="text" name="gender" class="form-control" placeholder="Enter Gender">
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="address" name="address" class="form-control" placeholder="Enter Address">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="number" name="phone" class="form-control" placeholder="Enter Phone">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" placeholder="Enter Password">
            </div>
            
            <!-- role -->
            <input type="hidden" name="role" class="form-control" Value="Admin">
        
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addAdminBtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow">
  <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-dark">Admin Profile 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="float: right;">
                  Add Admin Profile 
                </button>
        </h5>
      </div>
  </div>

  <div class="card-body">
    
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

    <div class="table-responsive">

      <table class="table table-bordered text-dark text-center" id="dataTable"  cellspacing="0" style="box-shadow: 0px 2px 2px rgba(0,0,0,0.3);">
        <thead>
          <tr style="background-color: rgb(3, 3, 43); color: white;">
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Gender</th>
            <th colspan=3> Action</th>
          </tr>
        </thead>
        <tbody>
     
          <?php
              require('../config.php');
              $i = 1;
              $stmt = $conn->prepare("SELECT * FROM register WHERE role = 'Admin' && status = 'show' ");
              $stmt->execute();
              $result = $stmt->get_result();
              $total = $result->num_rows;
             

              if($total > 0){
                $row = $result->fetch_assoc();
              }
              else{
                 echo " Empty Records";
              }
          ?>
          <?php do{ ?>
          <tr>
            <td><?= $i++; ?></td>
            <td>
              <a href="users_pictures/<?= $row['image'];?>">
                <img src="users_pictures/<?= $row['image'];?>" alt="Profile Picture" width="35px" height="35px">
              </a>
            </td>
            <td><?= $row['fname']." ". $row['lname'];?></td>
            <td><?= $row['gender'];?></td>
            <td style="width: 13px;">
                <form action="view_admin_details.php" method="post">
                    <input type="hidden" name="view_id" value="<?= $row['id']; ?>">
                    <button  type="submit" name="view" class="btn btn-primary"> <i class="fas fa-eye"></i></button>
                </form>
            </td>
            <td style="width: 13px;">
                <form action="edit_admin.php" method="post">
                    <input type="hidden" name="edit_id" value="<?= $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> <i class="fas fa-edit"></i></button>
                </form>
            </td>
            <td style="width: 13px;">
                <!-- <form action="code.php" method="post">
                  <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                  <button type="submit" name="delete_admin" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                </form> -->
                <a href="code.php?delete_admin=<?php echo $row['id']?>" onclick="return confirm('Are you sure you want to delete this Admin?');">
                  <button class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                  </button>
                </a>
            </td>
            </tr>
            <?php } while($row = $result->fetch_assoc()); ?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>