<?php
   session_start();

   if(session_destroy()) {
      header("Location: agent_login.php");
   }
   else{
     echo "error in destroying session";
   }
?>
