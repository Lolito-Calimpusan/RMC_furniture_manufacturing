<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>




<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-dark">Generate Sales Report
              <a href="sales_report.php"><button type="button" class="btn btn-primary" style="float: right;">
                Refresh
              </button></a>
      </h5>
    </div>
  <div class="card-body">


  <div class="table-responsive">

    <!-- Reports -->
  <div class="container-fluid">
    <!-- <h3 class="text-dark">Sales Reports</h3><br> -->

    <form action="" method="post">
      <div class="row">
        <div class="col-lg-4">
          <b>Start Date:</b>
          <input type="date" name="date1"  class="form-control">
        </div>
        <div class="col-lg-4">
          <b>End Date:</b>
          <input type="date" name="date2"  class="form-control">
        </div>
        <div class="col-lg-2">
          <br>
          <input type="submit" name="report" class="btn btn-primary btn-block form-control" value="Generate Report">
        </div>
      </div>
    </form>


  <!-- code for Generate report -->
    <?php
      if (isset($_POST['report'])) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
      
        // Baguhin ang format ng dates kung kinakailangan
        $formatted_date1 = date("Y-m-d", strtotime($date1));
        $formatted_date2 = date("Y-m-d", strtotime($date2));
      
        // Idagdag ang isang araw sa $formatted_date2 para isama ang petsang iyon
        $formatted_date2_plus_one = date("Y-m-d", strtotime($date2 . ' +1 day'));
      
        // Check kung walang laman ang start date at end date
        if (empty($date1) || empty($date2)) {
          echo "Please provide both start and end dates.";
        } else {
          // Validasyon ng date range kung may data sa database
          $check_sql = "SELECT SUM(amount_paid) AS total_sales 
                        FROM orders_success 
                        WHERE date_orders_success >= '$formatted_date1' 
                        AND date_orders_success < '$formatted_date2_plus_one'";
      
          $check_result = $conn->query($check_sql);
          $data_exists = $check_result->num_rows > 0;
      
          if ($data_exists) {
            $row = $check_result->fetch_assoc();
            $totalSales = $row['total_sales'];
      
            $date1_string = date("F j, Y", strtotime($date1));
            $date2_string = date("F j, Y", strtotime($date2));
            ?>
      
            <!-- Ipakita ang total na kita -->
            <button class="btn p-5 mt-3 bg-dark text-white" disabled>
              <h6>Total sales from <?php echo $date1_string; ?> to <?php echo $date2_string; ?> is</h6>
              <h4>&#8369; <?php echo number_format($totalSales, 2); ?></h4>
            </button>
      
          <?php
          } else {
            echo "No sales data available for the selected date range.";
          }
        }
      }
      
    ?>


  </div>

  <!-- Reports -->

  </div>
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>