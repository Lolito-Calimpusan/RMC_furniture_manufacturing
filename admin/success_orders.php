<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<?php
// inserting order details to approved orders
    require('../config.php');

    if(isset($_POST['success_orders'])){
        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $products = $_POST['products'];
        $grand_total = $_POST['grand_total'];
        $amount_paid = $_POST['amount_paid'];

        $stmts = $conn->prepare("INSERT INTO orders_success (`orders_id`, `user_id`, `products`, `grand_total`, `amount_paid`) VALUES(?,?,?,?,?)");
        $stmts->bind_param("iisii", $id, $user_id, $products, $grand_total, $amount_paid);
        $stmts->execute();
    }


?>

<div class="container-fluid" style="background-color: whitesmoke;">
    
    <div class="container p-4" style="background-color: white;">
        <h5 class="text-dark font-weight-bold m-0">Success Orders</h5>
        <hr>
    <div class="table-responsive">

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
    <tr style="background-color: rgb(3, 3, 43); color: white;">
    <th>id</th>
    <th>User ID</th>
    <th>Products</th>
    <th>Total Price</th>
    <th>Amount Paid</th>
    <th>Date Success</th>
    </tr>
</thead>
<tbody>

    <?php
        require('../config.php');
        $stmt = $conn->prepare("SELECT * FROM orders_success");
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->num_rows;

        if($total > 0){
            $row = $result->fetch_assoc(); ?>
            <?php do{ ?>
                <tr>
                    <td><?= $row['id'];?></td>
                    <td><?= $row['user_id'];?></td>
                    <td><?= $row['products'];?></td>
                    <td><?= $row['grand_total'];?></td>
                    <td><?= $row['amount_paid'];?></td>
                    <td><?= $row['date_orders_success'];?></td>
                </tr>
                <?php } while($row = $result->fetch_assoc()); 
            
        }else {
            echo '<td colspan=9" style="text-align: center; color: red;">Empty Records</td>';
        }?>

</tbody>
</table>

</div>
    </div>

</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>