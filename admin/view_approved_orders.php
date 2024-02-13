<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<!-- code for getting the details of a user -->
<?php
    require('../config.php');
    if(isset($_POST['view_details'])){
      $id = $_POST['view_id'];
      
      $stmt = $conn->prepare("SELECT * FROM approved_orders WHERE `id` = ?");
      $stmt->bind_param('i', $id);
      $stmt->execute();
      $result = $stmt->get_result();
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
      }
    }
?>

<div class="container-fluid">

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered text-dark bg-gradient-dark" id="dataTable" width="100%" cellspacing="0" style="box-shadow: 3px 4px 4px rgba(0,0,0,0.3);">

        <tr>
            <th colspan="2" class="text-center bg-dark text-white"> Orders and Payment details</th>
            
        </tr>
        <tr>
            <th>User ID:</th>
            <td class="bg-gradient-white text-dark"><?= $row['user_id'];?></td>
        </tr>
        <tr>
            <th>Name:</th>
            <td class="bg-gradient-white text-dark"><?= $row['name'];?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td class="bg-gradient-white text-dark"><?= $row['email'];?></td>
        </tr>
        <tr>
            <th>Phone:</th>
            <td class="bg-gradient-white text-dark"><?= $row['phone'];?></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td class="bg-gradient-white text-dark"><?= $row['address'];?></td>
        </tr>
        <tr>
            <th>Products:</th>
            <td class="bg-gradient-white text-dark"><?= $row['products'];?></td>
        </tr>
        <tr>
            <th>Grand Tolal:</th>
            <td class="bg-gradient-white text-dark">&#8369; &nbsp;<?= number_format($row['grand_total'],2);?></td>
        </tr>
        <tr>
            <th>Payment Method:</th>
            <td class="bg-gradient-white text-dark"><?= $row['pmode'];?></td>
        </tr>
        <tr>
            <th>Sender:</th>
            <td class="bg-gradient-white text-dark"><?= $row['sender'];?></td>
        </tr>
        <tr>
            <th>Reference Code:</th>
            <td class="bg-gradient-white text-dark"><?= $row['reference_code'];?></td>
        </tr>
        <tr>
            <th>Amount Paid:</th>
            <td class="bg-gradient-white text-dark">&#8369; &nbsp;<?= number_format($row['amount_paid'],2);?></td>
        </tr>
        <tr>
            <th>Proof of Payment:</th>
            <td class="bg-gradient-white text-dark"><?= $row['proof'];?></td>
        </tr>
        <tr>
            <?php 
              $date_registered = $row['orders_date'];
              $timestamp = strtotime($date_registered);
              $formattedDate = date("F j, Y", $timestamp);
              $time = date("H:i:s", $timestamp);
            ?>

            <th>Date Purchased</th>
            <td class="bg-gradient-white text-dark"><?= $formattedDate;?></td>
        </tr>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>