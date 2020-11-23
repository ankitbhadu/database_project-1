<?php
   include('session.php');
?>
<html>

<head>
  <title>Welcome </title>
</head>
<body>
  <h1>Welcome <?php echo $_SESSION['admin_id']; ?></h1>
<form class="" action="" method="post">
  <label for="train_no">train_no</label><br>
  <input type="text" id="train_no" name="train_no"><br>
  <label for="DOJ">DOJ</label><br>
  <input type="text" id="DOJ" name="DOJ"><br>
    <label for="t_no">number of tickets</label><br>
    <input type="text" id="t_no" name="t_no"><br>
    <label for="coach_type">Coach Type</label><br>
    <input type="text" id="coach_type" name="coach_type"><br>
    <!-- <label for="sleeper_seats_remaining">sleeper_seats_remaining</label><br>
    <input type="text" id="sleeper_seats_remaining" name="sleeper_seats_remaining"><br>
    <label for="AC_seats_remaining">AC_seats_remaining</label><br>
    <input type="text" id="AC_seats_remaining" name="AC_seats_remaining"><br> -->
    <input type="submit" value="next" onclick="">
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $_SESSION['train_no']=$_POST['train_no'];
      $_SESSION['DOJ']=$_POST['DOJ'];
      $_SESSION['t_no']=$_POST['t_no'];
      $_SESSION['coach_type']=$_POST['coach_type'];
      $result = pg_query_params('Select check_availability($1, $2, $3, $4);',array(
        $_SESSION['train_no'],
        $_SESSION['coach_type'],
        $_SESSION['DOJ'],
        $_SESSION['t_no']
      ))
              or die('Unable to CALL stored procedure: ' . pg_last_error());
              //add condition here
      $row=pg_fetch_row($result);
      if($row[0]==0){
        echo '<script>alert("train not available")</script>';
        die();
      }
      header("location: book_ticket.php");
      // $_POST['DOJ'],
      // $_SESSION['admin_id'],
      // $_POST['sleeper_seats_capacity'],
      // $_POST['AC_seats_capacity'],
      // $_POST['sleeper_seats_capacity'],
      // $_POST['AC_seats_capacity']);
      // echo $arr[0],$arr[1],$arr[2];
      // $result = pg_query_params('Select Release_Train($1, $2, $3, $4,$5,$6,$7);',$arr)
      //
      //         or die('Unable to CALL stored procedure: ' . pg_last_error());

    }
    ?>
  </form>
  <button type="button" name="button" onclick="window.history.back()">Back</button>
  <h2><a href="logout.php">Sign Out</a></h2>
</body>
</html>
