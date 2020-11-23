<?php
   include('session.php');
?>
<html>

   <head>
      <title>Welcome </title>
   </head>

   <body>
      <h1>Welcome <?php echo $_SESSION['agent_id']; ?></h1>
      <button type="button" onclick="window.location.href = './number_of_tickets.php';">Book Tickets</button>
      <!-- <button type="button" onclick="window.location.href = './release_train.php';">Agent Login</button> -->
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>

</html>
