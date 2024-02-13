<?php
    include('pages/header.php');


    require('config.php');
    
    $email = $_SESSION['email'];    
    $stmt = $conn->prepare("SELECT * FROM register WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $db_otp = $row['otp'];

    if(isset($_POST['verify'])){
        $otp = $_POST['otp'];

        if($otp == $db_otp){
            $reset_otp = null;

            $query = $conn->prepare("UPDATE register SET otp =? WHERE email = ?");
            $query->bind_param("is", $reset_otp, $email);
            $query->execute();

            header("Location: change_pass.php");

        }else{
            $error = '<b><p class=" text-danger">Incorrect OTP code!</p></b>';
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 m-auto p-3" style="background-color: whitesmoke;">
                <h3 class="text-center p-2">Verifying the OTP from Email</h3>

                <form action="" method="post">
                    <h5>Enter Your OTP From your Email</h5>
                    <input type="number" name="otp" class="form-control" placeholder="******" required>

                    <?php if (isset($error)){
                        echo $error;
                    }?>

                    <div class="row px-3">
                        <div class="col-lg-2 ml-auto">
                        <a class="btn btn-danger" href="index.php">Cancel</a>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" name="verify" class="btn btn-success">Submit</button>
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