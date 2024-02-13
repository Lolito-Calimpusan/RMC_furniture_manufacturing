<?php
    session_start();
    require('../config.php');

    // Add register Admin
    if(isset($_POST['addAdminBtn'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $status = 'show';

        $stmt = $conn->prepare("INSERT INTO `register` (`fname`, `lname`, `age`, `gender`, `address`, `phone`, `email`, `password`, `role`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssss", $fname, $lname, $age, $gender, $address, $phone, $email, $password, $role, $status);
        $run_edit_register = $stmt->execute();
        if($run_edit_register)
        {
            $_SESSION['success'] = "Added Succesfully";
            header("Location: admin.php");
            
        }
        else{
            $_SESSION['status'] = "Unsuccesful added";
            header("Location: admin.php");
        }  

    }


    // Add register user
    if(isset($_POST['addUserBtn'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];
        $status = 'show';

        $stmt = $conn->prepare("INSERT INTO `register` (`fname`, `lname`, `age`, `gender`, `address`, `phone`, `email`, `password`, `role`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssssss", $fname, $lname, $age, $gender, $address, $phone, $email, $password, $role, $status);
        $run_edit_register = $stmt->execute();
        if($run_edit_register)
        {
            $_SESSION['success'] = "Added Succesfully";
            header("Location: users.php");
            
        }
        else{
            $_SESSION['status'] = "Unsuccesful added";
            header("Location: users.php");
        }  

    }


    // edit admin and Updating admin
    if(isset($_POST['update_admin'])){
        $id = $_POST['edit_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];

        $stmt = $conn->prepare("UPDATE `register` SET `fname` = ?, `lname` = ?, `age` = ?, `gender` = ?, `address` = ?, `phone` = ?, `email` = ?, `password` = ?, `role` = ? WHERE `id` = ?");
        $stmt->bind_param("ssssssssss", $fname, $lname, $age, $gender,  $address, $phone, $email, $password, $role, $id);
        $run_edit_register = $stmt->execute();
        if($run_edit_register)
        {
            $_SESSION['success'] = "Succesfully Updated";
            header("Location: admin.php");
            
        }
        else{
            $_SESSION['status'] = "Unsuccesful Updated";
            header("Location: admin.php");
        }  
    }



    // edit User and Updating User
    if(isset($_POST['update_user'])){
        $id = $_POST['edit_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role = $_POST['role'];

        $stmt = $conn->prepare("UPDATE `register` SET `fname` = ?, `lname` = ?, `age` = ?, `gender` = ?, `address` = ?, `phone` = ?, `email` = ?, `password` = ?, `role` = ? WHERE `id` = ?");
        $stmt->bind_param("ssssssssss", $fname, $lname, $age, $gender,  $address, $phone, $email, $password, $role, $id);
        $run_edit_register = $stmt->execute();
        if($run_edit_register)
        {
            $_SESSION['success'] = "Succesfully Updated";
            header("Location: users.php");
            
        }
        else{
            $_SESSION['status'] = "Unsuccesful Updated";
            header("Location: users.php");
        }  
    }
    




    // Delete Admin
    if(isset($_GET['delete_admin'])){
        $id = $_GET['delete_admin'];
        $status = "hide";
        $role = null;

        $stmt = $conn->prepare("UPDATE `register` SET `status` = ?, `role` = ?  WHERE `id` = ?");
        $stmt->bind_param("sss",  $status, $role, $id);
        $run_delete_register = $stmt->execute();

        if($run_delete_register)
        {
            $_SESSION['success'] = "Succesfully Deleted";
            header("Location: admin.php");
        }
        else{
            $_SESSION['status'] = "Unsuccesful Delete";
            header("Location: admin.php");
        }  

    }



    // Delete User
    if(isset($_GET['delete_user'])){
        $id = $_GET['delete_user'];
        $status = "hide";
        $role = null;

        $stmt = $conn->prepare("UPDATE `register` SET `status` = ?, `role` = ?  WHERE `id` = ?");
        $stmt->bind_param("sss",  $status, $role, $id);
        $run_delete_register = $stmt->execute();

        if($run_delete_register)
        {
            $_SESSION['success'] = "Succesfully Deleted";
            header("Location: users.php");
        }
        else{
            $_SESSION['status'] = "Unsuccesful Delete";
            header("Location: users.php");
        }  

    }



    // Restore Archive Admin
    if(isset($_POST['restore'])){
        $id = $_POST['restore_id'];
        $status = "show";
        $role = "User";

        $stmt = $conn->prepare("UPDATE `register` SET `status` = ?, `role` = ?  WHERE `id` = ?");
        $stmt->bind_param("sss",  $status, $role, $id);
        $run_delete_register = $stmt->execute();

        if($run_delete_register)
        {
            $_SESSION['success'] = "Restored Succesfully";
            header("Location: archive.php");
        }
        else{
            $_SESSION['status'] = "Unsuccesfully Restored";
            header("Location: archive.php");
        }  

    }




     // Changing for Admin email login
     if(isset($_POST['editEmail'])){
        $id = $_POST['email_id'];
        $email = $_POST['adminEmail'];

        $stmt = $conn->prepare("UPDATE `register` SET `email` = ? WHERE `id` = ?");
        $stmt->bind_param("ss", $email, $id);
        $run_emailForLogin = $stmt->execute();

        if($run_emailForLogin)
        {
            $_SESSION['success'] = "Successfully Change";
            header("Location: adminSetting.php");
            
        }
        else{
            $_SESSION['status'] = "Unsuccesful to Change";
        }   
    }








    // Add Product
    if(isset($_POST['addProductBtn'])){
        $pname = $_POST['pname'];
        $pdesc = $_POST['pdesc'];
        $pprice = $_POST['pprice'];
        $pcode = $_POST['pcode']; 
        $image = $_FILES["image"]['name']; 
        $category = $_POST['category'];

        if(file_exists("products/" . $_FILES["image"]["name"])){
            $store = $_FILES["image"]["name"];
            $_SESSION['status'] = "image already exists. '.$store.'";
            header("Location: products.php");
        }
        else
        {
    
            $stmt = $conn->prepare("INSERT INTO product (`product_name`, `product_desc`, `product_price`, `product_image`, `product_code`, `category`) VALUES (?,?,?,?,?,?)");
            $query_run = $stmt->bind_param("ssssss", $pname, $pdesc, $pprice, $image, $pcode, $category);
            $query_run = $stmt->execute();
    
            if($query_run)
            {
                move_uploaded_file($_FILES["image"]["tmp_name"], "products/".$_FILES["image"]["name"]);
                $_SESSION['success'] = "Successfully Added Product";
                header("Location: products.php");
            }
            else{
                $_SESSION['status'] = "Unsuccessfully Added Product";
                header("Location: products.php");
            }  
        }


    }



    // Edit Product
    if(isset($_POST['edit_product'])){
        $id = $_POST['edit_id'];
        $pname = $_POST['pname'];
        $pdesc = $_POST['pdesc'];
        $pprice = $_POST['pprice'];
        $pcode = $_POST['pcode'];

        $stmt = $conn->prepare("UPDATE product SET product_name = ?, product_desc = ?, product_price = ?, product_code = ? WHERE id = ?");
        $stmt->bind_param("sssss", $pname, $pdesc, $pprice, $pcode, $id);
        $run_edit_product = $stmt->execute();
        if($run_edit_product)
        {
            $_SESSION['success'] = "Succesfully Updated";
            header("Location: products.php");
            
        }
        else{
            $_SESSION['status'] = "Unsuccesful Updated";
        }   

    }



     // Delete Product
     if(isset($_POST['delete_btn'])){
        $id = $_POST['delete_id'];

        $stmt = $conn->prepare("DELETE FROM product WHERE id = ?");
        $stmt->bind_param("s", $id);
        $run_delete_product = $stmt->execute();

        if($run_delete_product)
        {
            $_SESSION['success'] = "Succesfully Deleted";
            header("Location: products.php");
        }
        else{
            $_SESSION['status'] = "Unsuccesful Delete";
            header("Location: products.php");
        }  

    }



     // Delete Product
     if(isset($_POST['delete_pending_orders'])){
        $id = $_POST['pending_orders_id'];

        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("s", $id);
        $run_delete_product = $stmt->execute();

        if($run_delete_product)
        {
            $_SESSION['success'] = "Succesfully Deleted";
            header("Location: pending_orders.php");
        }
        else{
            $_SESSION['status'] = "Unsuccesful Delete";
            header("Location: pending_orders.php");
        }  

    }


    // Edit Status from Approved Orders
    if(isset($_POST['edit_status'])){
        $id = $_POST['edit_id'];
        $status = $_POST['status'];
        $message = $_POST['message'];

        $stmt = $conn->prepare("UPDATE approved_orders SET status = ?, message = ? WHERE id = ?");
        $stmt->bind_param("sss", $status, $message, $id);
        $run_edit_status = $stmt->execute();
        if($run_edit_status)
        {
            $_SESSION['success'] = "Succesfully Updated";
            header("Location: approved_orders.php");
            
        }
        else{
            $_SESSION['status'] = "Unsuccesful Updated";
            header("Location: approved_orders.php");
        }   

    }








   




?>