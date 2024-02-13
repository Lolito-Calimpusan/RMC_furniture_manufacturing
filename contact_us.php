<?php 
    include('pages/header.php');
    include('pages/navigation.php');
 ?>

<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
    require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

    require('config.php');

    // Update this line with your email address
    $recipientEmail = 'calimpusanlolito@gmail.com';

    $error = "";
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            // Configure SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->Username = 'Calimpusanlolito@gmail.com'; // Your Gmail username
            $mail->Password ='ycti vmjg sgzr zfws'; // Your Gmail password
            $mail->setFrom($email, 'RMC Furniture Manufacturing');
            $mail->addAddress($recipientEmail, 'Lolito Coros Calimpusan Jr'); // Replace with your name

            // Set the email content
            $mail->IsHTML(true);
            $mail->Subject = 'Contact Form Submission: ' . $subject;
            $mail->Body = '
                <html>
                    <body style="font-family: Arial, sans-serif;">
                        <h2>Contact Form Submission</h2>
                        <p><strong>Name:</strong> ' . $name . '</p>
                        <p><strong>Email:</strong> ' . $email . '</p>
                        <p><strong>Subject:</strong> ' . $subject . '</p>
                        <p><strong>Message:</strong><br>' . nl2br($message) . '</p>
                    </body>
                </html>';
            $mail->AltBody = 'success';

            if($mail->send()){
                $error = "success";
            } else {
                $error = "error: " . $mail->ErrorInfo; // Capture specific error information
            }
        } catch(Exception $e) {
            $error = "error: " . $e->getMessage(); // Capture general exception error
        }
    }
?>

    

    <!-- Contact us Container -->
        <div class="container bg-white p-3" style="height: auto;">
            <h2 class="text-center p-3">Contact Us</h2>

            <div class="row pb-5">
                <!-- Iframe for business location -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31478.571231224978!2d125.61260231015709!3d9.524241013404222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33016a4a932461a3%3A0x10f02bc6dd7c319f!2sPungtod%2C%20Bacuag%2C%20Surigao%20del%20Norte!5e0!3m2!1sen!2sph!4v1673519594421!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <h5>San nicolas Street, Surigao City</h5>
                    <p class="pb-3 text-muted">Business location</p>

                    <h5>SMART - 09998892934</h5>
                    <h5>GLOBE - 09663383361</h5>
                    <p class="pb-3 text-muted">Monday to Sunday 24 Hours</p>

                    <h5>Rmcfurnituremanufacturing@gmail.com</h5>
                    <p class="pb-3 text-muted">Email us your query</p>
                </div>

                <div class="col-lg-6 mb-2">
                <?php if($error){
                    echo $error;
                }?>
                    <h5 class="text-center">Message Us</h5>
                    <form action="" method="post">
                        <input type="text" name="name"  class="form-control border-dark" placeholder="Enter your Name">
                        <input type="email" name="email"  class="form-control border-dark" placeholder="Email Address">
                        <input type="text" name="subject"  class="form-control border-dark" placeholder="Enter your subject">
                        <textarea name="message" cols="30" rows="4"  class="form-control border-dark" placeholder="Enter your Message"></textarea>
                        <button type="submit" name="submit" class="btn btn-success btn-block mt-2">Send Message</button>
                    </form>
                </div>
            </div>

        </div>

    <!-- Contact us Container -->






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