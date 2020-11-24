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
<form method="post">
  <h1>Admin Login</h1>
  <div class="formcontainer">
  <div class="container">
  <span style="padding-bottom:2000px"></span>
    <label for="train_no"><strong>train_no</strong></label>
    <input type="text" placeholder="train_no" name="train_no" required>
    <label for="source_id"><strong>source_id</strong></label>
    <input type="text" placeholder="source_id" name="source_id" required>
    <label for="destination_id"><strong>destination_id</strong></label>
    <input type="text" placeholder="destination_id" name="destination_id" required>
    <label for="coaches_capacity"><strong>coaches_capacity</strong></label>
    <input type="text" placeholder="coaches_capacity" name="coaches_capacity" required>
    <div style = "font-size:14px; color:#cc0000; margin-top:10px"></div>
  </div>
  <button type="submit" value="submit" onclick="clear()">Login</button>
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
</form>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
  if($_POST['train_no']=='' or $_POST['source_id']=='' or $_POST['destination_id']=='' or $_POST['coaches_capacity']==''){
    echo '<script>alert("No field should be empty")</script>';
    die();
  }
  if(strlen($_POST['train_no'])!=5 and is_numeric($_POST['train_no'])){
    echo '<script>alert("train_no should have length 5")</script>';
    die();
  }
  if(strlen($_POST['source_id'])!=5 and is_numeric($_POST['source_id'])){
    echo '<script>alert("source_id should have length 5")</script>';
    die();
  }
  if(strlen($_POST['destination_id'])!=5 and is_numeric($_POST['destination_id'])){
    echo '<script>alert("destination_id should have length 5")</script>';
    die();
  }
  $sql = "SELECT * FROM train WHERE train_no = '{$_POST['train_no']}'";
  $result = pg_num_rows(pg_query($db,$sql));
  if ($result!=0) {
    echo '<script>alert("train_no already exists")</script>';
    die();
  }
  if($_POST['source_id']==$_POST['destination_id']){
    echo '<script>alert("Source and Destination id cannot be same")</script>';
    die();
  }
    $result = $result = pg_query_params('CALL Insert_Train($1, $2, $3, $4)',
              array($_POST['train_no'],$_POST['source_id'],$_POST['destination_id'],$_POST['coaches_capacity']))

            or die('Unable to CALL stored procedure: ' . pg_last_error());
            echo '<script>alert("Train added successfully")</script>';
      header('location: welcome.php');
}
?>
</body>
</html>
