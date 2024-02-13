<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>

    
<!-- container for  User Setting -->
   <div class="container p-3" style="height: auto;">  

   <!-- Display if the logic is success or error -->
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

        <h2>Settings</h2>


        <!-- display if the logic is success or error -->
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


        <!-- modal for Password and Security-->
        <p data-toggle="modal" data-target="#passwordSec" style="cursor: pointer;">
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
                        <div class="row py-3 px-2">
                            <div class="col-lg-12">
                                <form action="action.php" method="post">
                                    <input type="hidden" name="id" value="<?= $row['id'];?>" class="form-control">
                                    <input type="hidden" name="password" value="<?= $row['password'];?>" class="form-control">
                                    <label>Current Password</label>
                                    <input type="password" name="cpassword" class="form-control" placeholder="Enter Current Password">
                                    <label>New Password</label>
                                    <input type="password" name="npassword" class="form-control" placeholder="Enter New Password">

                                    <input type="submit" value="Sumbit" name="change" class="form-control bg-success text-white">
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- end modal for Password and Security-->

<!-- ------------------------------------------------------------------- -->
        
        
        <!-- modal for User Email Login -->
        <p data-toggle="modal" data-target="#userEmailLogin" style="cursor: pointer;">
           User Email Login
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
        
                   <form action="action.php" method="post">
        
                   <!-- Modal body for  User Email Login -->
                   <div class="modal-body">
                               <p style="font-weight: bolder;"> User email login :</p>
                               <input type="hidden" class="form-control"  name="email_id" value="<?= $row['id'];?>">
                               <button class="form-control" style="text-align: left;" disabled><?= $row['email'];?></button>
                               <hr>
        
                               <p style="font-weight: bolder;">Change User email login :</p>
                               <input type="email" class="form-control" name="email" Placeholder="Change Email" required >
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
        //footer 
        include('pages/footer.php');
    ?>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min/js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".addItemBtn").click(function(e){
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var pid = $form.find(".pid").val();
                var pname = $form.find(".pname").val();
                var pprice = $form.find(".pprice").val();
                var pimage = $form.find(".pimage").val();
                var pcode = $form.find(".pcode").val();

                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: {pid:pid,pname:pname,pprice:pprice,pimage:pimage,pcode:pcode},
                    success:function(response){
                        $("#message").html(response);
                        window.scrollTo(0,0);
                        load_cart_item_number();
                    }
                });
            });

            load_cart_item_number();

            function load_cart_item_number(){
                $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: {cartItem:"cart_item"},
                    success:function(response){
                        $("#cart-item").html(response);
                    }
                })
            }
        });
    </script>
</body>
</html>