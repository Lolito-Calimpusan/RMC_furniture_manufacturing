
<!-- About Us -->
<div class="container-fluid" style="height: auto; background-color: whitesmoke;">
    <div class="container ">
        <div class="row  p-5">
            <div class="col-lg-3">
                <h5 class="text-muted">Information</h5>
                <a href="about_us.php"><p>About Us</p> </a>
                <a href="contact_us.php"><p>Contact Us</p> </a>
                <a href=""><p>Store</p></a>
            </div>
            
            <div class="col-lg-3">
                 <h5 class="text-muted">Categories</h5>
                 <a href="living.php"><p>Living Room</p></a>
                 <a href="dinning.php"><p>Dinning Room</p></a>
                 <a href="bed.php"><p>Bed</p</a>
                 <a href="others.php"><p>Others</p></a>
            </div>
            
            <div class="col-lg-3">
            <h5 class="text-muted">Categories</h5>
            <?php
                if(!isset($_SESSION['User_id']) ) 
                { ?>

                    <!-- Button to Open the Modal -->
                    <p data-toggle="modal" class="text-primary" data-target="#myModalforlogin">
                    Profile
                    </p>

                    <!-- Button to Open the Modal -->
                    <p data-toggle="modal" class="text-primary" data-target="#myModalforlogin">
                    My Cart
                    </p>

                    <!-- Button to Open the Modal -->
                    <p data-toggle="modal" class="text-primary" data-target="#myModalforlogin">
                    Order History
                    </p>

                <?php } else {
                    echo'
                    <h5 class="text-muted">My Accounts</h5>
                    <a href="userProfile.php"><p>Profile</p></a>
                    <a href="cart.php"><p>My Cart</p></a>
                    <a href="orders_history.php"><p>Order History</p></a>';

                } ?>
            </div>

            <div class="col-lg-3">
                <h5 class="text-muted">NewsLetter</h5>
                <p class="text-muted">Subscribe to get latest news,update and information</p>
                <input type="text" name="" class="form-control" id="" placeholder="Enter your email here..">
            </div>

        </div>
    </div>
 </div>   
 <!-- ends aboout Us -->



    <!-- footer -->
  
        <div class="container-fluid text-center text-white pt-2" style=" height: auto; background-color: rgb(3, 3, 43);">
            <i class="fa fa-facebook p-3"></i>
            <i class="fa fa-youtube p-3"></i>
            <i class="fa fa-instagram p-3"></i>
            <i class="fa fa-twitter p-3"></i>

            <p class="p-3 text-center">&copy; Copyright. RMC Furniture Manufacturing 2023</p>
        </div>
    
    <!-- ends footer -->