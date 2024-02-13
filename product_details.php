<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>

 <?php
    require('config.php');
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        
        $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
       

    }
?>
    
    <!-- Container for Products details -->
    <div class="container mt-5 mb-2">
        <div class="row">
            <div class="col-lg-4 col-md-2 col-sm-4 col">
                <h4><?= $row['product_name'];?></h4>
                <hr>
                <a href="admin/products/<?= $row['product_image'];?>">
                    <img src="admin/products/<?= $row['product_image'];?>" width="350px" height="350px">
                </a>
            </div>

            <div class="col-lg-6 px-5">
                <h5>Product Description</h5>
                <p><?= $row['product_desc'];?></p><br>
                
                <h5>Product Price</h5>
                <p style="font-weight: bold;">&#8369; <?= number_format($row['product_price'],2);?></p>
                
            </div>

        </div>
    </div>



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