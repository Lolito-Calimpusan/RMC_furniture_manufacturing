<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>
<?php
    require('config.php');
    $user_id = $_SESSION['User_id'];

    $grand_total = 0;
    $allItems = '';
    $items = array();

    $sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price, id, product_image FROM cart WHERE user_id = $user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        $grand_total +=$row['total_price'];
        $items[] = $row['ItemQty'];
        $cart_id = $row['id'];
        $image[] = $row['product_image'];

    }

    $allItems = implode(", ", $items);
    $allImage = implode(", ", $image);
    $percentage = 2;
    $delivery_fee = $grand_total * ($percentage)/ 100;
    $total_payable = $grand_total + $delivery_fee;
?>
    <style>
        .details {
            display: none;
        }
    </style>

    <div class="container-fluid">
        <div class="row justify-content-center" style="background: linear-gradient(0deg, rgba(34,178,195,1) 0%, rgba(196,197,199,0.5382528011204482) 54%);">
            <div class="col-lg-6 px-4 pb-4 my-3 bg-white" id="order">
                <h4 class="text-center text-info p-2">PAYMENT PROCESS</h4>
                <div class="jumbotron p-3 mb-2 text-center">
                    <h6 class="lead"><b>Product(s) : </b> <?= $allItems;?> </h6>
                    <h6 class="lead"><b>Grand Total : </b>&#8369;<?= number_format($grand_total,2);?></b>  </h6>
                    <h6 class="lead"><b>Delivery charge : &#8369;<?= number_format($delivery_fee,2);?></b>  </h6>
                    <h5><b>Total Amount Payable : </b>&#8369;<?= number_format($total_payable,2);?></h5>
                    <?php $imageArray = explode(", ", $allImage);
                    ?>
                    <?php 
                    foreach ($image as $key => $value) {?>

                        
                </div>

                        <div>
                            <form action="palawan.php" method="post">
                                <input type="hidden" name="cart_id" value="<?= $cart_id; ?>">
                                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                <input type="hidden" name="products" value="<?= $allItems; ?>">
                                <input type="hidden" name="grand_total" value="<?= $total_payable; ?>">
                                <input type="hidden" name="image" value="<?= $allImage; ?>">
                                <?php
                        }//foreach close
                        
                            $stmt = $conn->prepare("SELECT * FROM register WHERE id = $user_id ");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $total = $result->num_rows;
                            
                            if($total > 0){
                                $row = $result->fetch_assoc();
                            }

                        ?>

                        <div class="form-group">
                            <label>Name :</label>
                            <input type="text" name="name" class="form-control" value="<?= $row['fname']." ". $row['lname'];?> "placeholder="Enter Name"  style="margin-top: -6px;" required>
                        </div>

                        <div class="form-group">
                            <label>Email :</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" value="<?= $row['email'];?>" style="margin-top: -6px;" required>
                        </div>

                        <div class="form-group">
                            <label>Cellphone No. :</label>
                            <input type="number" name="phone" class="form-control" placeholder="Enter Phone" value="<?= $row['phone'];?>" style="margin-top: -6px;" required>
                        </div>

                        <div class="form-group">
                            <label>Delivery Address :</label>
                            <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address" style="margin-top: -6px;" required><?= $row['address'];?></textarea>
                        </div>
                
                </div>

                <div>
                    <h5 class="text-center">Payment Method</h5>

                    <h6 class="text-center lead">Get the reciepient details</h6>
                        <div class="form-group">
                            <select name="pmode" class="form-control" id="paymentMethod">
                                <option value="" selected>-Select Payment Mode-</option>
                                <option value="palawan">Palawan Pawnshop</option>
                                <option value="gcash">Gcash</option>
                            </select><br>

                            <!-- Palawan details -->
                            <div id="palawanDetails" class="details" style="background-color: whitesmoke; border: 1px solid green;">
                                <h5 class="bg-success p-2 text-center text-white">Palawan Express</h5>
                                <div class="p-3">
                                    <div class="p-2 text-center" style="border: 2px dashed green;">   
                                        <br>
                                        <p><b><i class="fa fa-user"></i> &nbsp; Reciever:</b> Lolito Coros Calimpusan Jr</p>
                                        <p><b><i class="fa fa-phone"></i> &nbsp; Number: </b>09108105607</p>
                                        <br><br>
                                    </div>
                                    <!-- Dito mo ilalagay ang mga detalye para sa Palawan Express -->
                                </div>
                            
                    
                            </div>

                            <div id="gcashDetails" class="details" style="background-color: whitesmoke; border: 1px solid blue;">
                                <h5 class="bg-primary p-2 text-center">Gcash</h5>
                                <div class="p-3">
                                <div class="p-2 text-center" style="border: 2px dashed blue;">   
                                        <br>
                                        <p><b><i class="fa fa-user"></i> &nbsp; Reciever:</b> Lolito Coros Calimpusan Jr</p>
                                        <p><b><i class="fa fa-phone"></i> &nbsp; Number: </b>09108105607</p>
                                        <br><br>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                            <input type="submit" class="btn btn-success btn-block" name="proceed_payment" value="Proceed">
                        </div>

                    </form>
                </div>

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

            $("#placeOrder").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: $('form').serialize()+"&action=order",
                    success: function(response){
                        $("#order").html(response);
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

<script>
        document.getElementById("paymentMethod").addEventListener("change", function () {
            var selectedOption = this.value;
            var palawanDetails = document.getElementById("palawanDetails");

            if (selectedOption === "palawan") {
                palawanDetails.style.display = "block";
            } else {
                palawanDetails.style.display = "none";
            }
        });

        document.getElementById("paymentMethod").addEventListener("change", function () {
            var selectedOption = this.value;
            var palawanDetails = document.getElementById("gcashDetails");

            if (selectedOption === "gcash") {
                palawanDetails.style.display = "block";
            } else {
                palawanDetails.style.display = "none";
            }
        });
    </script>
</body>
</html>