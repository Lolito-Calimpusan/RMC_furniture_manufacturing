<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<?php
// inserting order details to approved orders
    require('../config.php');

    if(isset($_POST['approved_orders'])){
        $id = $_POST['id'];
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
        $proof = $_POST['proof'];
        $image = $_POST['image'];
        $orders_date = $_POST['orders_date'];
        $status = "We're now processing your Order(s)";
        $view = 1;

        $stmt = $conn->prepare("INSERT INTO approved_orders (`user_id`, `name`, `email`, `phone`, `address`, `products`, `grand_total`, `pmode`, `sender`, `reference_code`, `amount_paid`, `proof`, `image`, `orders_date`,`status`,view) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isssssisssisssss", $user_id, $name, $email, $phone, $address, $products, $grand_total, $pmode, $sender, $reference_code, $amount_paid, $proof, $image, $orders_date, $status, $view);
        $execute = $stmt->execute();

        if($execute){
            $query = $conn->prepare("DELETE FROM orders WHERE id = ?");
            $query->bind_param("i", $id);
            $query->execute();
        }
        
    }


?>

<div class="container-fluid" style="background-color: whitesmoke;">
    
    <div class="container p-4" style="background-color: white;">
        <h5 class="text-dark font-weight-bold m-0">Approved Orders</h5>
        <hr>
    <div class="table-responsive">

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
    <tr style="background-color: rgb(3, 3, 43); color: white;">
    <th>Images</th>
    <th>Name</th>
    <th>Products</th>
    <th>Amount Paid</th>
    <th>Status</th>
    <th colspan="3" class="text-center">Action</th>
    </tr>
</thead>
<tbody>

    <?php
        require('../config.php');
        $stmt = $conn->prepare("SELECT * FROM approved_orders ORDER BY id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->num_rows;

        if($total > 0){
            $row = $result->fetch_assoc(); ?>
            <?php do{ ?>
                <?php
                $image = $row['image'];
                $imageArray = explode(", ", $image); 
                ?>
                <tr>
                <td>
                    <?php foreach ($imageArray as $key => $value) {?>
                        <a href="products/<?= $value; ?>">
                            <img src="products/<?= $value; ?>" width="30px" height="30px">
                        </a>
                    <?php }
                    ?>
                </td>
                <td><?= $row['name'];?></td>
                <td><?= $row['products'];?></td>
                <td>&#8369; &nbsp;<?= number_format($row['amount_paid'],2);?></td>
                <td><?= $row['status'];?></td>

                <td class="text-center" style="width: 12px;">
                    <form action="view_approved_orders.php" method="post">
                        <input type="hidden" name="view_id" value="<?= $row['id']; ?>">
                        <button  type="submit" name="view_details" class="btn btn-primary"> <i class="fa fa-eye"></i></button>
                    </form>
                </td>

                <td class="text-center" style="width: 12px;">
                    <form action="edit_approved_status.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <button type="submit" name="edit_status" class="btn btn-info"> <i class="fa fa-edit"></i></button>
                    </form>
                </td>


                <td class="text-center" style="width: 12px;">
                    <form action="success_orders.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                        <input type="hidden" name="products" value="<?= $row['products']; ?>">
                        <input type="hidden" name="grand_total" value="<?= $row['grand_total']; ?>">
                        <input type="hidden" name="amount_paid" value="<?= $row['amount_paid']; ?>">
                        <input type="hidden" name="status" value="<?= $row['status']; ?>">
                        <!-- getting the details from db orders_success -->
                            <?php 
                                $orders_id = $row['id'];
                                $got = $conn->prepare("SELECT * FROM orders_success WHERE orders_id = ?");
                                $got->bind_param("i", $orders_id);
                                $got->execute();
                                $resulta = $got->get_result();

                                $get = $conn->prepare("SELECT * FROM approved_orders WHERE status != 'Arrived' AND id = ?");
                                $get->bind_param("i", $orders_id);
                                $get->execute();
                                $results = $get->get_result();

                                if($results->num_rows > 0){
                                    $rows = $results->fetch_assoc();
                                    echo '<button  type="submit" name="success_orders" class="btn btn-secondary" disabled><i class="fa fa-arrow-up"></i></button>';
                                }elseif($resulta->num_rows > 0){
                                    echo '<button  type="submit" name="success_orders" class="btn btn-secondary" disabled><i class="fa fa-check"></i></button>';
                                }else{
                                    echo '<button  type="submit" name="success_orders" class="btn btn-success"><i class="fa fa-arrow-up"></i></button>';
                                }

                                

                                

                            ?>
                            
                        </button>
                    </form>
                </td>

        
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