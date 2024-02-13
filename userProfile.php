<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>
    
<!-- container for  User profile -->
   <div class="container p-3" style="height: auto;">

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

    <div class="row">
            <div class="col-lg-3">
                <img src="admin/users_pictures/<?= $row['image'];?>" alt="" style="height: 200px; width: 200px; border: 1px solid black; padding: 3px;">
            </div>
            <div class="col-lg-3">
                <h6>Name: <span><?= $row['fname']. " " . $row['lname'];?></span></h6>
                <h6>Gender: <span><?= $row['gender'];?></span></h6>
                <h6>Age: <span><?= $row['age'];?></span></h6>
                <h6>Address: <span><?= $row['address'];?></span></h6>
                <h6>Phone: <span><?= $row['phone'];?></span></h6>
                <h6>Email: <span><?= $row['email'];?></span></h6>
            </div>
        </div>
        <div class="row">
             <div class="col-12">
                  <!-- Button to Open the Modal -->
                  <a class="" data-toggle="modal" data-target="#myModalForChangeProfilePic">
                      Change Profile Picture
                  </a>
                    
                <a class="" data-toggle="modal" data-target="#myModalForEditProfile">
                        <p>Edit Profile</p>
                </a>
                    <!-- The Modal for Change Profile picture-->
                        <div class="modal" id="myModalForChangeProfilePic">
                            <div class="modal-dialog">
                                <div class="modal-content">
        
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Change Profile Picture</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
        
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="container">
                                    <form action="action.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="user_id" value="<?= $row['id']; ?>">
                                        <input type="file" name="image" class="form-control mb-2" value="<?= $row['image'];?>">

                                        <button type="submit" name="change_pic" class="btn btn-success form-control mb-2">Update</button>
                                    </form>
                                    </div>
                                </div>
        
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
        
                                </div>
                            </div>
                        </div>
                    <!-- end modal -->




                    <!-- The Modal for Edit Profile-->
                    <div class="modal" id="myModalForEditProfile">
                            <div class="modal-dialog">
                                <div class="modal-content">
        
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Profile</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
        
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="container">
                                    <form action="action.php" method="post">
                                        <div class="row">
                                            <div class="col-6">
                                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                <input type="text" name="fname"  class="form-control mb-2"  value="<?= $row['fname'];?>" placeholder="Firstname">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="lname"  class="form-control mb-2"  value="<?= $row['lname'];?>" placeholder="Lastname">
                                            </div>
                                            <div class="col-6 mb-2">
                                                <select name="gender"  class="form-control">
                                                    <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : '';?>>Male</option>
                                                    <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : '';?>>Female</option>
                                                </select>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <input type="number" name="age"  class="form-control" placeholder="Age" value="<?= $row['age'];?>">
                                            </div>
                                        </div>

                                        <textarea name="address" cols=""  class="form-control mb-2" value="<?= $row['address'];?>">
                                            <?= $row['address'];?>
                                        </textarea>

                                        <input type="number" name="phone"  class="form-control mb-2" placeholder="Phone number" value="<?= $row['phone'];?>">
                                        
                                        <input type="email" name="email"  class="form-control mb-2" placeholder="Email" value="<?= $row['email'];?>">


                                        <button type="submit" name="update_profile" class="btn btn-success form-control mb-2">Update</button>
                                    </form>
                                    </div>
                                </div>
        
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
        
                                </div>
                            </div>
                        </div>
                    <!-- end modal -->
             </div>
        </div>
   </div>
<!-- ends container for User Profile -->



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