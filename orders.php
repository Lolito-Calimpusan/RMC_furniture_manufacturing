<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>


    
<!-- container for products -->
    <div class="container-fluid bg-white mb-2">
    <!-- style="background: linear-gradient(0deg, rgba(34,178,195,1) 0%, rgba(196,197,199,0.5382528011204482) 54%); -->
        <h4 class="container pt-3">Order Status: 
            <span>
                <a href="orders.php"><button class="btn btn-info">Pending</button></a>
                <a href="orders_history.php"><button class="btn btn-success">Completed</button></a>
            </span>
        </h4>
        <hr>
        <div class="row container m-auto p-2 px-5">
            <div class="table-responsive">

                <?php
                require 'config.php';
                $user_id = $_SESSION['User_id'];

                $stmt = $conn->prepare("SELECT * FROM approved_orders WHERE view = '1' AND user_id = ? ORDER BY id DESC");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if($result->num_rows > 0){
                    $row = $result->fetch_assoc();
            
                    do{?>
                        <?php
                            $image = $row['image'];
                            $imageArray = explode(", ", $image); 
                        ?>
                        <table class="table table-bordered mb-3" style="box-shadow: 2px 4px 5px 2px rgba(0,0,0,0.3); width: 70%;">
                            <tr>
                                <td rowspan="5">
                                <?php foreach ($imageArray as $key => $value) {?>
                                        <a href="admin/products/<?= $value; ?>">
                                            <img src="admin/products/<?= $value; ?>" width="80px" height="80px" style="margin-left: 15px;  margin-bottom: 10px; border: 1px solid gray; background-color: whitesmoke;">
                                        </a>
                                    <?php }
                                    ?>
                                </td>
                                <td colspan="2" ><b>Products :</b></td>
                                <td colspan="" ><?= $row['products'];?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Total Price :</b></td>
                                <td>&#8369; <?= number_format($row['grand_total'],2);?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Date Ordered :</b></td>
                                <td><?= $row['orders_date'];?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Status :</b></td>
                                <td><?= $row['status'];?></td>
                            </tr>
                            <?php
                                $user_id = $_SESSION['User_id'];
                                $reference_code = $row['reference_code'];
                                
                                $stmts = $conn->prepare("SELECT * FROM approved_orders WHERE status = 'Arrived' AND reference_code = ?  AND user_id = ?");
                                $stmts->bind_param("ss", $reference_code, $user_id);
                                $stmts->execute();
                                $results = $stmts->get_result();

                                if ($results->num_rows > 0) {?>
                                    <tr>
                                        <td colspan="2"><b>Rate the products :</b> 
                                            <a href="rate.php">
                                                <button class="btn btn-primary">Rate</button>
                                            </a>
                                        </td>

                                        <td colspan="">
                                            <span>
                                            <form action="action.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id'];?>">
                                                <input type="hidden" name="products" value="<?php echo $row['products'];?>">
                                                <input type="hidden" name="grand_total" value="<?php echo $row['grand_total'];?>">
                                                <input type="hidden" name="view" value="<?php echo $row['view'];?>">
                                                <input type="hidden" name="orders_date" value="<?php echo $row['orders_date'];?>">
                                                <button type="submit" name="orders_history" class="btn btn-success">Completed</button>
                                            </form></span>
                                        </td>
                                    </tr>
                            <?php }?>
                        </table>
                    <?php }while($row = $result->fetch_assoc());

                } else{
                    
                    echo '<h5 style="text-align: center;"> No Pending Product (s). </h5> ';
                }?>
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