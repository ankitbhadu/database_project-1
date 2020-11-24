<?php
   include('session.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <style>
    html, body {
    display: flex;
    justify-content: center;
    font-family: Roboto, Arial, sans-serif;
    font-size: 15px;
    }
    form {
    border: 5px solid #f1f1f1;
    margin-top: 60px;
    }
    input[type=text], input[type=password] {
    width: 100%;
    padding: 16px 8px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    }
    button {
    background-color: #8ebf42;
    color: white;
    padding: 14px 0;
    margin: 10px 0;
    border: none;
    cursor: grabbing;
    width: 100%;
    }
    h1 {
    text-align:center;
    fone-size:18;
    }
    button:hover {
    opacity: 0.8;
    }
    .formcontainer {
    text-align: left;
    margin: 24px 50px 12px;
    }
    .container {
    padding: 16px 0;
    text-align:left;
    }
    span.psw {
    float: right;
    padding-top: 0;
    padding-right: 15px;
    }
    /* Change styles for span on extra small screens */
    @media screen and (max-width: 300px) {
    span.psw {
    display: block;
    float: none;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <!-- Brand/logo -->
  <!-- <a class="navbar-brand" href="#">Railway Reservation system</a> -->

  <!-- Links -->
  <h2 class="navbar-brand">Welcome, <?php echo $_SESSION['admin_id']; ?></h2>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="./add_train.php">Add Train</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="./release_train.php">Release Train</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</nav>
<div class="formcontainer">
<form method="post">
  <h1>Release train</h1>
  <div class="container">
  <span style="padding-bottom:2000px"></span>
    <label for="train_no"><strong>train_no</strong></label>
    <input type="text" placeholder="train_no" name="train_no" required>
    <label for="DOJ"><strong>DOJ</strong></label>
    <input type="text" placeholder="dd-mm-yyyy" name="DOJ" required>
    <label for="sleeper_seats_capacity"><strong>sleeper_seats_capacity</strong></label>
    <input type="text" placeholder="sleeper_seats_capacity" name="sleeper_seats_capacity" required>
    <label for="AC_seats_capacity"><strong>AC_seats_capacity</strong></label>
    <input type="text" placeholder="AC_seats_capacity" name="AC_seats_capacity" required>
    <div style = "font-size:14px; color:#cc0000; margin-top:10px"></div>
  </div>
  <script type="text/javascript">
    function clear(){
      document.getElementById('train_no')='';
      document.getElementById('source_id')='';
      document.getElementById('destination_id')='';
      document.getElementById('coaches_capacity')='';
    }
  </script>
  <button type="submit" value="submit" onclick="clear()">Release Train</button>
</form>
<button onclick="window.location.href='welcome.php'">Go Back</button>
</div>
<?php
function checkIsAValidDate($myDateString){
  return (bool)strtotime($myDateString);
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
  if(!checkIsAValidDate($_POST['DOJ'])){
    echo '<script>alert("Not valid journey date")</script>';
    die();
  }
  $arr=array($_POST['train_no'],
  $_POST['DOJ'],
  $_SESSION['admin_id'],
  $_POST['sleeper_seats_capacity'],
  $_POST['AC_seats_capacity'],
  $_POST['sleeper_seats_capacity'],
  $_POST['AC_seats_capacity']);
  // echo $arr[0],$arr[1],$arr[2];
  $sql = "SELECT * FROM released_trains WHERE train_no='{$_POST['train_no']}' and DOJ='{$_POST['DOJ']}';";
  $result = pg_num_rows(pg_query($db,$sql));
  if($result!=0){
    echo '<script>alert("Train already released!!!!")</script>';
    die();
  }
  $result = pg_query_params('Select Release_Train($1, $2, $3, $4,$5,$6,$7);',$arr)
          or die('Unable to CALL stored procedure: ' . pg_last_error());
  if($result==0){
    echo '<script>alert("Train does not exist in database!!! First add train")</script>';
    die();
  }
  echo '<script>alert("Train added successfully");</script>';
}
?>
</body>
</html>
