<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<?php

require('../config.php');
if(isset($_SESSION['Admin_id'])){
    
    $id = $_SESSION['Admin_id'];
    $stmt = $conn->prepare("SELECT * FROM register WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $total = $result->num_rows;
    
    if($total > 0){
        $row = $result->fetch_assoc(); 
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <img src="" alt="" style="height: 200px; width: 200px; border: 1px solid black;">
        </div>
        <div class="col-9">
            <h6>Name: <span><?= $row['fname']. " " . $row['lname'];?></span></h6>
            <h6>Gender: <span><?= $row['gender'];?></span></h6>
            <h6>Age: <span><?= $row['age'];?></span></h6>
            <h6>Address: <span><?= $row['address'];?></span></h6>
            <h6>Phone: <span><?= $row['phone'];?></span></h6>
            <h6>Email: <span><?= $row['email'];?></span></h6>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>