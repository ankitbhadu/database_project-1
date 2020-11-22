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
    <label for="sleeper_seats_capacity">sleeper_seats_capacity</label><br>
    <input type="text" id="sleeper_seats_capacity" name="sleeper_seats_capacity"><br>
    <label for="AC_seats_capacity">AC_seats_capacity</label><br>
    <input type="text" id="AC_seats_capacity" name="AC_seats_capacity"><br>
    <!-- <label for="sleeper_seats_remaining">sleeper_seats_remaining</label><br>
    <input type="text" id="sleeper_seats_remaining" name="sleeper_seats_remaining"><br>
    <label for="AC_seats_remaining">AC_seats_remaining</label><br>
    <input type="text" id="AC_seats_remaining" name="AC_seats_remaining"><br> -->
    <input type="submit" value="Submit" onclick="clear()">
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $arr=array($_POST['train_no'],
      $_POST['DOJ'],
      $_SESSION['admin_id'],
      $_POST['sleeper_seats_capacity'],
      $_POST['AC_seats_capacity'],
      $_POST['sleeper_seats_capacity'],
      $_POST['AC_seats_capacity']);
      echo $arr[0],$arr[1],$arr[2];
      $result = pg_query_params('Select Release_Train($1, $2, $3, $4,$5,$6,$7);',$arr)

              or die('Unable to CALL stored procedure: ' . pg_last_error());

    }
    ?>
    <script type="text/javascript">
      function clear(){
        document.getElementById('train_no')='';
        document.getElementById('DOJ')='';
        document.getElementById('sleeper_seats_capacity')='';
        document.getElementById('AC_seats_capacity')='';
      }
    </script>
  </form>
  <button type="button" name="button" onclick="window.history.back()">Back</button>
  <h2><a href="logout.php">Sign Out</a></h2>
</body>
</html>
