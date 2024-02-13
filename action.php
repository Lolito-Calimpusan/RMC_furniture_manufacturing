<?php
    session_start();
    require 'config.php';

      // Register
      if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $password2 = md5($_POST['password2']);
        $role = $_POST['role'];
        $image = $_POST['image'];
        $status = "show";

            if($password == $password2){ 
                
                $query = $conn->prepare("INSERT INTO `register`(`fname`, `lname`, `age`, `gender`, `address`, `phone`, `image`, `email`, `password`, `role`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                $query->bind_param("sssssssssss", $fname, $lname, $age, $gender, $address, $phone, $image, $email, $password, $role, $status);
                $query->execute();
                header("Location:index.php");

                // echo "equal man";
            }
            else{
                // echo "Password does not match";
                $_SESSION['error'] = "Password does not match!";
                header("Location:index.php");
            }
    }
   


     // Login
     if(isset($_POST['login'])){
        $email = $_POST['email'];
        $myPassword = md5($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM register WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->num_rows;

        if($total >= 1){
            $row = $result->fetch_assoc();
            $passFromDb = $row['password'];

            if($myPassword == $passFromDb) {

                $_SESSION['Role'] = $row['role'];
                    if($_SESSION['Role'] == 'Admin'){
                        $_SESSION['Admin_id'] = $row['id'];
                        header("Location:admin/index.php");
                    }else{
                        $_SESSION['User_id'] = $row['id'];
                        header("Location: index.php");
                    }
            }
            else{
                $_SESSION['status'] = "Incorrect Password";
                header("location: index.php");
            }

        }else{
            header("location: index.php");
            $_SESSION['status'] = "Incorrect Email, Please do signup first!";
            
        }
    }


    // change Profile Picture
    if(isset($_POST['change_pic'])){
        $id = $_POST['user_id'];
        $image = $_FILES["image"]['name']; 
    
        $stmt = $conn->prepare("UPDATE `register` SET `image` = ? WHERE `id` = ?");
        $stmt->bind_param("ss", $image, $id);
        $query_run = $stmt->execute();

        if($query_run)
        {
            move_uploaded_file($_FILES["image"]["tmp_name"], "admin/users_pictures/".$_FILES["image"]["name"]);
            // $_SESSION['success'] = "Successfully Added Product";
            header("Location: userProfile.php");
        }
        else{
            // $_SESSION['status'] = "Unsuccessfully Added Product";
            header("Location: userProfile.php");
        }  


    }




    


    // Changing for User email login
    if(isset($_POST['editEmail'])){
        $id = $_POST['email_id'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE `register` SET `email` = ? WHERE `id` = ?");
        $stmt->bind_param("ss", $email, $id);
        $run_emailForLogin = $stmt->execute();

        if($run_emailForLogin)
        {
            $_SESSION['success'] = "Successfully Change";
            header("Location: userSetting.php");
            
        }
        else{
            $_SESSION['status'] = "Unsuccesful to Change";
        }   
    }



    // add to cart
    if(isset($_POST['pid'])){
        $user_id = $_SESSION['User_id'];
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pimage = $_POST['pimage'];
        $pcode = $_POST['pcode'];
        $pqty = 1;

        $stmt = $conn->prepare("SELECT product_code FROM cart WHERE product_code =? && user_id =?");
        $stmt->bind_param("ss",$pcode, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->num_rows;
        $prod_code = null; // Initialize $prod_code to null before the conditional check

        if($total > 0){
            $row = $result->fetch_assoc();
            $prod_code = $row['product_code'];
        }

        if($prod_code === null || !$prod_code){
            // code to insert into cart
            $query = $conn->prepare("INSERT INTO cart(`user_id`, `product_name`, `product_price`, `product_image`, `qty`, `total_price`, `product_code`) VALUES (?,?,?,?,?,?,?)");
            $query->bind_param("ssssiss", $user_id, $pname, $pprice, $pimage, $pqty, $pprice, $pcode);
            $query->execute();

            echo '<div class="alert alert-success alert-dismissible mt-2">
                    <button type="button" class="close" data-dismiss="alert">&times;</button> 
                    <strong>Item added to your Cart!</strong> 
                </div>';
        }
        else{
            echo '<div class="alert alert-danger alert-dismissible mt-2">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Item already added to your cart!</strong> 
                </div>';
        }

    }



    // this code is for load_cart_item_number

    if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'){
        $user_id = $_SESSION['User_id'];
        
        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id =?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->store_result();
        $rows = $stmt->num_rows;

        echo $rows;
    } 




    // This code for deleting item for cart
    if(isset($_GET['remove'])){
        $id = $_GET['remove'];

        $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'Item remove from the cart!';
        header("Location: cart.php");
    }



    //This code for delete all items in Cart 
    if(isset($_GET['clear'])){
        $user_id = $_SESSION['User_id'];

        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'All Item remove from the cart';
        header("Location: cart.php");
    }





    // code for updating the quantity
    if(isset($_POST['qty'])){
        $qty = $_POST['qty'];
        $pid = $_POST['pid'];
        $pprice = $_POST['pprice'];

        $tprice = $qty * $pprice;

        $stmt = $conn->prepare("UPDATE cart SET qty = ?, total_price = ? WHERE id = ?");
        $stmt->bind_param("isi", $qty, $tprice, $pid);
        $stmt->execute();
    }




    
    // This code for checkout
    if(isset($_POST['action']) && isset($_POST['action']) == 'order'){
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $products = $_POST['products'];
        $grand_total = $_POST['grand_total'];
        $address = $_POST['address'];
        $pmode = $_POST['pmode'];
        $sender = $_POST['sender'];
        $reference_code = $_POST['reference_code'];
        $amount_paid = $_POST['amount_paid'];
        $proof = $_POST['proof'];

        $data = '';

        $stmt = $conn->prepare("INSERT INTO orders (`name`, `email`, `phone`, `address`, `pmode`, `products`, `grand_total`, `sender`, `reference_code`, `amount_paid`, `proof`) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssss", $name, $email, $phone, $address, $pmode, $products, $grand_total, $sender, $reference_code, $amount_paid, $proof);
        $execute = $stmt->execute();

        if($execute){
            $query = $conn->prepare("DELETE FROM cart WHERE id = ?");
            $query->bind_param("i", $user_id);
            $query->execute();
        }


        $data .= '<div class="text-center">
                    <h1 class="display-4 mt-2 text-danger">Thank you!</h1>
                    <h2 class="text-success">Your Order Places Successfully!</h2>
                    <h4 class="bg-danger text-light rounded p-2">Item purchased : '.$products.'</h4>
                    <h4>Your Name: '.$name.'</h4>
                    <h4>Your Email: '.$email.'</h4>
                    <h4>Your Phone: '.$phone.'</h4>
                    <h4>Total Amount Paid: '.number_format($grand_total,2).'</h4>
                    <h4>Payment Mode: '.$pmode.'</h4>
                </div>';
        echo $data;        
    }





    //  code for checkout proceed payment
    if(isset($_POST['submit'])){
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $pmode = $_POST['pmode'];
        $products = $_POST['products'];
        $grand_total = $_POST['grand_total'];
        $sender = $_POST['sender'];
        $reference_code = $_POST['reference_code'];
        $amount_paid = $_POST['amount_paid'];
        $proof = $_FILES["proof"]['name'];
        $image = $_POST['image'];

        $stmt = $conn->prepare("INSERT INTO orders (`user_id`,`name`,`email`,`phone`,`address`,`pmode`,`products`,`grand_total`,`sender`,`reference_code`,`amount_paid`,`proof`,`image`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssssss", $user_id, $name, $email, $phone, $address, $pmode, $products, $grand_total, $sender, $reference_code, $amount_paid, $proof, $image);
        $execute = $stmt->execute(); 

        if($execute){
            move_uploaded_file($_FILES["proof"]["tmp_name"], "admin/proofOfPayment/".$_FILES["proof"]["name"]);

            $query = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
            $query->bind_param("i", $user_id);
            $query->execute();

            header("Location: payment_submitted.php");
             
        }
        
    }





    // Update the edited User_profile in userProfile.php
    if(isset($_POST['update_profile'])){
        $id = $_POST['id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE register SET fname = ?, lname = ?, gender = ?, age = ?, address = ?, phone = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssssssss", $fname, $lname, $gender, $age, $address, $phone, $email, $id);
        $execute = $stmt->execute();

        if($execute){
            $_SESSION['success'] = "Successfully Updated!";
            header("Location: userProfile.php");
        }else{
            $_SESSION['status'] = "Unsuccessfully Updated Profile";
            header("Location: userProfile.php");
        }

    }




    // Change Password in userSetting.php
    if(isset($_POST['change'])){
        $id = $_POST['id'];
        $password = $_POST['password'];
        $cpassword = md5($_POST['cpassword']);
        $npassword = md5($_POST['npassword']);

        if($password == $cpassword){
            $stmt = $conn->prepare("UPDATE register SET password = ? WHERE id = ?");
            $stmt->bind_param("ss", $npassword, $id);
            $execute = $stmt->execute();

            if($execute){
                $_SESSION['success'] = "Successfully Changed!";
                header("Location: userSetting.php");
            }else{
                $_SESSION['status'] = "Unsuccessfully change the password";
                header("Location: userSetting.php");
            }
           
        }else{
            $_SESSION['status'] = "Current Password Incorrect";
            header("Location: userSetting.php");
        }
    }



    // Orders History
    if(isset($_POST['orders_history'])){
        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $products = $_POST['products'];
        $grand_total = $_POST['grand_total'];
        $view = $_POST['view'];
        $orders_date = $_POST['orders_date'];

        $stmt = $conn->prepare("INSERT INTO orders_history (`user_id`,`products`,`grand_total`,`view`,`orders_date`) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $user_id, $products, $grand_total, $view, $orders_date);
        $execute = $stmt->execute();

        if($execute){
            $statement = $conn->prepare("UPDATE approved_orders SET view = 0 WHERE id = ?");
            $statement->bind_param("s", $id);
            $statement->execute();
            header("Location: orders_history.php");
        }

    }

?>
