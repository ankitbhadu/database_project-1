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
  <h2 class="navbar-brand">Welcome, <?php echo $_SESSION['agent_id']; ?></h2>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
</nav>
<form method="post">
  <h1>Journey details</h1>
  <div class="formcontainer">
  <div class="container">
  <span style="padding-bottom:2000px"></span>
    <label for="train_no"><strong>train_no</strong></label>
    <input type="text" placeholder="train_no" name="train_no" required>
    <label for="DOJ"><strong>DOJ</strong></label>
    <input type="text" placeholder="dd-mm-yyyy" name="DOJ" required>
    <label for="t_no"><strong>Number of passengers</strong></label>
    <input type="text" placeholder="Number" name="t_no" required>
    <label for="coach_type"><strong>coach_type</strong></label>
    <input type="text" placeholder="A/S" name="coach_type" required>
    <div style = "font-size:14px; color:#cc0000; margin-top:10px"></div>
  </div>
  <button type="submit" value="submit" onclick="clear()">Next</button>
  <script type="text/javascript">
    function clear(){
      document.getElementById('train_no')='';
      document.getElementById('source_id')='';
      document.getElementById('destination_id')='';
      document.getElementById('coaches_capacity')='';
    }
  </script>
<button onclick="window.location.href='welcome.php'">Go Back</button>
</div>
<script>
</form>
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
  // $_SESSION['agent_id'],
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
</body>
</html>
