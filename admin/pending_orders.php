<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid" style="background-color: whitesmoke;">
    
    <div class="container p-4" style="background-color: white;">
        <h5 class="text-dark font-weight-bold m-0">Pending Orders</h5>
        <hr>
    <div class="table-responsive">

<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
    <tr style="background-color: rgb(3, 3, 43); color: white;">
    <th>Product Image</th>
    <th>Name</th>
    <th>Products</th>
    <th>Total Price</th>
    <th>Amount Paid</th>
    <th colspan="3" class="text-center">Action</th>
    </tr>
</thead>
<tbody>

    <?php
        require('../config.php');
        $stmt = $conn->prepare("SELECT * FROM orders");
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->num_rows;

        if($total > 0){
            $row = $result->fetch_assoc();     
            ?>
            
            <?php do{ ?>
                <?php
                $image = $row['image'];
                $imageArray = explode(", ", $image); 
                ?>
                <tr>
                <td>
                    <?php foreach ($imageArray as $key => $value) {?>
                        <a href="products/<?= $value; ?>">
                            <img src="products/<?= $value; ?>" width="35px" height="35px">
                        </a>
                    <?php }
                    ?>
                </td>
                <td><?= $row['name'];?></td>
                <td><?= $row['products'];?></td>
                <td>&#8369; &nbsp;<?= number_format($row['grand_total'],2);?></td>
                <td>&#8369; &nbsp;<?= number_format($row['amount_paid'],2);?></td>

                <td class="text-center" style="width: 12px;">
                    <form action="view_pending_orders.php" method="post">
                        <input type="hidden" name="view_id" value="<?= $row['id']; ?>">
                        <button  type="submit" name="view_details" class="btn btn-primary"> <i class="fa fa-eye"></i></button>
                    </form>
                </td>


                <td class="text-center" style="width: 12px;">
                    <form action="code.php" method="post">
                        <input type="hidden" name="pending_orders_id" value="<?= $row['id']; ?>">
                        <button type="submit" name="delete_pending_orders" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                    </form>
                </td> 

                <td class="text-center" style="width: 12px;">
                    <form action="approved_orders.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
                        <input type="hidden" name="name" value="<?= $row['name']; ?>">
                        <input type="hidden" name="email" value="<?= $row['email']; ?>">
                        <input type="hidden" name="phone" value="<?= $row['phone']; ?>">
                        <input type="hidden" name="address" value="<?= $row['address']; ?>">
                        <input type="hidden" name="pmode" value="<?= $row['pmode']; ?>">
                        <input type="hidden" name="products" value="<?= $row['products']; ?>">
                        <input type="hidden" name="grand_total" value="<?= $row['grand_total']; ?>">
                        <input type="hidden" name="sender" value="<?= $row['sender']; ?>">
                        <input type="hidden" name="reference_code" value="<?= $row['reference_code']; ?>">
                        <input type="hidden" name="amount_paid" value="<?= $row['amount_paid']; ?>">
                        <input type="hidden" name="proof" value="<?= $row['proof']; ?>">
                        <input type="hidden" name="image" value="<?= $row['image']; ?>">
                        <input type="hidden" name="orders_date" value="<?= $row['orders_date']; ?>">
                        <button  type="submit" name="approved_orders" class="btn btn-info"> <i class="fa fa-arrow-up"></i></button>
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