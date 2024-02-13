<nav class="navbar navbar-expand-md navbar-dark" style=" background-color: rgb(3, 3, 43);">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php"><i class="fa fa-bed"></i> RMC Furniture</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
          
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;">
                        Categories
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="living.php">Living room</a>
                        <a class="dropdown-item" href="dinning.php">Dinning room</a>
                        <a class="dropdown-item" href="bed.php">Bed</a>
                        <a class="dropdown-item" href="others.php">others</a>
                    </div>
                </div>
                
                <?php
                    require('config.php');
                    if(isset($_SESSION['User_id'])){
                        
                        $id = $_SESSION['User_id'];
                        $stmt = $conn->prepare("SELECT * FROM register WHERE id = ?");
                        $stmt->bind_param("s", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $total = $result->num_rows;
                        
                        if($total > 0){
                            $row = $result->fetch_assoc(); ?>

                            <li class="nav-item">
                                <a class="nav-link" href="cart.php"><i class="fa fa-shopping-cart"></i>&nbsp;<span id="cart-item" class="badge-danger" style="border-radius: 50%; font-size: 10px; padding: 2px 4px; margin-left: -2px"></span></a>
                            </li>

                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-lg-inline text-gray-600 small">                               
                                <?= $row['fname']?>                           
                                    </span>
                                    <img class="img-profile rounded-circle" src="admin/users_pictures/<?php echo $row['image'];?>" style="width:25px; height:25px;">
                                </a>

                                    <!-- Dropdown - User Information -->
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                        <a class="dropdown-item" href="userProfile.php">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                        </a>

                                        <a class="dropdown-item" href="userSetting.php">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                        </a>

                                        <a class="dropdown-item" href="orders.php">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Orders
                                        </a>

                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModals">
                                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Logout
                                            </a>

                                            
                                    </div>

                                    <!-- The Modal for logout -->
                                        <div class="modal" id="myModals">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                        
                                                <!-- Modal Header for logout-->
                                                <div class="modal-header">
                                                    <h6 class="modal-title"><?= $row['fname']." ". $row['lname']?></h6>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                        
                                                <!-- Modal body for logout -->
                                                <div class="modal-body">
                                                    <div class="row py-3 px-5">
                                                        <h5>Are you sure you want to logout?</h5>
                                                    </div>
                                                </div>
                        
                                                <!-- Modal footer for logout-->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding:0.5rem 2.5rem;">No</button>
                                                    <a href="logout.php"><button type="button" class="btn btn-info" style="padding:0.5rem 2.5rem;">Yes</button></a>
                                                </div>
                        
                                                </div>
                                            </div>
                                        </div>
                                    <!-- end modal for logout -->
                            </li>
            
                           
                            <?php }
                    }else { ?>

                         <li class="nav-item">
                        <a class="nav-link"  class="btn btn-light btn-block" data-toggle="modal" data-target="#myModalforlogin" style="cursor: pointer;">login</a>
    
                         <!-- The Modal for login -->
                         <div class="modal" id="myModalforlogin">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                
                                        <!-- Modal Header for login -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Login your Account</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                
                                        <!-- Modal body for login-->
                                        <div class="modal-body">
                                            <div class="form col-12  p-3">
                                                <p class="text-muted text-center">Create your account. it's free and only takes a minute.</p>
    
                                                <?php
    
                                                    if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                                                    {
                                                        echo '<h6 class="bg-danger text-white p-2"> '.$_SESSION['status'].' </h6>';
                                                        unset($_SESSION['status']);
                                                    }
                                                ?>
    
                                                <form action="action.php" method="post">
                                                    <input type="email" name="email"  class="form-control" placeholder="Email" required>
    
                                                    <input type="password" name="password"  class="form-control" placeholder="Password" required>
    
                                                    <button type="submit" name="login" class="btn btn-primary form-control">Login</button>
                                                </form>
    
                                                <p class="mt-3" data-toggle="modal" data-target="#myModalForSignup">Don't have an account?</p>
    
                                                <a href="forgot_pass.php" class="text-dark"><p>Forgot Password?</p></a>
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal for login -->
    
    
    
    
                                 <!-- The Modal for signup -->
                                    <div class="modal" id="myModalForSignup">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                    
                                            <!-- Modal Header for signup-->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Create your Account</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                    
                                            <!-- Modal body for signup -->
                                            <div class="modal-body">
                                                <div class="form col-12 p-3">
                                                    <h3 class="p-1 text-center">
                                                        Register
                                                    </h3>
                                                    <p class="text-muted text-center">Create your account. it's free and only takes a minute.</p>
                                                    
                                                    <?php
                                                        if(isset($_SESSION['error']) && $_SESSION['error'] !='') 
                                                        {
                                                            echo '<h6 class="bg-danger text-white p-2"> '.$_SESSION['error'].' </h6>';
                                                            unset($_SESSION['error']);
                                                        }
                                                    ?>

                                                    <form action="action.php" method="post">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <input type="text" name="fname"  class="form-control" placeholder="Firstname" required>
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="text" name="lname"  class="form-control" placeholder="Lastname" required>
                                                            </div>
                                                            <div class="col-6">
                                                                <select name="gender"  class="form-control">
                                                                    <option value="">Gender</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="number" name="age"  class="form-control" placeholder="Age" required>
                                                            </div>
                                                        </div>
    
                                                        <textarea name="address" cols="10" placeholder="Address" class="form-control" required></textarea>
    
                                                        <input type="number" name="phone"  class="form-control" placeholder="Phone Number" required>

                                                        <input type="email" name="email"  class="form-control" placeholder="Email" required>
    
                                                        <input type="password" name="password"  class="form-control" placeholder="Password" required>
    
                                                        <input type="password" name="password2"  class="form-control" placeholder="Confirm Password" required>
    
                                                        <input type="hidden" name="role" value="User" class="form-control">

                                                        <input type="hidden" name="image" value="user.png" class="form-control">
    
                                                        <button type="submit" name="submit" class="btn btn-primary form-control">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                    
                                            <!-- Modal footer for signup-->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                    
                                            </div>
                                        </div>
                                    </div>
                                <!-- end modal for signup -->
                    
        
                    </li>
                    <?php } ?>
                   
            </ul>
        </div>
    </nav>