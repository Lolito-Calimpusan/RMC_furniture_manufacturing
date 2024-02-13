<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<!-- container for  User Setting -->
<div class="container-fluid p-3" style="height: auto; background-color: #fff;">  

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



     <!-- modal for display background -->
     <p data-toggle="modal" data-target="#displayback">
         Display background
     </p>

      <!-- The Modal for display background -->
      <div class="modal" id="displayback">
         <div class="modal-dialog">
             <div class="modal-content">

                 <!-- Modal Header for display background-->
                 <div class="modal-header">
                     <h6 class="modal-title">Switch the Display Background</h6>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>

                 <!-- Modal body for display background -->
                 <div class="modal-body">
                     <div class="row py-3 px-5">
                         <p>black</p>
                     </div>
                 </div>

             </div>
         </div>
     </div>
     <!-- end modal for display background -->

<!-- ----------------------------------------------------------------------------------- -->

     <!-- modal for Password and Security-->
     <p data-toggle="modal" data-target="#passwordSec">
         Password and Security
     </p>

     <!-- The Modal for Password and Security -->
     <div class="modal" id="passwordSec">
         <div class="modal-dialog">
             <div class="modal-content">

                 <!-- Modal Header for Password and Security-->
                 <div class="modal-header">
                     <h6 class="modal-title">Password and Security</h6>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>
                 
                 <!-- Modal body for Password and Security -->
                 <div class="modal-body">
                     <div class="row py-3 px-5">
                         <form action="" method="post">
                             <input type="text" name="password" value="<?= $row['password'];?>" id="">
                         </form>
                     </div>
                 </div>
                 
                 <!-- Modal footer for Password and Security-->
                 <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding:0.5rem 2.5rem;">No</button>
                     <a href="logout.php"><button type="button" class="btn btn-info" style="padding:0.5rem 2.5rem;">Yes</button></a>
                 </div>
                 
             </div>
         </div>
     </div>
     <!-- end modal for Password and Security-->

<!-- ------------------------------------------------------------------- -->
     
     
     <!-- modal for User Email Login -->
     <p data-toggle="modal" data-target="#userEmailLogin">
        Admin Email Login
     </p>
     
     <!-- The Modal for  User Email Login -->
     <div class="modal" id="userEmailLogin">
        <div class="modal-dialog">
            <div class="modal-content">
     
                <!-- Modal Header for  User Email Login-->
                <div class="modal-header">
                    <h6 class="modal-title">User Email Login</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
     
                <form action="code.php" method="post">
     
                <!-- Modal body for  User Email Login -->
                <div class="modal-body">
                            <p style="font-weight: bolder;"> Admin email login :</p>
                            <input type="hidden" class="form-control"  name="email_id" value="<?= $row['id'];?>">
                            <input type="text" class="form-control" placeholder="<?= $row['email'];?>" style="text-align: left;" disabled>
                            <hr>
     
                            <p style="font-weight: bolder;">Change Admin email login :</p>
                            <input type="email" class="form-control" name="adminEmail" Placeholder="Change your Email" >
                        </div>
                        
                        <!-- Modal footer for  User Email Login-->
                        <div class="modal-footer">
                            <button type="submit" name="editEmail" class="btn btn-success" style="padding:0.5rem 2.5rem;">Save</button>
                        </div>
                </form>
     
            </div>
        </div>
     </div>
     <!-- end modal for  User Email Login-->

</div>
<!-- ends container for User Setting -->



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>