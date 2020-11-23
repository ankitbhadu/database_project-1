<?php
  include('../config.php');
  session_start();
  // $sql="select * from admin";
   // $result = pg_query($sql);
   $error="";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $myadmin_id = $_POST['admin_id'];
      $mypassword = $_POST['password'];
      $sql = "SELECT * FROM admin WHERE admin_id = '$myadmin_id' and password = '$mypassword'";
      $result = pg_query($db,$sql);
      if (!$result) {
        echo "An error occurred.\n";
        exit;
      }
      $row = pg_fetch_row($result);
      $count = pg_num_rows($result);
      // If result matched $myadmin_id and $mypassword, table row must be 1 row
      if($count == 1) {
         $_SESSION['admin_id'] = $myadmin_id;
         echo $myadmin_id;
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
   // while ($row = pg_fetch_row($result)) {
   //   echo "$row[0] $row[1]";
   //   echo "<br />\n";
   // }
?>
<html>

   <head>
      <title>Login Page</title>

      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>

   </head>

   <body bgcolor = "#FFFFFF">

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label>admin_id  :</label><input type = "text" name = "admin_id" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/>
                  <button type="button" name="button" onclick="window.history.back()">Back</button>

               </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
            </div>

         </div>

      </div>

   </body>
</html>
