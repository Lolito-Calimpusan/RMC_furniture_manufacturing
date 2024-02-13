<?php 
    include('pages/header.php');

    require('config.php');

    if(isset($_POST['change_pass'])){
        $new_pass = md5($_POST['new_pass']);

        $email = $_SESSION['email'];    
        $stmt = $conn->prepare("SELECT * FROM register WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if($result->num_rows == 1){
            
            $stmts = $conn->prepare("UPDATE register SET password = ? WHERE email = ?");
            $stmts->bind_param("ss", $new_pass, $email);
            $stmts->execute();

            $_SESSION['Role'] = $row['role'];

            if($_SESSION['Role'] == 'Admin'){
                $_SESSION['Admin_id'] = $row['id'];
                header("Location:admin/index.php");
            }else{
                $_SESSION['User_id'] = $row['id'];
                header("Location: index.php");
            }

                
        }else{
            echo "email does not exist";
        }
        
    }
    

 ?>

    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 m-auto p-3" style="background-color: whitesmoke;">
                <h3 class="text-center p-2">Create New Password</h3>

                <form action="" method="post">
                    <h5>Password</h5>
                    <input type="text" name="new_pass" class="form-control" placeholder="Create new Password">
                    <button type="submit" name="change_pass" class="btn btn-success btn-block">Submit</button>

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