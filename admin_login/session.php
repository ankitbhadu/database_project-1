<?php
   include('../config.php');
   session_start();
   $user_check = $_SESSION['admin_id'];
   $ses_sql = pg_query("select admin_id from admin where admin_id = '$user_check' ");
   $row = pg_fetch_assoc($ses_sql);
   $login_session = $row['admin_id'];
   if(!isset($_SESSION['admin_id'])){
      header("location:admin_login.php");
      die();
   }
?>
