<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>

    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-11 py-5 px-4 pb-4">
                <h3 class="text-danger">Thankyou!</h3>
                <h5>Your order is already submitted. Please wait for a while for a review of your payment</h5>
                <a href="orders.php"><button class="btn btn-primary">View Orders</button></a>
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