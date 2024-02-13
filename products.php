<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>
    
<!-- container for products -->
<div class="container-fluid" style="height: auto; background: linear-gradient(0deg, rgba(34,178,195,1) 0%, rgba(196,197,199,0.5382528011204482) 54%);">
    <div class="pt-3 m-auto" style="width: 85%;">
        <h3>Products</h3>
        <hr>
        <div id="message">

        </div>
        <div class="row mt-2 pb-3">
            <?php
                include 'config.php';
                $stmt = $conn->prepare("SELECT * FROM `product`");
                $stmt->execute();
                $result = $stmt->get_result();
                while($row = $result->fetch_assoc()):
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="p-2"  style="box-shadow: 2px 4px 5px 2px rgba(0, 0, 0, 0.3); background-color: whitesmoke;">
                    <div class="card-deck">
                        <div class="card border-secondary mb-2">
                            <a href="admin/products/<?= $row['product_image'] ?>">
                                <img src="admin/products/<?= $row['product_image'] ?>" class="card-img-top" width="100%" height= "270px">
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-1">
                        <!-- Button to view product details -->
                        <form action="product_details.php" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'];?>">
                                <button type="submit" name="submit" class="btn btn-light btn-block text-info"  style="margin-bottom: 5px;">
                                    <?= $row['product_name']?>
                                </button>
                            </form>
                        <h6 class="card-text text-center text-danger">&#8369; <?= number_format($row['product_price'],2) ?></h6><hr>
                    </div>
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
            <?php endwhile; ?>
        </div>
    </div>
</div>
    <!-- ends container for product -->



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