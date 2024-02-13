<?php 
    include('pages/header.php');
 ?>

<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
    require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

    require('config.php');
    $error = "";
    if(isset($_POST['forgot_pass'])){
        $input_email = $_POST['email'];
        
        $stmt = $conn->prepare("SELECT * FROM register WHERE email = ?");
        $stmt->bind_param("s", $input_email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $db_email = $row['email'];
            $fullname = $row['fname']." ".$row['lname'];
            $otp = random_int(100000, 999999);
            
            $stmts = $conn->prepare("UPDATE register SET otp =? WHERE email = ?");
            $stmts->bind_param("is", $otp, $db_email);
            $stmts->execute();


            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);
            try {
                // Configure SMTP settings for Outlook.com/Hotmail.com
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->Username = 'Calimpusanlolito@gmail.com';
                // Your Outlook.com or Hotmail.com email address
                $mail->Password ='ycti vmjg sgzr zfws'; // Your email account password
                // Set the email content
                $mail->setFrom('Calimpusanlolito@gmail.com', 'RMC Furniture Manufacturing');
                $mail->addAddress($db_email,$fullname);
                $mail->IsHTML(true);
                $mail->Subject = 'OTP Code for Forgot Password';
                $mail->Body = '
                <html>
                    <body style="font-family: Arial, sans-serif;">
                        <h2">Sending OTP Code for Forgot Password!</h2>
                        <p>Hello '.$fullname.'</p>
                        <p>Your OTP is '.$otp.' this will expire in 3 minutes</p>
                    </body>
                </html>';
                $mail->AltBody = 'success'; // Send the email

                if($mail->send()){
                    $error = "success";
                    
                    $sql = $conn->prepare("SELECT * FROM register WHERE email = ?");
                    $sql->bind_param("s", $db_email);
                    $sql->execute();
                    $result = $sql->get_result();
                    $row = $result->fetch_assoc();

                    $_SESSION['email'] = $row['email']; 
                    header("Location: verify_otp.php");
                }
            } catch(Exception $e) {
                $error = "error";
            }


        }else{
            $error = '<b><p class=" text-danger">Email Does not Exist</p></b>';
        }

  
    }
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-lg-6 m-auto p-3" style="background-color: whitesmoke;">
            <h3 class="text-center p-2">Forgot Password</h3>

            <form action="" method="post">
                <h5>Enter Your Email</h5>
                <input type="email" name="email" class="form-control" placeholder="Eg, john@gmail.com" required>
                
                <?php if($error){
                    echo $error;
                }?>

                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 ml-auto">
                        <button type="submit" name="forgot_pass" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 pb-1">
                    <a class="btn btn-danger btn-block" href="index.php">Cancel</a>
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