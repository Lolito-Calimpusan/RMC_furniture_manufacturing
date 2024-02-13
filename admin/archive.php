<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container-fluid">
    <div class="card-body">
      <h4>Archive</h4>
    
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

      <table class="table table-bordered text-dark text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr style="background-color: rgb(3, 3, 43); color: white;">
            <th>First name</th>
            <th>Last name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Date registered</th>
            <th>Restore</th>
          </tr>
        </thead>
        <tbody>
     
          <?php
              require('../config.php');
              $stmt = $conn->prepare("SELECT * FROM register WHERE status = 'hide' ");
              $stmt->execute();
              $result = $stmt->get_result();
              $total = $result->num_rows;
             

              if($total > 0){
                $row = $result->fetch_assoc();
                 do{ ?>
                    <tr>
                      <td><?= $row['fname'];?></td>
                      <td><?= $row['lname'];?></td>
                      <td><?= $row['gender'];?></td>
                      <td><?= $row['age'];?></td>
                      <td><?= $row['phone'];?></td>
                      <td><?= $row['role'];?></td>
                      <td><?= $row['date_registered'];?></td>
                      <td>
                          <form action="code.php" method="post">
                            <input type="hidden" name="restore_id" value="<?= $row['id']; ?>">
                            <button type="submit" name="restore" class="btn btn-primary"><i class="fa fa-arrow-up"></i></button>
                          </form>
                      </td>
                      </tr>
                      <?php } while($row = $result->fetch_assoc());
              }
              else{
                    echo ' <td colspan=8 class="bg-danger text-white">
                                <h5 class="text-center">Empty Records</h5>
                            </td>';
                   
               
              }
          ?>
        
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