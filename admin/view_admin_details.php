<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<!-- code for getting the details of a user -->
<?php
    require('../config.php');
    if(isset($_POST['view'])){
      $id = $_POST['view_id'];
      
      $stmt = $conn->prepare("SELECT * FROM register WHERE `id` = ?");
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
            <th colspan="2" class="text-center bg-dark text-white"><?= $row['fname']." ". $row['lname'];?> Personal Details</th>
            
        </tr>
        <tr>
            <th>Firstname:</th>
            <td class="bg-gradient-white text-dark"><?= $row['fname'];?></td>
        </tr>
        <tr>
            <th>Lastname:</th>
            <td class="bg-gradient-white text-dark"><?= $row['lname'];?></td>
        </tr>
        <tr>
            <th>Gender:</th>
            <td class="bg-gradient-white text-dark"><?= $row['gender'];?></td>
        </tr>
        <tr>
            <th>Age:</th>
            <td class="bg-gradient-white text-dark"><?= $row['age'];?></td>
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
            <th>Role:</th>
            <td class="bg-gradient-white text-dark"><?= $row['role'];?></td>
        </tr>
        <tr>
            <?php 
              $date_registered = $row['date_registered'];
              $timestamp = strtotime($date_registered);
              $formattedDate = date("F j, Y", $timestamp);
              $time = date("H:i:s", $timestamp);
            ?>
            <th>Date Registered:</th>
            <td class="bg-gradient-white text-dark"><?= $formattedDate; ?></td>
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