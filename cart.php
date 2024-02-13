<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>
    
    <div class="container mt-4">
        <div style="display: <?php if(isset($_SESSION['showAlert'])){echo $_SESSION['showAlert'];}else{ echo 'none';} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];}  unset($_SESSION['message']);?></strong> 
        </div>
        <h2>Cart</h2>
        <div class="table-responsive">

            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Product image</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Product_code</th>
                    <th>total price</th>
                    <th>
                        <a href="action.php?clear=all" class="badge-danger badge p-2" onclick="return confirm('Are you sure you want to clear your cart?');"><i class="fas fa trash"></i>&nbsp;&nbsp; Clear Cart</a>
                    </th>
                </tr>
                </thead>
                <tbody>
            
                <?php
                    require('config.php');
                    $user_id = $_SESSION['User_id'];
                    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
                    $stmt->bind_param("s", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total = $result->num_rows;
                    

                    if($total > 0){
                        $row = $result->fetch_assoc();
                        do{ ?>
                        <tr>
                            <input type="hidden" class="pid" value="<?= $row['id'];?>">
                            
                            <td>
                                <a href="admin/products/<?= $row['product_image'];?>">
                                    <img src="admin/products/<?= $row['product_image'];?>" height="60px" width="60px">
                                </a>
                            </td>
                            <td><?= $row['product_name'];?></td>
                            <td>
                                <input type="number" class="form-control itemQty" value="<?= $row['qty'];?>" style="width: 75px;">
                            </td>
                            <td>&#8369; &nbsp;<?= number_format($row['product_price'],2);?></td>
                            <td><?= $row['product_code'];?></td>
                            <input type="hidden" class="pprice" value="<?= $row['product_price'];?>">
                            <td>&#8369; &nbsp;<?= number_format($row['total_price'],2);?></td>
                            <td>
                                <!-- remove or delete item -->
                                <a href="action.php?remove=<?php echo $row['id']?>" class="text-danger lead" onclick="return confirm('Are you sure you want to remove this item?');"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>

                        <?php } while($row = $result->fetch_assoc()); ?>

                        
                        <?php                            
                            // This code for getting the Grand total
                            $user_id = $_SESSION['User_id'];
                            $grand_total_query = $conn->prepare("SELECT SUM(total_price) AS sum FROM `cart` WHERE user_id = $user_id ");
                            $grand_total_query->execute();
                            $result = $grand_total_query->get_result();

                            while($row = $result->fetch_assoc()){
                               $output = $row['sum'];
                            }?>
                    
                        <tr>
                            <td colspan="3">
                            <a href="products.php" class="btn btn-success">Continue shopping</a>
                            </td>

                            <td colspan="2">
                            <b>Grand Total</b>
                            </td>

                            <td colspan="1">
                                <b>&#8369; &nbsp; <?= number_format($output,2); ?></b>
                            </td>

                            <td>
                                <a href="checkout.php" class="btn btn-info"><i class="fa fa-credit-card"></i>&nbsp;Checkout</a>
                            </td>
                        </tr>
                        
                        
                    <?php } else{ ?>
                        <tr>
                            <td colspan="7" style="text-align:center; font-weight: bolder;">Empty record in Cart</td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>

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
           
            $(".itemQty").on('change', function(){
                var $el = $(this).closest('tr');

                var pid = $el.find(".pid").val();
                var pprice = $el.find(".pprice").val();
                var qty = $el.find(".itemQty").val();
                location.reload(true);
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    cache: false,
                    data: {qty:qty,pid:pid,pprice:pprice},
                    success: function(response){
                        console.log(response);
                    }

                })
            })


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