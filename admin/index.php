<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Total Registered Admin-->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="admin.php" class="text-decoration-none">Total Registered Admin</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              <?php 
                  // fetching the Total Registered Admin
                  require('../config.php');
                  $stmt = $conn->prepare("SELECT * FROM register WHERE role = 'Admin'");
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $total_register = $result->num_rows;
              ?>
              <h4><?= $total_register ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="users.php" class="text-decoration-none">Total Registered User(s)</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              <?php 
                  // fetching the Total Registered User(s)
                  require('../config.php');
                  $stmt = $conn->prepare("SELECT * FROM register WHERE role = 'User' ");
                  $stmt->execute();
                  $result = $stmt->get_result();
                  $total_register = $result->num_rows;
              ?>
              <h4><?= $total_register ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    

    <!-- Total Product(s) -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a href="products.php" class="text-decoration-none">Total Product(s)</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php 
                    // fetching the number of products
                    require('../config.php');
                    $stmt = $conn->prepare("SELECT * FROM product");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total_products = $result->num_rows;
                ?>
                <h4><?= $total_products ?></h4>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-bed fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Pending Order(s) -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a href="pending_orders.php" class="text-decoration-none">Total Pending Order(s)</a></div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">

                <?php 
                    // fetching the Total Pending Order(s)
                    require('../config.php');
                    $stmt = $conn->prepare("SELECT * FROM orders");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total_pending = $result->num_rows;
                ?>
                <h4><?= $total_pending ?></h4>

                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Total Approved Order(s) -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a href="approved_orders.php" class="text-decoration-none">Total Approved Order(s)</a></div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">

                <?php 
                    // fetching the approved orders
                    require('../config.php');
                    $stmt = $conn->prepare("SELECT * FROM approved_orders");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total_pending = $result->num_rows;
                ?>
                <h4><?= $total_pending ?></h4>

                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Total Success Order(s) -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a href="success_orders.php" class="text-decoration-none">Total Success Order(s)</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

              <?php 
                    // fetching the success orders
                    require('../config.php');
                    $stmt = $conn->prepare("SELECT * FROM orders_success");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total_pending = $result->num_rows;
                ?>
                <h4><?= $total_pending ?></h4>


              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-check fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>