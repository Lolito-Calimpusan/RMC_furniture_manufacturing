<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>

    
    <!-- hero Container -->
    <div class="hero-container px-5 ">
    <div id="message"></div>

        <div class="row">

            <div class=" py-4 col-lg-6">           
                <!-- search -->
                <form action="searchResult.php" method="get">
                    <input type="text" name="search" class="form-control" placeholder="Search your favorite product">
                    <!-- <button type="search">Search</button> -->
                </form>

                <h2 class="text-dark pt-4">RMC Furniture Manufacturing</h2>
                <h3 class="py-2 text-dark">Your One Stop Shop Customized Furniture</h3>
                <li class="text-dark py-4">Main branch Villa Coreto Corner, Washington City <br> Landmark: In front medical Hospital.</li>
                <li class="text-dark py-2">Butuan branch  Jc Aquino Ave. Libertad Butuan City <br> Landmark: Beside Uratex Catering & near  Utarex Building.</li>

                <p class="py-4"></p>
                <a href="products.php"><button class="btn btn-warning py-3 px-5">Shop now</button></a>
            </div>

            <div class="col-lg-6 col;">
                <img src="images/hero-image/C_arm2.png" width="100%" class="img-fluid pt-5 pb-3 px-4">
            </div>
        </div>
    </div>








    <!-- New Arrivals -->

    <div class="container-fluid p-0" style="height: auto; background: linear-gradient(0deg, rgba(34,178,195,1) 0%, rgba(196,197,199,0.5382528011204482) 54%);">

        <h3 class="text-center text-white py-3 px-0" style="height: auto; background-color: #22c1c3;">New Arrivals</h3>

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
                        <a href="admin/products/<?= $row['product_image'] ?>">
                        <img src="admin/products/<?= $row['product_image'] ?>" width="100%" height="260px" style="border: 1px solid black; padding: 5px;">
                        </a>

                        <!-- Button to view product details -->
                            <form action="product_details.php" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'];?>">
                                <button type="submit" name="submit" class="btn btn-light btn-block text-info"  style="margin-bottom: 5px;">
                                    <?= $row['product_name']?>
                                </button>
                            </form>
                             

                        <div class="row justify-content-center">
                            <div class="col-12">
                                <b><p class="text-center">&#8369; <?= number_format($row['product_price'],2) ?></p></b><hr>
                            </div>
                            <div class="col-12">
                            <?php
            
                                if(!isset($_SESSION['User_id']) ) 
                                {?>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-primary text-white btn-block" style="color: green;" data-toggle="modal" data-target="#myModalforlogin">
                                    Add to Cart
                                    </button>

                                <?php }else { ?>
                                    <form action="" class="form-submit">
                                        <input type="hidden" name="" class="pid"value="<?= $row['id'] ?>">
                                        <input type="hidden" name="" class="pname"value="<?= $row['product_name'] ?>">
                                        <input type="hidden" name="" class="pprice"value="<?= $row['product_price'] ?>">
                                        <input type="hidden" name="" class="pimage"value="<?= $row['product_image'] ?>">
                                        <input type="hidden" name="" class="pcode"value="<?= $row['product_code'] ?>">
                                        <button class="btn btn-primary btn-block addItemBtn"><i class="fa fa-cart-plus"></i>&nbsp; Add to cart</button>
                                    </form>
                                    
                                <?php }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>  <!-- ends for cols !-->
                <?php } while($row = $result->fetch_assoc()); ?>
            </div>
        </div>
    </div>
    <!-- ends new arrival -->






    <!-- Testimonials -->
    <div class="container-fluid testimonial" style="background-color: whitesmoke;">
        <div class="row p-5">
            <div class="col-lg-12">
                <h3 class="text-center text-muted p-2">Testimonials</h3>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card p-3 mb-5" style="box-shadow: 0px 0px 6px 2px rgba(0, 0, 0, 0.2); background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 94%); border-radius: 10px;">
                        <img src="images/testimonial/Yadzmeh_Duallo.jpg" class="testi-image">
                        <p class="text-justify p-2">Thankyou so much RMC Furniture Manufacturing for a superb and elegant sofa set. Thankyou also for a very fast transaction and well accomodating owner. <br><br>
                        #recommendable furniture manufacturer not only in Surigao but also outside Surigao.</p>
                        <p class="text-muted text-info">- Yadzmeh Duallo </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card p-3 mb-5" style="box-shadow: 0px 0px 6px 2px rgba(0, 0, 0, 0.2); background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 94%); border-radius: 10px;">
                        <img src="images/testimonial/Hazel_Zion.jpg" class="testi-image">
                        <p class="text-justify p-2">They were able to accommodate the customized designs that I like. Naay gamay na issue sa design sa sofa but the owners were able to resolve it. The products are sturdy (and heavy kc solid wood ang nasa ilalim) and seem like they will really last for a long time. Overall, I'm very pleased and happy with the product/furniture. </p>
                        <p class="text-muted">- Clarissa Jardenil</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card p-3 mb-5" style="box-shadow: 0px 0px 6px 2px rgba(0, 0, 0, 0.2); background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 94%); border-radius: 10px;">
                        <img src="images/testimonial/Charesh.jpg" class="testi-image">
                        <p class="text-justify p-2">They offer the best service and quality of work is superb.
                            The owners are  hands on in dealing with their clients <br><br>Affordable, <br> pinaka gwapa ug lig on <br>
                            Satisfied customer here. <br><br>
                        </p>
                        <p class="text-muted">- Charesh Dagsa Oraiz Moreno</p>
                    </div>
                </div>
               
            </div>
        </div>
        


    </div>
    <!-- ends Testimonials -->



    <!-- OTHER BUSINESS -->
    <div class="container-fluid" style=" height: auto; background-color: #22c1c3;">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center text-white mt-5">Other Business</h3>
                <p class="text-center text-white">You can visit our other business for clicking the image below! </p>
            </div>

            <div class="row mt-4 mb-5 text-center" style="margin: auto;">
                <div class="col-lg-3 mb-3 px-4">
                    <a href="https://www.facebook.com/rmcfurnitureshop?mibextid=ZbWKwL">
                        <img src="images/other-business/furniture.png" alt="" width="150px" height="150px" >   
                    </a>
                </div>
                <div class="col-lg-3 mb-3 px-4">
                    <a href="https://www.facebook.com/rmcgadgets?mibextid=ZbWKwL">
                        <img src="images/other-business/gadgets.png" alt="" width="150px"  height="150px">
                    </a>
                </div>
                <div class="col-lg-3 mb-3 px-4">
                    <img src="images/other-business/massage.png" alt="" width="150px"  height="150px">
                </div>
                <div class="col-lg-3 mb-3 px-4">
                    <a href=" https://www.facebook.com/profile.php?id=100064057808168&mibextid=ZbWKwL">
                        <img src="images/other-business/salon.png" alt="" width="150px"  height="150px">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- ends Other business -->
            


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