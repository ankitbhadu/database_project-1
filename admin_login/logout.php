<?php
   session_start();

   if(session_destroy()) {
      header("Location: admin_login.php");
   }
   else{
     echo "error in destroying session";
   }
?>
