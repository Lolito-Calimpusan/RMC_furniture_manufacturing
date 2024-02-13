<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>
>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4">
                    
                <form action="" method="post" id="placeOrder" style="box-shadow: 0px 2px 2px rgba(0,0,0,0.3);">            
                    <!-- Palawan details -->
                    <h5 class="bg-primary p-3 text-center text-white">GCACH Express</h5>
                    <div class="p-3">
                        <p><b>Reciever:</b> Lolito Coros Calimpusan Jr</p>
                        <p><b>Gcash Number : </b>09108105607</p>
                        <input type="text" name="sender" class="form-control" placeholder="Sender Name">
                        <input type="text" name="reference_code" class="form-control" placeholder="Reference Number">
                        <input type="number" name="amount_paid" class="form-control" placeholder="Amount of Payment"><br>
                        <div class="form-group">
                            <h3 style="font-size: 15px; texr-align: center;">UPLOAD PROOF OF PAYMENT</h3>
                            <input type="file" name="proof" class="form-control" style="height: 150px; border: 2px dashed black; text-align: center;">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block" name="submit" value="SUBMIT">
                        </div>
                    </div>
                </form>

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