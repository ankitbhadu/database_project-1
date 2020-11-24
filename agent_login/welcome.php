<?php
   include('session.php');
?>
<!-- <html>

   <head>
      <title>Welcome </title>
   </head>

   <body>
      <h1>Welcome <?php echo $_SESSION['agent_id']; ?></h1>
      <button type="button" onclick="window.location.href = './add_train.php';">Add Train</button>
      <button type="button" onclick="window.location.href = './release_train.php';">Release Train</button>
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>

</html> -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand/logo -->
    <!-- <a class="navbar-brand" href="#">Railway Reservation system</a> -->

    <!-- Links -->
    <h2 class="navbar-brand">Welcome, <?php echo $_SESSION['agent_id']; ?></h2>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="./number_of_tickets.php">Book Ticket</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
  </nav>

</body>

</html>
