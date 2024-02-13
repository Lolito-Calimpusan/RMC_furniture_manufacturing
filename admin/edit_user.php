<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<?php 
include('../config.php');
    if(isset($_POST['edit_btn'])){
        $id = $_POST['edit_id'];

        $stmt = $conn->prepare("SELECT * FROM register WHERE `id` = ? ");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $total = $result->num_rows;

        if($total > 0){
            $row = $result->fetch_assoc();
        }
        else{
            echo "Records does not found";
        }
    
    
    }

?>
  <div class="container-fluid">
    <form action="code.php" method="post">
        <div class="row">
            <div class="col-6">
              <input type="hidden" name="edit_id" value="<?= $row['id']; ?>">
                <input type="text" name="fname"  class="form-control mb-2"  value="<?= $row['fname'];?>">
            </div>
            <div class="col-6">
                <input type="text" name="lname"  class="form-control mb-2"  value="<?= $row['lname'];?>">
            </div>
            <div class="col-6 mb-2">
                <select name="gender"  class="form-control">
                    <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : '';?>>Male</option>
                    <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : '';?>>Female</option>
                </select>
            </div>
            <div class="col-6 mb-2">
                <input type="number" name="age"  class="form-control" placeholder="Age" value="<?= $row['age'];?>">
            </div>
        </div>

        <textarea name="address" cols="10" class="form-control mb-2"><?php echo $row['address']; ?></textarea>


        <input type="number" name="phone"  class="form-control mb-2" placeholder="Phone number" value="<?= $row['phone'];?>">
        
        <input type="email" name="email"  class="form-control mb-2" placeholder="Email" value="<?= $row['email'];?>">

        <select name="role" class="form-control">
            <option value="User"  <?php echo ($row['role'] == "User")? 'selected' : '';?>>User</option>
            <option value="Admin" <?php echo ($row['role'] == "Admin") ? 'selected' : ''; ?>>Admin</option>
        </select><br>

        <button type="submit" name="update_user" class="btn btn-success form-control mb-2">Update</button>
    </form>
  </div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>