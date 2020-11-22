<?php
   include('session.php');
?>
<html>

   <head>
      <title>Welcome </title>
   </head>

   <body>
      <h1>Welcome <?php echo $_SESSION['admin_id']; ?></h1>
      <button type="button" onclick="window.location.href = './add_train.php';">Add Train</button>
      <button type="button" onclick="window.location.href = './release_train.php';">Release Train</button>
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>

</html>
