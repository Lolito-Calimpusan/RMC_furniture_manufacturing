<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>
    

    <!-- About us Container -->
        <div class="container-fluid bg-white p-3" style="height: auto;">
            <h2 class="text-center p-3">About Us</h2>

            <div class="row">
                <div class="col-lg-7 px-5">
                    <h5 class="text-center">RMC FURNITURE MANUFACTURING</h5>
                    <p class="px-3">We sell all kind of Sala Set, Sofabed, Beds & many more at very affordable price, Installment Available in our physical store only.</p>
                    <p class="px-3">Main branch Villa Coreto Corner, Washington City <br> Landmark: In front medical Hospital.</p>
                    <p class="px-3">Butuan branch  Jc Aquino Ave. Libertad Butuan City <br> Landmark: Beside Uratex Catering & near  Utarex Building.</p>
                </div>
                <div class="col-lg-5 px-5 mb-2">
                    <img src="images/logo/Logo.jpg" alt="picture sa RMC" width="100%" height="300px" style="border-radius: 10px;">
                </div>
            </div>

        </div>

    <!-- About us Container -->






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