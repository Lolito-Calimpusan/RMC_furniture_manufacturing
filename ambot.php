<?php 
    include('pages/header.php');
    include('pages/navigation.php');
?>

<!-- Hero Container -->
<div class="container-fluid bg-light" style="min-height: auto; padding-top: 30px; padding-bottom: 30px;">

    <div class="row">

        <div class="px-lg-5 py-4 col-lg-6">
            <!-- Search -->
            <form action="searchResult.php" method="get" class="mb-4">
                <input type="text" name="search" class="form-control" placeholder="Search your favorite product">
            </form>

            <h4 class="text-muted">Great Design Collection</h4>
            <h1 class="text-muted">Mapple Wood Accent Chair</h1>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
            <p>$399.00 &nbsp; &nbsp; <span class="text-muted" style="text-decoration: line-through;">$499.00</span></p>
            <button class="btn btn-warning py-3 px-5">Add to Cart</button>
        </div>

        <div class="col-lg-6">
            <img src="images/hero-image/C_arm2.png" class="img-fluid" alt="Hero Image">
        </div>
    </div>
</div>

<!-- Other Items -->
<div class="container" style="max-width: 80%;">

    <h3 class="text-center text-muted pt-5">Best Sellers</h3>

    <div class="row">

        <?php 
        require('config.php');

        $query_most_saled = $conn->prepare("SELECT * FROM product WHERE most_saled = 1");
        $query_most_saled->execute();
        $result = $query_most_saled->get_result();
        
        while($row = $result->fetch_assoc()) {
        ?>
        <div class="col-lg-4 mb-4">
            <div class="p-3 bg-light" style="box-shadow: 2px 4px 5px 2px rgba(0, 0, 0, 0.3);">
                <h5 class="text-center"><?= $row['product_name'];?></h5>
                <img src="<?= $row['product_image'];?>" class="img-fluid" alt="<?= $row['product_name'];?>" style="border-radius: 5px;">
                <p class="text-muted py-2"><?= $row['product_desc'];?></p>
                <div class="row">
                    <div class="col-6">
                        <p class="text-center">&#8369; <?= number_format($row['product_price'], 2);?></p>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary btn-block">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!-- New Arrivals -->
<div class="container-fluid py-5" style="background: linear-gradient(0deg, rgba(34,178,195,1) 0%, rgba(196,197,199,0.5382528011204482) 54%);">
    <h3 class="text-center text-white">New Arrivals</h3>
    <!-- Insert content for New Arrivals section -->
    <div class="m-auto" style="width: 85%;">
            <div class="row p-3">


                <?php
                require('config.php');

                $stmt = $conn->prepare("SELECT * FROM product");
                $stmt->execute();
                $result = $stmt->get_result();
                $total = $result->num_rows;

                if($total > 0){
                    $row = $result->fetch_assoc();
                }
                ?>

                <?php do{ ?>
                <div class="col-lg-3 mt-2 mb-3">
                    <div class="p-1"  style="box-shadow: 2px 4px 5px 2px rgba(0,0,0,0.3); background-color: white;">
                        <a href="<?= $row['product_image'] ?>">
                        <img src="<?= $row['product_image'] ?>" width="100%" height="230px">
                        </a>

                        <!-- Button to Open the Modal -->
                            <form action="product_details.php" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'];?>">
                                <button type="submit" name="submit" class="btn btn-light btn-block"  style="margin-bottom: 5px;">
                                    <?= $row['product_name']?>
                                </button>
                            </form>
                            


                        <!-- The Modal -->
                            <div class="modal" id="myModalForNewArrival">
                                <div class="modal-dialog">
                                    <div class="modal-content">
            
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?= $row['product_name']?></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
            
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-6"><img src="<?= $row['product_image']?>" width="100%"></div>
                                            <div class="col-6"><?= $row['product_desc']?></div>
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
                        

                        <div class="row justify-content-center">
                            <div class="col-12">
                                <b><p class="text-center">&#8369; <?= number_format($row['product_price'],2) ?></p></b>
                            </div>
                            <div class="col-12">
                            <?php
            
                                if(!isset($_SESSION['User_id']) ) 
                                {?>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-primary text-white btn-block" style="color: green;" data-toggle="modal" data-target="#myModalforlogin">
                                    Add to Cart
                                    </button>

                                <?php }else {
                                    echo '<a href="products.php"><p class="text-center btn btn-primary btn-block">Add to Cart</p></a>';
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>  <!-- ends for cols !-->
                <?php } while($row = $result->fetch_assoc()); ?>
            </div>
        </div>
</div>

<!-- Testimonials -->
<div class="container testimonial py-5">
    <div class="row p-5">
        <!-- Insert content for Testimonials section -->
        <!-- ... -->
    </div>
</div>

<!-- Other Business -->
<div class="container-fluid py-5" style="background-color: #22c1c3;">
    <div class="row">
        <!-- Insert content for Other Business section -->
        <!-- ... -->
    </div>
</div>

<?php 
    include('pages/footer.php');
?>

<!-- Your JS Libraries and Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    // Your JavaScript code
</script>
</body>
</html>
