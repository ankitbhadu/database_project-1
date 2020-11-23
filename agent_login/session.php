<?php
   include('../config.php');
   session_start();
   $user_check = $_SESSION['agent_id'];
   $ses_sql = pg_query("select agent_id from agent where agent_id = '$user_check' ");
   $row = pg_fetch_assoc($ses_sql);
   $login_session = $row['agent_id'];
   if(!isset($_SESSION['agent_id'])){
      header("location:agent_login.php");
      die();
   }
?>
