<?php
 session_start();
 unset($_SESSION['Admin_id']);
 unset($_SESSION['User_id']);
 
 header("Location: index.php");
 ?>